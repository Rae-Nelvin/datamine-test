<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;

class AuthController
{
    public function showLoginForm()
    {
        return view("auth.login");
    }

    public function showRegisterForm()
    {
        return view("auth.register");
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            "EMAIL" => ["required", "email", "email:filter"],
            "PASSWORD" => ["required", "string", Password::default()]
        ]);

        $key = "login|" . $request->ip() . "|" . $credentials["EMAIL"];
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                "EMAIL" => trans("auth.throttle", [
                    "seconds" => $seconds,
                    "minutes" => ceil($seconds / 60)
                ])
            ])->status(429);
        }

        if (Auth::attempt([
            "EMAIL" => $credentials["EMAIL"],
            "password" => $credentials["PASSWORD"]
        ])) {
            $request->session()->regenerate();
            RateLimiter::clear($key);

            return $request->wantsJson() ? response()->json(["user" => Auth::user()], 200) : redirect()->intended(route("dashboard"));
        }

        RateLimiter::hit($key, 60);
        throw ValidationException::withMessages([
            "EMAIL" => [trans("auth.failed")]
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            "FIRST_NAME" => ["required", "string", "max:255"],
            "LAST_NAME" => ["nullable", "string", "max:255"],
            "EMAIL" => ["required", "email", "email:filter", "unique:users,EMAIL"],
            "PHONE" => ["nullable", "string", "max:20", "regex:/^\d+$/", "not_regex:/^0/"],
            "PASSWORD" => ["required", "string", Password::default(), "confirmed:PASSWORD_CONFIRMATION"],
            "PASSWORD_CONFIRMATION" => ["required", "string"]
        ]);

        $user = User::create([
            "FIRST_NAME" => $data["FIRST_NAME"],
            "LAST_NAME" => $data["LAST_NAME"],
            "EMAIL" => $data["EMAIL"],
            "PHONE" => $data["PHONE"],
            "PASSWORD" => Hash::make($data["PASSWORD"])
        ]);

        Auth::login($user);

        return $request->wantsJson() ? response()->json(["user" => $user], 201) : redirect()->intended(route("dashboard"));
    }

    public function destroy(Request $request)
    {
        Auth::guard("web")->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $request->wantsJson() ? response()->json()->noContent() : redirect("/");
    }
}
