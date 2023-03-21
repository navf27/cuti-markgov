<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DailyReportController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\FingerprintController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalCutiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PegawaiController;
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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
    Route::post('/changeMode', [App\Http\Controllers\HomeController::class, 'changeMode'])->name('changeMode');
    Route::get('password', [PasswordController::class, 'edit'])->name('user.password.edit');
    Route::patch('password', [PasswordController::class, 'update'])->name('user.password.update');
    Route::post('/changeAvatar', [HomeController::class, 'changeAvatar'])->name('user.avatar.change');
    Route::post('/changeBiodata', [HomeController::class, 'changeBiodata'])->name('user.biodata.change');

    // role admin
    Route::middleware(['admin'])->group(function () {
        // CRUD Divisi
        Route::get('/divisi/trash', [DivisiController::class, 'index'])->name('divisi.trash');
        Route::post('/divisi/trash/{id}/restore', [DivisiController::class, 'restore'])->name('divisi.restore');
        Route::delete('/divisi/trash/{id}/destroy', [DivisiController::class, 'destroyPermanent'])->name('divisi.destroyPermanent');
        Route::resource('/divisi', DivisiController::class)->except('index', 'show');

        // Rekap Laporan
        Route::get('/laporan', [LaporanController::class, 'indexLaporan'])->name('cuti.laporan.index');
        Route::get('/laporan/{id_pegawai}/show', [LaporanController::class, 'showLaporanPegawai'])->name('cuti.laporan.show');
        Route::get('/laporan/data', [LaporanController::class, 'getDataLaporan'])->name('cuti.laporan.data');
        Route::get('/laporan/pegawai/data', [LaporanController::class, 'getLaporanPegawai'])->name('cuti.laporan.pegawai.data');
        Route::get('laporan/{id}/pengajuan', [LaporanController::class, 'showPengajuan'])->name('cuti.pengajuan.show');
        Route::get('/laporan/cetak', [LaporanController::class, 'cetakLaporan'])->name('cuti.laporan.cetak');

        // Cuti Management
        Route::get('/cuti/admin', [CutiController::class, 'indexAdmin'])->name('cuti.admin.index');
        Route::get('/cuti/admin/show/{id}', [CutiController::class, 'show'])->name('cuti.admin.show');
        Route::post('/cuti/admin/updateStatus', [CutiController::class, 'updateStatus'])->name('cuti.admin.updateStatus');
        Route::post('/cuti/admin/validasi', [CutiController::class, 'validasi'])->name('cuti.admin.validasi');

        // fingerprint
        Route::get('/cuti/admin/fingerprint', [FingerprintController::class, 'checkFingerprint'])->name('cuti.admin.fingerprint');
        Route::get('/cuti/admin/fingerprint/getBymonth', [FingerprintController::class, 'getByMonth'])->name('cuti.admin.fingerprint.getByMonth');
        Route::post('/cuti/admin/fingerprint', [FingerprintController::class, 'importExcel'])->name('cuti.admin.fingerprint.check');
        Route::post('/cuti/admin/fingerprint/delete', [FingerprintController::class, 'destroy'])->name('cuti.admin.fingerprint.destroy');

        // CRUD Pegawai
        Route::resource('/pegawai', PegawaiController::class);

        // CRUD Jadwal Cuti dan Libur Nasional
        Route::resource('/jadwal', JadwalCutiController::class)->except('index');

        // Daily report
        Route::get('/admin/daily/report', [DailyReportController::class, 'DailyReport'])->name('admin.daily.report');

    });

    // role kepala
    Route::middleware(['kepala'])->group(function () {
        Route::resource('/pegawai_kepala', PegawaiController::class)->only('index', 'show');
        Route::get('/cuti/kepala', [CutiController::class, 'indexKepala'])->name('cuti.kepala.index');
        Route::get('/cuti/kepala/show/{id}', [CutiController::class, 'show'])->name('cuti.kepala.show');
        Route::post('/cuti/kepala/updateStatus', [CutiController::class, 'updateStatus'])->name('cuti.kepala.updateStatus');
        Route::post('/cuti/kepala/validasi', [CutiController::class, 'validasi'])->name('cuti.kepala.validasi');
        //daily report
        Route::get('/daily/report', [DailyReportController::class, 'DailyReport'])->name('daily.report');
    });

    // CRUD Cuti
    Route::get('/pengajuan/cetak/{id}', [CutiController::class, 'cetakPengajuan'])->name('cuti.pengajuan.cetak');
    Route::resource('/cuti', CutiController::class);

    // CRUD daily
    Route::resource('daily', DailyReportController::class);

    // all access divisi
    Route::resource('/divisi', DivisiController::class)->only('index', 'show');

    // all access jadwal cuti
    Route::resource('/jadwal', JadwalCutiController::class)->only('index');

    Route::get('provinsi', [PegawaiController::class, 'getProvinsi'])->name('getProvinsi');
    Route::get('getkota/{id}', [PegawaiController::class, 'getKota'])->name('getKota');
    Route::get('getkecamatan/{id}', [PegawaiController::class, 'getKecamatan'])->name('getKecamatan');
    Route::get('getdesa/{id}', [PegawaiController::class, 'getDesa'])->name('getDesa');

    Route::get('/cities', [PegawaiController::class, 'cities'])->name('cities');
    Route::get('/districts', [PegawaiController::class, 'districts'])->name('districts');
    Route::get('/villages', [PegawaiController::class, 'villages'])->name('villages');
    Route::get('/pj', [PegawaiController::class, 'pj_sementara'])->name('pj');
    Route::get('/listPegawai', [PegawaiController::class, 'listPegawai'])->name('listPegawai');
});

Route::get('/updateStatusEmail', [CutiController::class, 'updateStatusEmail'])->name('updateStatusEmail');

Route::get('/validasiEmail', [CutiController::class, 'validasiEmail'])->name('validasiEmail');

Route::get('/importExcel', [PegawaiController::class, 'importExcel']);

Route::get('/error_email', function () {
    return view('error_email');
})->name('errorEmail');
