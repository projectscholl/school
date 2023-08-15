<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaliMuridController;
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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Admin
Route::middleware(['IsAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/profile', [AdminController::class, 'edit'])->name('profile');
    Route::resource('/user', UserController::class);
    Route::resource('/murid', MuridController::class);
    Route::resource('/walimurid', WaliMuridController::class);
    Route::resource('/biaya', BiayaController::class);
    Route::resource('/tagihan', TagihanController::class);
    Route::resource('/laporan', LaporanController::class);
    Route::resource('/instansi', InstansiController::class);
    Route::get('/bank', [BankController::class, 'edit'])->name('bank.edit');;
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
    Route::get('/pembayaran/detail', [PembayaranController::class, 'show'])->name('pembayaran.detail');
    // Route::get('/laporan', [])
});

//Wali
Route::middleware(['Wali'])->group(function () {
    Route::get('/wali', [WaliMuridController::class, 'dashboard'])->name('wali.dashboard');
});
