<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $ukms = \App\Models\Ukm::all();
    return view('index', compact('ukms'));
})->name('home');

Route::get('/form', [App\Http\Controllers\PendaftaranController::class, 'showForm'])->name('form');
Route::post('/daftar', [App\Http\Controllers\PendaftaranController::class, 'store'])->name('daftar.post');

Route::get('/profil', function () {
    $fasilitas = \App\Models\Fasilitas::all();
    return view('profil', compact('fasilitas'));
})->name('profil');

Route::prefix('admin')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');



        // Pendaftaran
        Route::get('/pendaftaran/export-pdf', [App\Http\Controllers\Admin\PendaftaranController::class, 'exportPdf'])->name('admin.pendaftaran.exportPdf');
        Route::get('/pendaftaran', [App\Http\Controllers\Admin\PendaftaranController::class, 'index'])->name('admin.pendaftaran.index');
        Route::post('/pendaftaran/{id}', [App\Http\Controllers\Admin\PendaftaranController::class, 'update'])->name('admin.pendaftaran.update');

        Route::resource('admins', App\Http\Controllers\Admin\AdminController::class, ['as' => 'admin']);

        // UKM
        Route::get('/ukm/export-pdf', [App\Http\Controllers\Admin\UkmController::class, 'exportPdf'])->name('admin.ukm.exportPdf');
        Route::resource('ukm', App\Http\Controllers\Admin\UkmController::class, ['as' => 'admin']);

        // Penilaian / SPK Routes
        Route::get('penilaian/ranking/export-pdf', [App\Http\Controllers\Admin\PenilaianController::class, 'exportPdf'])->name('admin.penilaian.exportPdf');
        Route::get('penilaian/ranking', [App\Http\Controllers\Admin\PenilaianController::class, 'ranking'])->name('admin.penilaian.ranking');
        Route::resource('penilaian', App\Http\Controllers\Admin\PenilaianController::class, ['as' => 'admin']);

        // Fasilitas
        Route::get('/fasilitas/export-pdf', [App\Http\Controllers\Admin\FasilitasController::class, 'exportPdf'])->name('admin.fasilitas.exportPdf');
        Route::resource('fasilitas', App\Http\Controllers\Admin\FasilitasController::class, ['as' => 'admin']);

        // Kriteria
        Route::get('/kriteria/export-pdf', [App\Http\Controllers\Admin\KriteriaController::class, 'exportPdf'])->name('admin.kriteria.exportPdf');
        Route::resource('kriteria', App\Http\Controllers\Admin\KriteriaController::class, ['as' => 'admin']);
        Route::resource('subkriteria', App\Http\Controllers\Admin\SubKriteriaController::class, ['as' => 'admin']);

        // Mahasiswa
        Route::get('/mahasiswa/export-pdf', [App\Http\Controllers\Admin\MahasiswaController::class, 'exportPdf'])->name('admin.mahasiswa.exportPdf');
        Route::get('/mahasiswa', [App\Http\Controllers\Admin\MahasiswaController::class, 'index'])->name('admin.mahasiswa.index');
        Route::get('/mahasiswa/{id}/edit', [App\Http\Controllers\Admin\MahasiswaController::class, 'edit'])->name('admin.mahasiswa.edit');
        Route::put('/mahasiswa/{id}', [App\Http\Controllers\Admin\MahasiswaController::class, 'update'])->name('admin.mahasiswa.update');
        Route::delete('/mahasiswa/{id}', [App\Http\Controllers\Admin\MahasiswaController::class, 'destroy'])->name('admin.mahasiswa.destroy');
    });
});
