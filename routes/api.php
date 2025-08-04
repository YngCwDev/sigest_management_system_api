<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


Route::get('/', [CategoryController::class, 'index'])->name("Hello");

 Route::get('/api', function () {
    return new JsonResponse(["nome" => "Estevao"]);
 });