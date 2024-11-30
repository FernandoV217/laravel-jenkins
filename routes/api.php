<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\studentController;
use Illuminate\Support\Facades\Route;

Route::get('/students', [studentController::class, 'getStudents']);

Route::get('/students/{id}', [studentController::class, 'getStudent']);

Route::post('/students', [studentController::class, 'guardarStudent']);

Route::put('/students/{id}', [studentController::class, 'updateStudent']);

Route::delete('/students/{id}', [studentController::class, 'deleteStudent']);

// Producto
Route::get('/productos', [ProductoController::class, 'getProductos']);

Route::post('/productos', [ProductoController::class, 'createProducto']);
