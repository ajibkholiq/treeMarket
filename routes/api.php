<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 Route::resource('/barang', App\Http\Controllers\BarangController::class);
 Route::resource('/kategori', App\Http\Controllers\KategoriController::class);
 Route::resource('/costumer', App\Http\Controllers\CostumerController::class);
 Route::resource('/order', App\Http\Controllers\OrderController::class);
 Route::get('getbarang',[App\Http\Controllers\BarangController::class,'getBarang']);
 Route::get('getkategori',[App\Http\Controllers\KategoriController::class,'getKategori']);
 Route::post('getbarang',[App\Http\Controllers\BarangController::class,'getBarangKategori']);
