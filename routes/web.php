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


Route::get('/', [App\Http\Controllers\LoginController::class, 'index'])->name('showlogin');


Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');


Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);

// Akun
Route::get('/akun', [App\Http\Controllers\AkunController::class, 'index']);
Route::get('/akun/create', [App\Http\Controllers\AkunController::class, 'create']);
Route::post('akun/store', [App\Http\Controllers\AkunController::class, 'store']);
Route::get('akun/edit/{id}', [App\Http\Controllers\AkunController::class, 'edit']);
Route::patch('akun/update/{id}', [App\Http\Controllers\AkunController::class, 'update']);
Route::delete('akun/delete/{id}', [App\Http\Controllers\AkunController::class, 'delete']);


// Department
Route::get('/department', [App\Http\Controllers\DepartmentController::class, 'index']);
Route::get('/department/create', [App\Http\Controllers\DepartmentController::class, 'create']);
Route::post('/department/store', [App\Http\Controllers\DepartmentController::class, 'store']);
Route::get('/department/edit/{id}', [App\Http\Controllers\DepartmentController::class, 'edit']);
Route::patch('/department/update/{id}', [App\Http\Controllers\DepartmentController::class, 'update']);
Route::delete('/department/delete/{id}', [App\Http\Controllers\DepartmentController::class, 'delete']);

// Supir
Route::get('/supir', [App\Http\Controllers\SupirController::class, 'index']);
Route::get('/supir/create', [App\Http\Controllers\SupirController::class, 'create']);
Route::post('/supir/store', [App\Http\Controllers\SupirController::class, 'store']);
Route::get('/supir/edit/{id}', [App\Http\Controllers\SupirController::class, 'edit']);
Route::patch('/supir/update/{id}', [App\Http\Controllers\SupirController::class, 'update']);
Route::delete('/supir/delete/{id}', [App\Http\Controllers\SupirController::class, 'delete']);

// Kertas
Route::get('/kertas', [App\Http\Controllers\KertasController::class, 'index']);
Route::get('/kertas/create', [App\Http\Controllers\KertasController::class, 'create']);
Route::post('/kertas/store', [App\Http\Controllers\KertasController::class, 'store']);
Route::get('/kertas/edit/{id}', [App\Http\Controllers\KertasController::class, 'edit']);
Route::patch('/kertas/update/{id}', [App\Http\Controllers\KertasController::class, 'update']);
Route::delete('/kertas/delete/{id}', [App\Http\Controllers\KertasController::class, 'delete']);

// Pengecekan Mobil
Route::get('/pengecekan', [App\Http\Controllers\PengecekanMobilController::class, 'index'])->name('pengecekan.index');
Route::get('/pengecekan/create', [App\Http\Controllers\PengecekanMobilController::class, 'create']);
Route::post('/pengecekan/store', [App\Http\Controllers\PengecekanMobilController::class, 'store']);
Route::get('/pengecekan/view/{id}', [App\Http\Controllers\PengecekanMobilController::class, 'view']);
Route::get('/pengecekan/edit/{id}', [App\Http\Controllers\PengecekanMobilController::class, 'edit'])->name('pengecekan.edit');
Route::patch('/pengecekan/update/{id}', [App\Http\Controllers\PengecekanMobilController::class, 'update'])->name('pengecekan.update');
Route::delete('/pengecekan/delete/{id}', [App\Http\Controllers\PengecekanMobilController::class, 'delete']);

// Pengiriman
Route::get('/pengiriman', [App\Http\Controllers\PengirimanController::class, 'index'])->name('pengiriman.index');
Route::get('/pengiriman/create', [App\Http\Controllers\PengirimanController::class, 'create']);
Route::post('/pengiriman/store', [App\Http\Controllers\PengirimanController::class, 'store']);
Route::get('/pengiriman/view/{id}', [App\Http\Controllers\PengirimanController::class, 'view']);
Route::get('/pengiriman/edit/{id}', [App\Http\Controllers\PengirimanController::class, 'edit'])->name('pengiriman.edit');
Route::patch('/pengiriman/update/{id}', [App\Http\Controllers\PengirimanController::class, 'update'])->name('pengiriman.update');
Route::delete('/pengiriman/delete/{id}', [App\Http\Controllers\PengirimanController::class, 'delete']);
Route::get('/get-pengecekan-mobil', [App\Http\Controllers\PengirimanController::class, 'getPengecekanMobil']);


Route::get('/kertas/{id}/lokasi', function ($id) {
    $kertas = App\Models\Kertas::find($id);
    return response()->json([
        'lokasi' => $kertas ? $kertas->lokasi : ''
    ]);
});


// Laporan Pengecekan
Route::get('/laporan-pengecekan', [App\Http\Controllers\LaporanPengecekanController::class, 'index']);
Route::get('/cetak-laporan-pengecekan/{tanggal_awal}/{tanggal_akhir}', [App\Http\Controllers\LaporanPengecekanController::class, 'printPengecekan']);

Route::get('/get-pengecekan-data', [App\Http\Controllers\LaporanPengecekanController::class, 'getPengirimanData']);

// Laporan Pengiriman
Route::get('/laporan-pengiriman', [App\Http\Controllers\LaporanPengirimanController::class, 'index']);
Route::get('/cetak-laporan-pengiriman/{tanggal_awal}/{tanggal_akhir}', [App\Http\Controllers\LaporanPengirimanController::class, 'printPengiriman']);

Route::get('/get-pengiriman-data', [App\Http\Controllers\LaporanPengirimanController::class, 'getPengirimanData']);

