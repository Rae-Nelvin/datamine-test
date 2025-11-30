<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\TaskController;
use App\Http\Controllers\User\TaskCommentController;
use App\Http\Controllers\Fallback\FallbackController;

use Illuminate\Support\Facades\Route;

Route::middleware("web")->group(function () {
    Route::get("/login", [AuthController::class, "showLoginForm"])->name("login");
    Route::post("/login", [AuthController::class, "login"])->name("login.attempt");

    Route::get("/register", [AuthController::class, "showRegisterForm"])->name("register");
    Route::post("/register", [AuthController::class, "register"])->name("register.attempt");

    Route::middleware("auth")->group(function () {
        Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard");
        Route::get("/tasks", [TaskController::class, "index"])->name("tasks.index");
        Route::post("/tasks", [TaskController::class, "store"])->name("tasks.store");
        Route::put("/tasks/{task}", [TaskController::class, "update"])->name("tasks.update");
        Route::delete("/tasks/{task}", [TaskController::class, "destroy"])->name("tasks.destroy");
        Route::get("/tasks/{task}", [TaskController::class, "detail"])->name("tasks.detail")
            ->missing(function () {
                return redirect()->route("tasks.index");
            });
        Route::patch("/tasks/{task}/start", [TaskController::class, "start"])->name("tasks.start");
        Route::patch("/tasks/{task}/pause", [TaskController::class, "pause"])->name("tasks.pause");
        Route::patch("/tasks/{task}/finish", [TaskController::class, "finish"])->name("tasks.finish");
        Route::patch("/tasks/{task}/approve", [TaskController::class, "approve"])->name("tasks.approve");
        Route::patch("/tasks/{task}/reject", [TaskController::class, "reject"])->name("tasks.reject");
        Route::post("/tasks/{task}/comments", [TaskCommentController::class, "store"])->name("tasks.comments.store");
        Route::get("/answers", function () {
            return view("user.answers");
        })->name("answers.index");
    });

    Route::post("/logout", [AuthController::class, "destroy"])->name("logout");
});

Route::fallback(FallbackController::class);
