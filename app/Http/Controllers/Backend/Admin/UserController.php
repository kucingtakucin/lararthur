<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('contents.backend.admin.user.index');
    }

    /**
     * Keperluan API DataTables
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function data(DataTables $dataTables): JsonResponse
    {
        return $dataTables->eloquent(
            User::query()->with(['roles', 'permissions'])
        )
            ->addIndexColumn()
            ->addColumn('roles', function (User $user) {
                return $user->roles->map(function ($role) {
                    return "<span class=\"badge badge-secondary\">{$role->name}</span>";
                })->implode('<br>');
            })->addColumn('permissions', function (User $user) {
                return $user->permissions->map(function ($permission) {
                    return "<span class=\"badge badge-secondary\">{$permission->name}</span>";
                })->implode('<br>');
            })->rawColumns(['roles', 'permissions'])
            ->toJson();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', (isset($data['id']) ? Rule::unique('users')->ignore($data['id']) : 'unique:users,email')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function getRoles()
    {
        return response()->json([
            'status' => true,
            'data' => Role::select(DB::raw('*'))->paginate(10)
        ]);
    }

    public function getPermissions()
    {
        return response()->json([
            'status' => true,
            'data' => Permission::select(DB::raw('*'))->get(10)
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
        $user = new User();
        $user->fill($request->all());
        $user->save();

        $role = Role::find($request->roles);

        $user->attachRole($role);

        $permissions = Permission::find($request->permissions);
        $listPermissions = collect([]);
        $permissions->map(function ($permission) use ($listPermissions) {
            $listPermissions->push($permission);
        });
        $user->attachPermissions($listPermissions);
        return response()->json([
            'status' => true,
            'message' => 'User berhasil ditambahkan'
        ]);
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
        $user = User::find($request->id);
        $user->fill($request->all());
        $user->save();

        $role = Role::find($request->roles);
        if (!$user->hasRole($role->name)) {
            $user->detachRole($user->role->first()->id);
        }
        $user->attachRole($role);

        $permissions = Permission::find($request->permissions);
        $user->detachPermissions($user->permissions);

        $listPermissions = collect([]);
        $permissions->map(function ($permission) use ($listPermissions) {
            $listPermissions->push($permission);
        });
        $user->attachPermissions($listPermissions);

        return response()->json([
            'status' => true,
            'message' => 'User berhasil diubah'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'User berhasil dihapus'
        ]);
    }
}
