<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\TaskApiController;
use Illuminate\Support\Facades\Route;

Route::post("/login", [AuthApiController::class, "login"])->name("api.login");

Route::middleware("auth:api")->group(function () {
    Route::get("/tasks", [TaskApiController::class, "index"])->name("api.tasks.index");
    Route::post("/logout", [AuthApiController::class, "logout"])->name("api.logout");
});
