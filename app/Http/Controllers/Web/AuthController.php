<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah',
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        session(['token' => $token, 'user' => $user->toArray()]);

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
        ]);
    }

    public function me()
    {
        return response()->json([
            'success' => true,
            'data'    => session('user'),
        ]);
    }

    public function doLogout(Request $request)
    {
        Auth::user()?->tokens()->delete();
        session()->flush();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
        ]);
    }
}