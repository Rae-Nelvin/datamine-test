<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, "showLoginForm"])->name("login");
Route::post("/login", [AuthController::class, "login"])->name("login.attempt");

Route::get('/register', [AuthController::class, "showRegisterForm"])->name("register");
Route::post("/register", [AuthController::class, "register"])->name("register.attempt");

Route::group(['middleware' => ['web']], function () {
    Route::get('/dashboard', [DashboardController::class, "index"])->name("dashboard");
});
