<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\Auth\LoginWaliController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TagihanWaliController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaliMuridController;
use App\Http\Controllers\WaliSiswaController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Admin
Route::middleware(['IsAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('profile', [AdminController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [AdminController::class, 'update'])->name('profile.update');
    Route::resource('/bank', BankController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/murid', MuridController::class);
    Route::resource('/walimurid', WaliMuridController::class);
    Route::resource('/biaya', BiayaController::class);
    Route::resource('/instansi', InstansiController::class);
    Route::resource('/tagihan', TagihanController::class);
    Route::resource('/laporan', LaporanController::class);
    Route::resource('/angkatan', AngkatanController::class);
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
    Route::get('/pembayaran/detail', [PembayaranController::class, 'show'])->name('pembayaran.detail');
    Route::get('/bayar/{id}', [TagihanController::class, 'bayarIpaymu'])->name('bayar');
    Route::get('/laporan-tagihan', [PdfController::class, 'tagihan'])->name('laporan.tagihan');
    Route::get('/laporan-pembayaran', [PdfController::class, 'pembayaran'])->name('laporan.pembayaran');

    // Route::get('/laporan', [])
});

Route::get('login-wali', [LoginWaliController::class, 'index'])->name('login-wali');
Route::post('loginprocess', [LoginWaliController::class, 'loginprocess'])->name('login-wali-process');

//Wali
Route::middleware(['Wali'])->group(function () {
    Route::get('/wali', [LoginWaliController::class, 'dashboard'])->name('wali.dashboard');
    Route::get('/siswa', [WaliSiswaController::class, 'index'])->name('wali.siswa.index');
    Route::get('wali/siswa', [WaliSiswaController::class, 'index'])->name('wali.siswa.index');
    Route::get('/tagihan', [TagihanWaliController::class, 'index'])->name('wali.tagihan.index');
    Route::get('/tagihan/detail', [TagihanWaliController::class, 'detail'])->name('wali.tagihan.detail');
    Route::get('/tagihan/detail2', [TagihanWaliController::class, 'detail2'])->name('wali.tagihan.detail2');
    Route::get('/tagihan/bayar', [TagihanWaliController::class, 'bayar'])->name('wali.tagihan.bayar');
});

Route::get('logout', function () {
    Auth::user()->logout();
});
