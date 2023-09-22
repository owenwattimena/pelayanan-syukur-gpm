<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\JemaatController;
use App\Http\Controllers\Admin\KelahiranController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PengurusSektorController;
use App\Http\Controllers\Admin\PernikahanController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PushNotificationController;
use App\Http\Controllers\Admin\SektorController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\VerifikasiController;
use Illuminate\Support\Facades\Auth;
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


    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::prefix('/jemaat')->group(function () {
        Route::get('/', [JemaatController::class, 'index'])->name('jemaat');
        Route::post('/', [JemaatController::class, 'prosesTambah'])->name('jemaat.tambah');
        Route::put('/{id}', [JemaatController::class, 'prosesUbah'])->name('jemaat.ubah');
        Route::delete('/{id}', [JemaatController::class, 'prosesHapus'])->name('jemaat.hapus');
    });
    Route::prefix('/sektor')->group(function () {
        Route::get('/', [SektorController::class, 'index'])->name('sektor');
        Route::post('/', [SektorController::class, 'prosesTambah'])->name('sektor.tambah');
        Route::put('/{id}', [SektorController::class, 'prosesUbah'])->name('sektor.ubah');
        Route::delete('/{id}', [SektorController::class, 'prosesHapus'])->name('sektor.hapus');
    });
    Route::prefix('/unit')->group(function () {
        Route::get('/', [UnitController::class, 'index'])->name('unit');
        Route::post('/{idSektor}', [UnitController::class, 'prosesTambah'])->name('unit.tambah');
        Route::put('/{idSektor}/{idUnit}', [UnitController::class, 'prosesUbah'])->name('unit.ubah');
        Route::delete('/{idSektor}/{idUnit}', [UnitController::class, 'prosesHapus'])->name('unit.hapus');
    });
    Route::prefix('pengurus-sektor')->group(function(){
        Route::get('/', [PengurusSektorController::class, 'index'])->name('pengurus-sektor');
        Route::post('/', [PengurusSektorController::class, 'prosesTambah'])->name('pengurus-sektor.tambah');
        Route::put('/{id}', [PengurusSektorController::class, 'prosesUbah'])->name('pengurus-sektor.ubah');
        Route::delete('/{id}', [PengurusSektorController::class, 'prosesHapus'])->name('pengurus-sektor.hapus');
    });

    Route::prefix('pengaturan')->group(function(){
        Route::get('/', [PengaturanController::class, 'index'])->name('pengaturan');
        Route::post('/', [PengaturanController::class, 'save'])->name('pengaturan.save');
    });


    Route::get('/pelayanan-pernikahan', [PernikahanController::class, 'index'])->name('pelayanan-pernikahan');
    Route::post('/pelayanan-pernikahan', [PernikahanController::class, 'tambah'])->name('pelayanan-pernikahan.tambah');

    Route::get('/pelayanan-kelahiran', [KelahiranController::class, 'index'])->name('pelayanan-kelahiran');
    Route::post('/pelayanan-kelahiran', [KelahiranController::class, 'tambah'])->name('pelayanan-kelahiran.tambah');

    Route::post('/pengurus-unit', [VerifikasiController::class, 'simpan'])->name('pengurus-unit.simpan');
    Route::put('/pengurus-unit/{id}', [VerifikasiController::class, 'ubah'])->name('pengurus-unit.ubah');
    Route::delete('/pengurus-unit/{id}', [VerifikasiController::class, 'hapus'])->name('pengurus-unit.hapus');

    Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi');
    Route::post('/verifikasi/terima', [VerifikasiController::class, 'terima'])->name('verifikasi.terima');
    Route::post('/verifikasi/tolak', [VerifikasiController::class, 'tolak'])->name('verifikasi.tolak');

    Route::prefix('/push-notification')->group(function () {
        Route::put('/fcm-token', [PushNotificationController::class, 'updateFcmToken'])->name('updateFcmToken');
    });

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/ubah-password', [ProfileController::class, 'ubahPassword'])->name('profile.password');

    Route::get('/keluar', function () {
        Auth::logout();
        return redirect()->route('masuk');
    })->name('keluar');

});

Route::middleware(['guest:admin'])->group(function () {

    Route::get('/masuk', [AuthController::class, 'masuk'])->name('masuk');
    Route::post('/masuk', [AuthController::class, 'prosesMasuk'])->name('masuk.proses');

    Route::get('/daftar', [AuthController::class, 'daftar'])->name('daftar');
    Route::post('/daftar', [AuthController::class, 'prosesDaftar'])->name('daftar.proses');
});
