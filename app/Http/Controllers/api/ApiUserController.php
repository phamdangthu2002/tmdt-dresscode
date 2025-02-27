<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiUserController extends Controller
{
    public function addUser(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
            ],
            [
                'name.required' => 'Tên là bắt buộc.',
                'name.string' => 'Tên phải là chuỗi.',
                'name.max' => 'Tên không được quá 255 ký tự.',
                'email.required' => 'Email là bắt buộc.',
                'email.email' => 'Email không hợp lệ.',
                'email.unique' => 'Email đã tồn tại.',
                'password.required' => 'Mật khẩu là bắt buộc.',
                'password.string' => 'Mật khẩu phải là chuỗi.',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'avatar' => $request->avatar,
        ]);
        return response()->json(['message' => 'Tạo tài khoản thành công'], 201);
    }

    public function loadUser()
    {
        try {
            $users = User::paginate(5);
            return response()->json(['users' => $users], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Tài khoản không tồn tại'], 404);
        }
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,',
            ],
            [
                'name.required' => 'Tên là bắt buộc.',
                'name.string' => 'Tên phải là chuỗi.',
                'name.max' => 'Tên không được quá 255 ký tự.',
                'email.required' => 'Email là bắt buộc.',
                'email.email' => 'Email không hợp lệ.',
                'email.unique' => 'Email đã tồn tại.',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'role' => $request->role,
            'sex' => $request->sex,
            'phone' => $request->phone,
            'trang_thai' => $request->trang_thai,
            'password' => $request->filled('password_new') ? bcrypt($request->password_new) : $user->password,
            'avatar' => $request->avatar_edit,
        ]);
        return response()->json(['message' => 'Cập nhật tài khoản thành công'], 200);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Tài khoản không tồn tại'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'Xóa tài khoản thành công'], 200);
    }
}
