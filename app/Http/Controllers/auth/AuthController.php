<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            // 'g-recaptcha-response' => 'required', // Kiểm tra reCAPTCHA
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            // 'g-recaptcha-response.required' => 'Vui lòng xác nhận reCAPTCHA',
        ]);

        // Nếu lỗi, trả về JSON
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Xác minh Google reCAPTCHA
        // $response = Http::post('https://www.google.com/recaptcha/api/siteverify', [
        //     'secret' => env('RECAPTCHA_SECRET_KEY'),
        //     'response' => $request->input('g-recaptcha-response'),
        //     'remoteip' => $request->ip(),
        // ]);

        // $recaptchaSecret = env('RECAPTCHA_SECRET_KEY');
        // $response = Http::post('https://www.google.com/recaptcha/api/siteverify', [
        //     'secret' => $recaptchaSecret,
        //     'response' => $request->input('g-recaptcha-response'),
        // ]);

        // $data = $response->json();
        // Log::info('Google Response:', $data);

        // $body = $response->json();

        // if (!$body['success']) {
        //     return response()->json(['error' => ['g-recaptcha-response' => ['Xác minh reCAPTCHA không thành công.']]], 422);
        // }

        // Kiểm tra đăng nhập
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Đăng nhập thành công',
                'redirect' => Auth::user()->role == "admin" ? route('admin.index') : route('home'),
            ]);
        }

        return response()->json(['error' => ['email' => ['Thông tin đăng nhập không chính xác.']]], 422);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ], [
            'name.required' => 'Vui lòng nhập tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        ]);

        // Nếu lỗi, trả về JSON
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Tạo tài khoản
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return response()->json(['message' => 'Tạo tài khoản thành công'], 201);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Đăng xuất thành công']);
    }
}
