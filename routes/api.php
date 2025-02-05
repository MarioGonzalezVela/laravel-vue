<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ProductoController;
use App\Http\Controllers\api\CategoriaController;

Route::get('/products', [ProductoController::class, 'index']);
Route::get('/products/{id}', [ProductoController::class, 'show']);
Route::post('/products', [ProductoController::class, 'store']);
Route::put('/products/{id}', [ProductoController::class, 'update']);
Route::delete('/products/{id}', [ProductoController::class, 'destroy']);

Route::get('/categories', [CategoriaController::class, 'index']);
