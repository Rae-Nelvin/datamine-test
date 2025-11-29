<?php

namespace App\Http\Controllers\Fallback;

use Illuminate\Support\Facades\Auth;

class FallbackController
{
    public function __invoke()
    {
        if (Auth::check()) {
            return redirect()->route("dashboard");
        }

        return redirect()->route("login");
    }
}
