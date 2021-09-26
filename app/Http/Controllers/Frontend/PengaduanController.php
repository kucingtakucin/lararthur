<?php

namespace App\Http\Controllers\Frontend;

use App\Events\FrontEnd\KirimPengaduanEvent;
use App\Http\Controllers\Controller;
use App\Models\Admin\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengaduanController extends Controller
{
    /**
     * Show the application landing page.
     *
     * @return View
     */
    public function index(): View
    {
        return view('contents.frontend.pengaduan.index');
    }

    public function insert(Request $request)
    {
        $pengaduan = new Pengaduan();
        $pengaduan->fill($request->all());
        $pengaduan->is_active = '1';
        $pengaduan->save();

        event(new KirimPengaduanEvent('Ada pengaduan baru yang masuk!'));
        return response()->json([
            'status' => true,
            'message' => 'Berhasil mengirimkan pengaduan!'
        ]);
    }
}
