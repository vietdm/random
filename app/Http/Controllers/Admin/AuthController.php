<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(): View|Application|Factory
    {
        return view('admin.auth.login');
    }

    public function loginConfirmation(Request $request): JsonResponse
    {
        $credentials = $request->only('username', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Thông tin đăng nhập không chính xác!'
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Đăng nhập thành công!'
        ]);
    }
}
