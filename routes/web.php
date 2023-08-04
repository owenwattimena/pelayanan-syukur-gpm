<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\KelahiranController;
use App\Http\Controllers\Admin\PernikahanController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\VerifikasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth:admin'])->group(function () {


    Route::get('/', function () {
        return view('templates.index');
    })->name('home');

    Route::get('/unit', [UnitController::class, 'index'])->name('unit');
    Route::post('/unit', [UnitController::class, 'prosesTambah'])->name('unit.tambah');

    Route::get('/pelayanan-pernikahan', [PernikahanController::class, 'index'])->name('pelayanan-pernikahan');
    Route::post('/pelayanan-pernikahan', [PernikahanController::class, 'tambah'])->name('pelayanan-pernikahan.tambah');

    Route::get('/pelayanan-kelahiran', [KelahiranController::class, 'index'])->name('pelayanan-kelahiran');
    Route::post('/pelayanan-kelahiran', [KelahiranController::class, 'tambah'])->name('pelayanan-kelahiran.tambah');

    Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi');
    Route::post('/verifikasi/terima', [VerifikasiController::class, 'terima'])->name('verifikasi.terima');
    Route::post('/verifikasi/tolak', [VerifikasiController::class, 'tolak'])->name('verifikasi.tolak');

});

Route::middleware(['guest:admin'])->group(function () {

    Route::get('/masuk', [AuthController::class, 'masuk'])->name('masuk');
    Route::post('/masuk', [AuthController::class, 'prosesMasuk'])->name('masuk.proses');

    Route::get('/daftar', [AuthController::class, 'daftar'])->name('daftar');
    Route::post('/daftar', [AuthController::class, 'prosesDaftar'])->name('daftar.proses');
});
