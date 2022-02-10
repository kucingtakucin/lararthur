<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function update(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = User::find($request->id);
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil mengupdate account'
        ]);
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
            // 'username' => ['required'],
            'password' => ['required'],
        ]);
    }
}
