<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SupplyController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

//User Routes

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

//Categories Routes

Route::get("/categories", [CategoryController::class, "getCategories"]);
Route::get("/categories/{id}", [CategoryController::class, "getCategory"]);
Route::post("/categories", [CategoryController::class, "addCategory"]);
Route::put("/categories/{id}", [CategoryController::class, "updateCategory"]);
Route::delete("/categories/{id}", [CategoryController::class, "destroyCategory"]);

//Departments Route

Route::get("/departments", [DepartmentController::class, "getAllDepartments"]);
Route::get("/departments/{id}", [DepartmentController::class, "getDepartment"]);
Route::post("/departments", [DepartmentController::class, "createDepartment"]);
Route::put("/departments/{id}", [DepartmentController::class, "updateDepartment"]);
Route::delete("/departments/{id}", [DepartmentController::class, "destroyDepartment"]);



//




//