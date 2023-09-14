<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AngkatanController;
use App\Http\Controllers\Auth\LoginWaliController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\NotifyController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PembayaranWaliController;
use App\Http\Controllers\ProfileWaliController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TagihanWaliController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaliMuridController;
use App\Http\Controllers\WaliSiswaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

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

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Admin
Route::middleware(['IsAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('profile', [AdminController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [AdminController::class, 'update'])->name('profile.update');
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
    Route::get('/kelas/getJurusan/{id}', [KelasController::class, 'getJurusan'])->name('admin.getJurusan');
    Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');
    Route::get('/kelas/edit/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
    Route::resource('/instansi', BankController::class);
    Route::resource('/jurusan', JurusanController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/murid', MuridController::class);
    Route::resource('/walimurid', WaliMuridController::class);
    Route::resource('/biaya', BiayaController::class);
    Route::resource('/instansi', InstansiController::class);
    Route::resource('/tagihan', TagihanController::class);
    Route::resource('/laporan', LaporanController::class);
    Route::resource('/angkatan', AngkatanController::class);
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::get('/pembayaran/detail/{id}', [PembayaranController::class, 'show'])->name('pembayaran.detail');
    Route::post('/pembayaran/detail/confirm/{id}', [PembayaranController::class, 'confirm'])->name('pembayaran.detail.confirm');
    Route::get('/bayar/{id}', [TagihanController::class, 'bayarIpaymu'])->name('bayar');
    Route::get('/laporan-tagihan', [PdfController::class, 'tagihan'])->name('laporan.tagihan');
    Route::get('/laporan-pembayaran', [PdfController::class, 'pembayaran'])->name('laporan.pembayaran');
    Route::post('/laporan-tagihan/pdf', [LaporanController::class, 'Pdf'])->name('laporan.pdf');
    Route::get('/pesan-whatsaap', [NotifyController::class, 'index'])->name('pesan-whatsaap.index');
    Route::get('/pesan-whatsaap/edit/{id}', [NotifyController::class, 'edit'])->name('pesan-whatsaap.edit');
    Route::put('/pesan-whatsaap/{id}', [NotifyController::class, 'update'])->name('pesan-whatsaap.update');

    // Route::get('/laporan', [])
});

Route::get('login-wali', [LoginWaliController::class, 'index'])->name('login-wali');
Route::post('loginprocess', [LoginWaliController::class, 'loginprocess'])->name('login-wali-process');

//Wali
Route::middleware(['Wali'])->group(function () {
    Route::get('/wali', [LoginWaliController::class, 'dashboard'])->name('wali.dashboard');
    Route::get('/profile', [ProfileWaliController::class, 'edit'])->name('profile.edit');
    Route::get('wali/siswa', [WaliSiswaController::class, 'index'])->name('wali.siswa.index');
    Route::get('/tagihan', [TagihanWaliController::class, 'index'])->name('wali.tagihan.index');
    Route::get('/tagihan/detail/{id}/{idmurid}', [TagihanWaliController::class, 'detail'])->name('wali.tagihan.detail');
    Route::get('/tagihan/pembayaran/{id}/{idmurid}', [PembayaranWaliController::class, 'index'])->name('wali.tagihan.pembayaran');
    Route::post('/tagihan/pembayaran/bank/{id}/{idmurid}', [PembayaranWaliController::class, 'bank'])->name('wali.tagihan.pembayaran.bank');
    Route::get('/tagihan/pilih_pembayaran/{id}/{idmurid}', [PembayaranWaliController::class, 'pilih_pembayaran'])->name('wali.tagihan.pilih_pembayaran');
    Route::post('/tagihan/bayar/{id}/{idmurid}', [PembayaranWaliController::class, 'bayar'])->name('wali.tagihan.bayar');
    Route::post('/tagihan/pembayaran/create', [PembayaranWaliController::class, 'create'])->name('wali.tagihan.bayar.create');
    Route::get('admin/spp/pdf/{id_users}', [PdfController::class, 'spp'])->name('admin.spp.pdf');
});
