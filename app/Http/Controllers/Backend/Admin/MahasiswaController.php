<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Mahasiswa;
use App\Models\Admin\Reference\Fakultas as RefFakultas;
use App\Models\Admin\Reference\Kecamatan as RefKecamatan;
use App\Models\Admin\Reference\Prodi as RefProdi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
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
        )->toJson();
    }

    /**
     * Keperluan API Select2
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getProdi(Request $request): JsonResponse
    {
        return response()->json(
            RefProdi::select(DB::raw('*'))
                ->where('fakultas_id', $request->get('fakultas_id'))
                ->paginate(10)
        );
    }

    /**
     * Keperluan API Select2
     *
     * @return JsonResponse
     */
    public function getFakultas(): JsonResponse
    {
        return response()->json(
            RefFakultas::select(DB::raw('*'))->paginate(10)
        );
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
            'nim' => ['required', Rule::unique('mahasiswa')->ignore($data['id'])],
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
    public function store(Request $request): JsonResponse
    {
        $this->validator($request->all())->validate();
        $mahasiswa = Mahasiswa::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Data mahasiswa berhasil ditambahkan',
            'last_inserted_id' => $mahasiswa->id
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $this->validator($request->all())->validate();
        $mahasiswa = Mahasiswa::find($request->id)->update();
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
            Mahasiswa::find($request->id)->update([
                'foto' => $request->file('foto')->store('uploads/mahasiswa')
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Image Uploaded'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Mahasiswa  $mahasiswa
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        Mahasiswa::destroy($request->id);
        return response()->json([
            'status' => true,
            'message' => 'Data mahasiswa berhasil dihapus'
        ], 201);
    }
}
