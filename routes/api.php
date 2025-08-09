<?php

use App\Http\Controllers\CategoryController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplyController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserProfile;
use App\Http\Controllers\SupplierController;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt')->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout']);

    //ADMIN PERMISSION
    Route::middleware(['can:is-admin'])->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::put('/users/{id}', [AuthController::class, 'updateUser']);

        //Supplier Route
        Route::get('/supplier', [SupplierController::class, 'getAllSupplier']);
        Route::get("/supplier/{id}", [SupplierController::class, "getSupplier"]);
        Route::post("/supplier", [SupplierController::class, "create"]);
        Route::put("/supplier/{id}", [SupplierController::class, "update"]);
        Route::delete("/supplier/{id}", [SupplierController::class, "destroy"]);

        //Supply Route
        Route::get('/supplies/{id}', [SupplyController::class, "getSupply"]);
        Route::post("/supplies", [SupplyController::class, "create"]);
        Route::put("/supplies/{id}", [SupplyController::class, "update"]);  
        Route::delete("/supplies/{id}", [SupplyController::class, "destroy"]);
    });

    //SUPERVISOR PERMISSION
    Route::middleware(['can:is-supervisor'])->group(function () {
    
    });

    //USER DEFAULT PERMISSION
    Route::middleware(['can:is-default'])->group(function () {
        
    });

        //Universal Routes
        Route::get("/supplies", [SupplyController::class, "getAllSupplies"]);
});