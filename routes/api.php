<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt')->group(function () {

    Route::get('/user', [AuthController::class, 'getUser']);
    Route::put('/user', [AuthController::class, 'updateUser']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get("/users", [UserController::class, "getAllUsers"]);
    Route::get('/users/{id}', [UserController::class, "getUser"]);
    Route::post('/register', [UserController::class, 'registeUser']);
    Route::delete('/users/{id}', [UserController::class, "destroyUser"]);

    //Roles Routes

    Route::get("/roles", [SupplyController::class, "getAllSupplies"]);
    Route::get('/roles/{id}', [SupplyController::class, "getSupply"]);
    Route::post("/roles", [SupplyController::class, "createSupply"]);
    Route::put("/roes/{id}", [SupplyController::class, "updateSupply"]);
    Route::delete("/roles/{id}", [SupplyController::class, "destroySupply"]);

    //Supplies Routes

    Route::get("/supplies", [SupplyController::class, "getAllSupplies"]);
    Route::get('/supplies/{id}', [SupplyController::class, "getSupply"]);
    Route::post("/supplies", [SupplyController::class, "createSupply"]);
    Route::put("/supplies/{id}", [SupplyController::class, "updateSupply"]);
    Route::delete("/supplies/{id}", [SupplyController::class, "destroySupply"]);

    //Suppliers Routes

    Route::get("/suppliers", [SupplierController::class, "getAllSuppliers"]);
    Route::get('/suppliers/{id}', [SupplierController::class, "getSupplier"]);
    Route::post("/suppliers", [SupplierController::class, "createSupplier"]);
    Route::put("/suppliers/{id}", [SupplierController::class, "updateSupplier"]);
    Route::delete("/suppliers/{id}", [SupplierController::class, "destroySupplier"]);

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

    // Orders Routes

    Route::get("/orders", [OrderController::class, "getAllOrders"]);
    Route::get("/orders/{id}", [OrderController::class, "getOrder"]);
    Route::post("/orders", [OrderController::class, "createOrder"]);
    Route::put("/orders/{id}", [OrderController::class, "updateOrder"]);
    Route::delete("/orders/{id}", [OrderController::class, "destroyOrder"]);



});


