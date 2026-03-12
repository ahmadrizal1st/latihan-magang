<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email'    => 'required|email',
                'password' => 'required',
            ]);

            $userApi = UserApi::where('email', $request->email)->first();

            if (!$userApi || !Hash::check($request->password, $userApi->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau password salah',
                ], 401);
            }

            $token = $userApi->createToken('api-token')->plainTextToken;
            
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'token'   => $token,
                'UserApi'    => [
                    'id'    => $userApi->id,
                    'name'  => $userApi->name,
                    'email' => $userApi->email,
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error'=> $th->getMessage(),
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->UserApi()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
        ]);
    }
}