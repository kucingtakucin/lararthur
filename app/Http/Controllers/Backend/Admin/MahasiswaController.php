<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Mahasiswa;
use App\Models\Admin\Reference\Fakultas as RefFakultas;
use App\Models\Admin\Reference\Kecamatan as RefKecamatan;
use App\Models\Admin\Reference\Prodi as RefProdi;
use Dompdf\Dompdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpWord\TemplateProcessor;
use Yajra\DataTables\DataTables;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('contents.backend.admin.mahasiswa.index');
    }

    /**
     * Keperluan API DataTables
     *
     * @param DataTables $datatables
     * @return JsonResponse
     */
    public function data(DataTables $datatables): JsonResponse
    {
        return $datatables->eloquent(
            Mahasiswa::query()->with(['prodi', 'fakultas'])
        )
            ->addIndexColumn()
            ->toJson();
    }

    /**
     * Keperluan API Select2
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getProdi(Request $request): JsonResponse
    {
        return response()->json([
            'status' => true,
            'data' => RefProdi::select(DB::raw('*'))
                ->where('fakultas_id', $request->get('fakultas_id'))
                ->paginate(10)
        ]);
    }

    /**
     * Keperluan API Select2
     *
     * @return JsonResponse
     */
    public function getFakultas(): JsonResponse
    {
        return response()->json([
            'status' => true,
            'data' => RefFakultas::select(DB::raw('*'))
                ->paginate(10)
        ]);
    }

    /**
     * Keperluan API Leaflet
     *
     * @return JsonResponse
     */
    public function getKecamatan(): JsonResponse
    {
        return response()->json([
            'status' => true,
            'data' =>  RefKecamatan::select(DB::raw('*'))->get()
        ]);
    }

    /**
     * Keperluan API Leaflet
     *
     * @return JsonResponse
     */
    public function getLatLng(): JsonResponse
    {
        return response()->json([
            'status' => true,
            'data' => Mahasiswa::select(DB::raw('nama, latitude, longitude'))->get()
        ]);
    }

    /**
     * Keperluan API Leaflet
     *
     * @return mixed
     */
    public function getGeoJSON()
    {
        $response = Http::get('https://covid19.karanganyarkab.go.id/assets/maps/map-kab-kra.geojson');
        return $response->json();
    }

    /**
     * Keperluan validasi data
     *
     * @param array $data
     * @return \Illuminate\Contract\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'nim' => ['required', (isset($data['id']) ? Rule::unique('mahasiswa')->ignore($data['id']) : 'unique:mahasiswa,nim')],
            'nama' => ['required'],
            'prodi_id' => ['required'],
            'fakultas_id' => ['required'],
            'angkatan' => ['required'],
            // 'foto' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function insert(Request $request): JsonResponse
    {
        $this->validator($request->all())->validate();
        $mahasiswa = new Mahasiswa();
        $mahasiswa->fill($request->all());
        $mahasiswa->created_by = Auth::id();
        $mahasiswa->save();
        return response()->json([
            'status' => true,
            'message' => 'Data mahasiswa berhasil ditambahkan',
            'last_inserted_id' => $mahasiswa->id
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $this->validator($request->all())->validate();
        $mahasiswa = Mahasiswa::find($request->id);
        $mahasiswa->fill($request->all());
        $mahasiswa->updated_by = Auth::id();
        $mahasiswa->save();
        return response()->json([
            'status' => true,
            'message' => 'Data mahasiswa berhasil diubah',
            'last_updated_id' => $mahasiswa->id
        ], 201);
    }

    /**
     * Keperluan Upload File
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {
        if ($request->hasFile('foto')) {
            $mahasiswa = Mahasiswa::find($request->id);
            if ($mahasiswa->foto && file_exists(storage_path('app/public/' . $mahasiswa->foto))) {
                unlink(storage_path('app/public/' . $mahasiswa->foto));
            }
            $mahasiswa->foto = $request->file('foto')->storePublicly('uploads/mahasiswa');
            $mahasiswa->save();
            return response()->json([
                'status' => true,
                'message' => 'Image Uploaded'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $mahasiswa = Mahasiswa::find($request->id);
        if ($mahasiswa->foto && file_exists(storage_path('app/public/' . $mahasiswa->foto))) {
            unlink(storage_path('app/public/' . $mahasiswa->foto));
        }
        $mahasiswa->deleted_by = Auth::id();
        $mahasiswa->save();
        $mahasiswa->delete();
        return response()->json([
            'status' => true,
            'message' => 'Data mahasiswa berhasil dihapus'
        ], 201);
    }

    /**
     * Keperluan export docx
     *
     * @return void
     */
    public function exportWord()
    {
        $templateProcessor = new TemplateProcessor(storage_path('app/public/templates/word/template_word.docx'));
        // $templateProcessor->setValue('param', 'value');

        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attachment; filename=data_mahasiswa.docx");
        header('Cache-Control: max-age=0');
        $templateProcessor->saveAs('php://output');
    }

    public function importExcel()
    {
    }

    /**
     * Keperluan export xlsx
     *
     * @return void
     */
    public function exportExcel()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->setTitle('Data Mahasiswa');
        $spreadsheet->getProperties()->setCreator('Mahasiswa')
            ->setLastModifiedBy('Mahasiswa')
            ->setTitle('Data Mahasiswa')
            ->setSubject('Data Mahasiswa')
            ->setDescription('Data Mahasiswa')
            ->setKeywords('data mahasiswa');

        $spreadsheet->getActiveSheet()->getStyle('B5:G5')
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('FFFA65');

        $spreadsheet->getActiveSheet(0)
            ->setCellValue('F2', 'DATA MAHASISWA')
            ->getStyle('D2')
            ->getFont()->setBold(true);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B5', '#')
            ->getStyle('B5')
            ->getFont()->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('C5', 'NIM')
            ->getStyle('C5')
            ->getFont()
            ->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('D5', 'NAMA LENGKAP')
            ->getStyle('D5')
            ->getFont()
            ->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('E5', 'ANGKATAN')
            ->getStyle('E5')
            ->getFont()
            ->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('F5', 'PROGRAM STUDI')
            ->getStyle('F5')
            ->getFont()
            ->setBold(true);
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('G5', 'FAKULTAS')
            ->getStyle('G5')
            ->getFont()
            ->setBold(true);

        $spreadsheet->getActiveSheet(0)->getStyle('B5:G5')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet(0)->getStyle('B5:G5')
            ->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER);

        $spreadsheet->getActiveSheet()->getRowDimension('5')->setRowHeight(30);

        $columns = ['B', 'C', 'D', 'E', 'F', 'G'];

        foreach ($columns as $column) {
            $spreadsheet->getActiveSheet()
                ->getColumnDimension($column)
                ->setAutoSize(true);
            $spreadsheet->getActiveSheet()
                ->getStyle("{$column}5")
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));
        }

        $data = $this->M_Mahasiswa->get();

        $no = 0;
        $awal = 6;
        foreach ($data as $datum) {
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('B' . $awal, ++$no);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('C' . $awal, $datum->nim);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('D' . $awal, $datum->nama);
            $spreadsheet->setActiveSheetIndex(0)->setCellValueExplicit('E' . $awal, "{$datum->angkatan}", DataType::TYPE_STRING);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('F' . $awal, $datum->nama_prodi);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('G' . $awal, $datum->nama_fakultas);

            foreach ($columns as $column) {
                $spreadsheet->getActiveSheet()
                    ->getStyle($column . $awal)
                    ->getBorders()
                    ->getOutline()
                    ->setBorderStyle(Border::BORDER_THIN)
                    ->setColor(new Color('000000'));
            }
            $awal++;
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="data_mahasiswa.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save(
            'php://output'
        );
    }

    /**
     * Keperluan expot pdf
     *
     * @return void
     */
    public function exportPdf()
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->getOptions()->setChroot(storage_path('app/public/templates/pdf'));
        $dompdf->loadHtml('hello world');

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('data_mahasiswa.pdf');
    }
}
