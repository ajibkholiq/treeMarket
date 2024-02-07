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
    // return bcrypt("admin");
    return view('landing.index');
});
Route::get('/order', function (Request $req) {
    return view('landing.order');
});
Route::post('login', [App\Http\Controllers\Logincontroller::class, 'login'])->name('login');
Route::get('logout', [App\Http\Controllers\Logincontroller::class, 'logout'])->name('logout');


Route::prefix('admin')->group( function (){
    Route::get('/' , function(){
        return view("admin.login");
    })->name('admin');
    Route::middleware(['auth'])->group(function () {
        // Routes that require authenticationre
  
        Route::get('/barang', function(){
            return view('admin.barang');
        });
        Route::get('/kategori', function(){
            return view('admin.kategori');
        });
        Route::get('/costumer', function(){
            return view('admin.costumer');
        });
        Route::get('/order', function(){
            return view('admin.order');
        });
    });
});

