<?php

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\AspirasiController;
use App\Http\Controllers\Admin\DataSiswaController;
use App\Http\Controllers\Admin\HistoryController;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Aspirasi;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===================== SPLASH =====================
Route::get('/', function (): View {
    return view('splash');
});

// ===================== AUTH =====================
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::get('/register', fn () => view('auth.register'))->name('register');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ===================== ADMIN =====================
Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        // ASPIRASI (MENUNGGU & DIPROSES)
        Route::get('/aspirasi', [AspirasiController::class, 'index'])
            ->name('admin.aspirasi');

        // ASPIRASI SEARCH
        Route::get('/aspirasi/search', [AspirasiController::class, 'search'])
            ->name('admin.aspirasi.search');

        // ===== POPUP ROUTES =====
        Route::get('/aspirasi/{id}/detail', [AspirasiController::class, 'show'])
            ->name('admin.aspirasi.show');

        Route::get('/aspirasi/{id}/edit', [AspirasiController::class, 'edit'])
            ->name('admin.aspirasi.edit');

        // SISWA
        Route::get('/siswa', [DataSiswaController::class, 'index'])
            ->name('admin.siswa');

        Route::post('/siswa/{id}/reset-sandi', [DataSiswaController::class, 'reset'])
            ->name('admin.datasiswa.reset');

        Route::get('/siswa/search', [DataSiswaController::class, 'search'])
            ->name('admin.siswa.search');

        Route::put('/admin/aspirasi/{id}', [AspirasiController::class,'update'])
            ->name('admin.aspirasi.update');
        
        // HISTORY
Route::get('/history', [HistoryController::class, 'index'])
    ->name('admin.history');

Route::get('/history/search', [HistoryController::class, 'search'])
    ->name('admin.history.search');

Route::get('/history/{id}/detail', [HistoryController::class, 'show'])
    ->name('admin.history.show');

Route::get('/history/{id}/edit', [HistoryController::class, 'edit'])
    ->name('admin.history.edit');




    });

Route::get('/admin/aspirasi/pdf', function () {
    return Pdf::loadView('admin.aspirasi.pdf-aspirasi', request()->all())
        ->download('detail-aspirasi.pdf');
})->name('admin.aspirasi.pdf');

Route::get('/cek-gd', function () {
    phpinfo();
});

