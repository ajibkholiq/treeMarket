<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (Request $req) {
    return view('landing.index');
});

// Route::prefix('admin')->group( function (){
Route::get('/barang', function(){
    return view('admin.barang');
});

Route::get('/kategori', function(){
    return view('admin.kategori');
});
// });