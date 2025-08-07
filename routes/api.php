<?php

use App\Http\Controllers\CategoryController;

use App\Http\Controllers\AuthController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserProfile;


Route::get('/', [CategoryController::class, 'index'])->name("Hello");

 Route::get('/api', function () {
    return new JsonResponse(["nome" => "Estevao"]);
 });
 

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt')->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::put('/user', [AuthController::class, 'updateUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
