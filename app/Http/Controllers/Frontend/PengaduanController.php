<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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

    public function insert()
	{
        $pengaduan = new Pengaduan();
        $pengaduan->fill($request->all());
        $pengaduan->is_active = '1';
        $pengaduan->save();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil mengirimkan pengaduan!'
        ]);
	}
}
