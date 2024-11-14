<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\BomController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RfqController;

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
    Route::get('{produk_id}/edit', [ProdukController::class, 'edit']);
    Route::get('{produk_id}', [ProdukController::class, 'show']);
    Route::delete('{produk_id}', [ProdukController::class, 'destroy']);
});

Route::prefix('bahan-baku')->group(function () {
    Route::get('/', [BahanBakuController::class, 'index']);
    Route::get('tambah', [BahanBakuController::class, 'create']);
    Route::get('{produk_id}/edit', [BahanBakuController::class, 'edit']);
    Route::get('{produk_id}', [BahanBakuController::class, 'show']);
    Route::delete('{produk_id}', [BahanBakuController::class, 'destroy']);
});

Route::prefix('bom')->group(function () {
    Route::get('/', [BomController::class, 'index']);
    Route::get('tambah', [BomController::class, 'create']);
});

Route::prefix('rfq')->group(function () {
    Route::get('/', [RfqController::class, 'index']);
    Route::post('tamabh', [RfqController::class, 'create']);
});
