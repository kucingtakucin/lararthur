<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PengaduanController extends Controller
{
    public function index()
    {
        return view('contents.backend.admin.pengaduan.index');
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
            Pengaduan::query()
        )
            ->addIndexColumn()
            ->toJson();
    }

    public function chat(Request $request)
    {
        return view('contents.backend.admin.pengaduan.chat.index');
    }
}
