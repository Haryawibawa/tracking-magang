<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
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


Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes();
Route::middleware('auth')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    //super-admin-route
    Route::middleware('can:only.superadmin')->group(function () {
        Route::prefix('presensi-mhs')->group(function () {
            Route::get('/', [App\Http\Controllers\PresensiMhsController::class, 'index'])->name('super.presensi.index');
            Route::get('/show', [App\Http\Controllers\PresensiMhsController::class, 'show'])->name('super.presensi.show');
            Route::get('/detail/{id}', [App\Http\Controllers\PresensiMhsController::class, 'detail'])->name('super.presensi.detail');
        });
        Route::prefix('logbook-mhs')->group(function () {
            Route::get('/', [App\Http\Controllers\LogbookController::class, 'index'])->name('super.logbook.index');
            Route::get('/show', [App\Http\Controllers\LogbookController::class, 'show'])->name('super.logbook.show');
            Route::post('/approve/{id}', [App\Http\Controllers\LogbookController::class, 'approve'])->name('super.logbook.approve');
            Route::post('/rejected/{id}', [App\Http\Controllers\LogbookController::class, 'rejected'])->name('super.logbook.rejected');
        });
        Route::prefix('universitas')->group(function () {
            Route::get('/', [App\Http\Controllers\UniversitasController::class, 'index'])->name('super.univ.index');
            Route::get('/show', [App\Http\Controllers\UniversitasController::class, 'show'])->name('super.univ.show');
            Route::post('/store', [App\Http\Controllers\UniversitasController::class, 'store'])->name('super.univ.store');
            Route::get('/edit/{id}', [App\Http\Controllers\UniversitasController::class, 'edit'])->name('super.univ.edit');
            Route::post('/update/{id}', [App\Http\Controllers\UniversitasController::class, 'update'])->name('super.univ.update');
            Route::post('/status/{id}', [App\Http\Controllers\UniversitasController::class, 'status'])->name('super.univ.status');
            Route::delete('/destroy/{id}', [App\Http\Controllers\UniversitasController::class, 'delete'])->name('super.univ.delete');
        });
        Route::prefix('fakultas')->group(function () {
            Route::get('/', [App\Http\Controllers\FakultasController::class, 'index'])->name('super.fakultas.index');
            Route::get('/show', [App\Http\Controllers\FakultasController::class, 'show'])->name('super.fakultas.show');
            Route::post('/store', [App\Http\Controllers\FakultasController::class, 'store'])->name('super.fakultas.store');
            Route::get('/edit/{id}', [App\Http\Controllers\FakultasController::class, 'edit'])->name('super.fakultas.edit');
            Route::post('/update/{id}', [App\Http\Controllers\FakultasController::class, 'update'])->name('super.fakultas.update');
            Route::post('/status/{id}', [App\Http\Controllers\FakultasController::class, 'status'])->name('super.fakultas.status');
            Route::delete('/destroy/{id}', [App\Http\Controllers\FakultasController::class, 'delete'])->name('super.fakultas.delete');
        });

        Route::prefix('prodi')->group(function () {
            Route::get('/', [App\Http\Controllers\ProdiController::class, 'index'])->name('super.prodi.index');
            Route::get('/show', [App\Http\Controllers\ProdiController::class, 'show'])->name('super.prodi.show');
            Route::post('/store', [App\Http\Controllers\ProdiController::class, 'store'])->name('super.prodi.store');
            Route::get('/edit/{id}', [App\Http\Controllers\ProdiController::class, 'edit'])->name('super.prodi.edit');
            Route::post('/update/{id}', [App\Http\Controllers\ProdiController::class, 'update'])->name('super.prodi.update');
            Route::post('/status/{id}', [App\Http\Controllers\ProdiController::class, 'status'])->name('super.prodi.status');
            Route::delete('/destroy/{id}', [App\Http\Controllers\ProdiController::class, 'delete'])->name('super.prodi.delete');
        });
        
        Route::prefix('mahasiswa')->group(function () {
            Route::get('/', [App\Http\Controllers\MahasiswaController::class, 'index'])->name('super.mhs.index');
            Route::get('/show', [App\Http\Controllers\MahasiswaController::class, 'show'])->name('super.mhs.show');
            Route::post('/store', [App\Http\Controllers\MahasiswaController::class, 'store'])->name('super.mhs.store');
            Route::get('/edit/{id}', [App\Http\Controllers\MahasiswaController::class, 'edit'])->name('super.mhs.edit');
            Route::post('/update/{id}', [App\Http\Controllers\MahasiswaController::class, 'update'])->name('super.mhs.update');
            Route::post('/status/{id}', [App\Http\Controllers\MahasiswaController::class, 'status'])->name('super.mhs.status');
        });

        Route::prefix('masa-magang')->group(function () {
            Route::get('/', [App\Http\Controllers\MasaMagangController::class, 'index'])->name('super.masa.index');
            Route::get('/show', [App\Http\Controllers\MasaMagangController::class, 'show'])->name('super.masa.show');
            Route::get('/store', [App\Http\Controllers\MasaMagangController::class, 'store'])->name('super.masa.store');
            Route::get('/edit/{id}', [App\Http\Controllers\MasaMagangController::class, 'edit'])->name('super.masa.edit');
            Route::post('/update/{id}', [App\Http\Controllers\MasaMagangController::class, 'update'])->name('super.masa.update');
            Route::post('/status/{id}', [App\Http\Controllers\MasaMagangController::class, 'status'])->name('super.masa.status');
            Route::delete('/destroy/{id}', [App\Http\Controllers\MasaMagangController::class, 'delete'])->name('super.masa.delete');
        });

        Route::prefix('pegawai')->group(function () {
            Route::get('/', [App\Http\Controllers\PegawaiController::class, 'index'])->name('super.pegawai.index');
            Route::get('/show', [App\Http\Controllers\PegawaiController::class, 'show'])->name('super.pegawai.show');
            Route::post('/store', [App\Http\Controllers\PegawaiController::class, 'store'])->name('super.pegawai.store');
            Route::get('/edit/{id}', [App\Http\Controllers\PegawaiController::class, 'edit'])->name('super.pegawai.edit');
            Route::post('/update/{id}', [App\Http\Controllers\PegawaiController::class, 'update'])->name('super.pegawai.update');
            Route::post('/status/{id}', [App\Http\Controllers\PegawaiController::class, 'status'])->name('super.pegawai.status');
        });
    });

    //supervisor-route
    Route::middleware('can:only.supervisor')->group(function () {
        Route::prefix('spv-presensi-mhs')->group(function () {
            Route::get('/', [App\Http\Controllers\SpvPresensiMhsController::class, 'index'])->name('spv.presensi');
        });
    });

    //mahasiswa-route
    Route::middleware('can:only.mahasiswa')->group(function () {
        Route::prefix('presensi')->group(function () {
            Route::get('/', [App\Http\Controllers\PresensiController::class, 'index'])->name('mhs.presensi');
        });
    });

});

