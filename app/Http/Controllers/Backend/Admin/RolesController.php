<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('contents.backend.admin.roles.index');
    }

    /**
     * Keperluan DataTables
     * @param DataTables $dataTables
     * @return JsonResponse
     */
    public function data(DataTables $dataTables): JsonResponse
    {
        return $dataTables->eloquent(
            Role::query()
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
    public function insert(Request $request): JsonResponse
    {
        $this->validator($request->all())->validate();
        $role = new Role();
        $role->fill($request->all());
        $role->save();
        return response()->json([
            'status' => true,
            'message' => 'Role berhasil ditambahkan'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $this->validator($request->all())->validate();
        $role = Role::find($request->id);
        $role->fill($request->all());
        $role->save();
        return response()->json([
            'status' => true,
            'message' => 'Role berhasil diubah'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $role = Role::find($request->id);
        $role->delete();
        return response()->json([
            'status' => true,
            'message' => 'Role berhasil dihapus'
        ]);
    }
}
