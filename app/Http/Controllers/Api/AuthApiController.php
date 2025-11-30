<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthApiController
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required|string|min:8",
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                "success" => false,
                "message" => "Invalid credentials.",
            ], 401);
        }

        $user = Auth::user();
        $tokenResult = $user->createToken("api-token");
        $token = $tokenResult->accessToken;
        $expiresAt = $tokenResult->token->expires_at;

        return response()->json([
            "success" => true,
            "token_type" => "Bearer",
            "access_token" => $token,
            "expires_at" => $expiresAt ? $expiresAt->toDateTimeString() : null,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            "success" => true,
            "message" => "Logged out."
        ]);
    }
}
