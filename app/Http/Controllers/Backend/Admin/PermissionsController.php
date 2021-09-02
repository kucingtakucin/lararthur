<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('contents.backend.admin.permissions.index');
    }

    /**
     * Keperluan datatables
     * 
     * @param DataTables $dataTables
     * @return JsonResponse
     */
    public function data(DataTables $dataTables): JsonResponse
    {
        return $dataTables->eloquent(
            Permission::query()
        )->addIndexColumn()
            ->toJson();
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
            'name' => ['required'],
            'display_name' => ['required'],
            'description' => ['required'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function insert(Request $request)
    {
        $this->validator($request->all())->validate();
        $permission = new Permission();
        $permission->fill($request->all());
        $permission->save();

        return response()->json([
            'status' => true,
            'message' => 'Permission berhasil ditambahkan'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $this->validator($request->all())->validate();
        $permission = Permission::find($request->id);
        $permission->fill($request->all());
        $permission->save();

        return response()->json([
            'status' => true,
            'message' => 'Permission berhasil diubah'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function delete(Request $request)
    {
        $permission = Permission::find($request->id);
        $permission->delete();

        return response()->json([
            'status' => true,
            'message' => 'Permission berhasil dihapus'
        ]);
    }
}
