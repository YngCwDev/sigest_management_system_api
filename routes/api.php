<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplyController;
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

Route::get("/supplies", [SupplyController::class, "getAllSupplies"]);
Route::get('/supplies/{id}', [SupplyController::class, "getSupply"]);
Route::post("/supplies", [SupplyController::class, "create"]);
Route::put("/supplies/{id}", [SupplyController::class, "update"]);  
Route::delete("/supplies/{id}", [SupplyController::class, "destroy"]);