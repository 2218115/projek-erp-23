<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;

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

Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'register']);
});


Route::prefix('produk')->group(function () {
    Route::get('/', [ProdukController::class, 'index']);
    Route::get('tambah', [ProdukController::class, 'create']);
    Route::post('tambah', [ProdukController::class, 'store']);
    Route::get('{produk_id}/edit', [ProdukController::class, 'edit']);
    Route::get('{produk_id}', [ProdukController::class, 'show']);
    Route::delete('{produk_id}', [ProdukController::class, 'destroy']);
});
