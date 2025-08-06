<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsumableController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return new JsonResponse(['message' => 'Hello world!'], 201, json: false);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt')->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::put('/user', [AuthController::class, 'updateUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
}); 


//Supplies Routes

Route::get("/supplies", [ConsumableController::class, "getAllSupplies"]);
Route::get('/supplies/{id}', [ConsumableController::class, "getSupply"]);
Route::post("/supplies", [ConsumableController::class, "create"]);
Route::post("/supplies", [ConsumableController::class, "create"]);