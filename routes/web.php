<?php

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AspirasiController;
use App\Http\Controllers\Admin\DataSiswaController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\NotifikasiController;

use App\Http\Controllers\Siswa\DashboardSiswaController;
use App\Http\Controllers\Siswa\AspirasiSiswaController;

use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| SPLASH
|--------------------------------------------------------------------------
*/

Route::get('/', function (): View {
    return view('splash');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', fn () => view('auth.login'))->name('login');
Route::get('/register', fn () => view('auth.register'))->name('register');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        /*
        |---------------- DASHBOARD ----------------|
        */

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        /*
        |---------------- ASPIRASI ----------------|
        */

        Route::get('/aspirasi', [AspirasiController::class, 'index'])
            ->name('admin.aspirasi');

        Route::get('/aspirasi-selesai', [AspirasiController::class, 'selesai'])
            ->name('admin.aspirasi.selesai');

        Route::get('/aspirasi/search', [AspirasiController::class, 'search'])
            ->name('admin.aspirasi.search');

        Route::get('/aspirasi/{id}/detail', [AspirasiController::class, 'show'])
            ->name('admin.aspirasi.show');

        Route::get('/aspirasi/{id}/edit', [AspirasiController::class, 'edit'])
            ->name('admin.aspirasi.edit');

        Route::put('/aspirasi/{id}', [AspirasiController::class, 'update'])
            ->name('admin.aspirasi.update');

        /*
        |---------------- HISTORY (FIXED) ----------------|
        */

        Route::get('/history', [HistoryController::class, 'index'])
            ->name('admin.history');

        Route::get('/history/search', [HistoryController::class, 'search'])
            ->name('admin.history.search');

        Route::get('/history/{id}/edit', [HistoryController::class, 'edit'])
            ->name('admin.history.edit');


        /*
        |---------------- DATA SISWA ----------------|
        */

        Route::get('/siswa', [DataSiswaController::class, 'index'])
            ->name('admin.siswa');

        Route::post('/siswa/{id}/reset-sandi', [DataSiswaController::class, 'reset'])
            ->name('admin.datasiswa.reset');

        Route::get('/siswa/search', [DataSiswaController::class, 'search'])
            ->name('admin.siswa.search');

        /*
        |---------------- NOTIFIKASI ----------------|
        */

        Route::get('/notifikasi', [NotifikasiController::class, 'admin'])
            ->name('admin.notifikasi');
    });

/*
|--------------------------------------------------------------------------
| PDF EXPORT
|--------------------------------------------------------------------------
*/

Route::get('/admin/aspirasi/pdf', function () {
    return Pdf::loadView('admin.aspirasi.pdf-aspirasi', request()->all())
        ->download('detail-aspirasi.pdf');
})->name('admin.aspirasi.pdf');

/*
|--------------------------------------------------------------------------
| DEBUG (OPSIONAL)
|--------------------------------------------------------------------------
*/

Route::get('/cek-gd', function () {
    phpinfo();
});

/*
|--------------------------------------------------------------------------
| SISWA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'siswa'])->prefix('siswa')->group(function () {

    Route::get('/dashboard', [DashboardSiswaController::class, 'index'])
        ->name('siswa.dashboard');

    Route::get('/siswa/aspirasi', function () {
    return view('siswa.aspirasi');
})->name('siswa.aspirasi');

Route::get('/siswa/status/menunggu', function () {
    return view('siswa.status.menunggu');
})->name('siswa.status.menunggu');

Route::get('/siswa/status/diproses', function () {
    return view('siswa.diproses');
})->name('siswa.status.diproses');

Route::get('/siswa/status/selesai', function () {
    return view('siswa.status.selesai');
})->name('siswa.status.selesai');

Route::get('/siswa/profil', function () {
    return view('siswa.profil');
})->name('siswa.profil');

});