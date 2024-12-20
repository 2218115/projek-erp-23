<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\BomController;
use App\Http\Controllers\ManufacuringController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RfqController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\SalesController;

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
    Route::get('report', [ProdukController::class, 'report']);
    Route::get('{produk_id}/edit', [ProdukController::class, 'edit']);
    Route::get('{produk_id}', [ProdukController::class, 'show']);
    Route::delete('{produk_id}', [ProdukController::class, 'destroy']); // TODO: soft delete
});

Route::prefix('bahan-baku')->group(function () {
    Route::get('/', [BahanBakuController::class, 'index']);
    Route::get('tambah', [BahanBakuController::class, 'create']);
    Route::get('report', [BahanBakuController::class, 'report']);
    Route::get('{produk_id}/edit', [BahanBakuController::class, 'edit']);
    Route::get('{produk_id}', [BahanBakuController::class, 'show']);
    Route::delete('{produk_id}', [BahanBakuController::class, 'destroy']); // TODO: soft delete
});

Route::prefix('mo')->group(function () {
    Route::get('/', [ManufacuringController::class, 'index']);
    Route::get('tambah', [ManufacuringController::class, 'create']);
    Route::get('{produk_id}/edit', [ManufacuringController::class, 'edit']);
    Route::get('{mo_id}', [ManufacuringController::class, 'show']);
    Route::delete('{produk_id}', [ManufacuringController::class, 'destroy']);
});

Route::prefix('bom')->group(function () {
    Route::get('/', [BomController::class, 'index']);
    Route::get('tambah', [BomController::class, 'create']);
    Route::get('report', [BomController::class, 'report']);
    Route::get('report/{id}', [BomController::class, 'report_detail']);
    Route::get('{bom_id}', [BomController::class, 'show']);
    Route::get('{bom_id}/edit', [BomController::class, 'edit']);
    Route::delete('{bom_id}', [BomController::class, 'destroy']); // TODO: soft delete
});

Route::prefix('vendor')->group(function () {
    Route::get('/', [VendorController::class, 'index']);
    Route::get('/tambah', [VendorController::class, 'create']);
    Route::get('{vendor_id}', [VendorController::class, 'show']);
    Route::get('{vendor_id}/edit', [VendorController::class, 'edit']);
    Route::delete('{vendor_id}', [VendorController::class, 'destroy']);
});

Route::prefix('rfq')->group(function () {
    Route::get('', [RfqController::class, 'index']);
    Route::get('tambah', [RfqController::class, 'create']);
    Route::get('report/{id}', [RfqController::class, 'report_detail']);
    Route::get('{rfq_id}', [RfqController::class, 'show']);
});

Route::prefix('sales')->group(function () {
    Route::get('/', [SalesController::class, 'index']);
    Route::get('/tambah', [SalesController::class, 'create']);
    Route::get('/delivery', [SalesController::class, 'delivery']);
});
