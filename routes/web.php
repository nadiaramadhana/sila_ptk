<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPTKController;
use App\Http\Controllers\KategoriPTKController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\SekolahController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect()->route('login');
});

Route::prefix('login')->middleware('guest')->group(function () {
    Route::get('/', [AuthController::class,'index'])->name('login');

    Route::post('/proses', [AuthController::class,'loginProses'])->name('login-proses');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::prefix("dashboard")->middleware('auth')->group(function() {

    Route::middleware('role:operator_sekolah')->group(function () {
        Route::get('/sekolah-saya', [SekolahController::class, 'mySekolah'])->name('sekolah.my');
    });

    Route::get("/", [DashboardController::class, "index"])->name("dashboard");
    Route::get("/kecamatan", [KecamatanController::class,"index"])->name('kecamatan');
    Route::get("/kecamatan/create", [KecamatanController::class,'create'])->name('kecamatan.create');
    Route::delete("/kecamatan/destroy/{id}", [KecamatanController::class, 'destroy'])->name('kecamatan.destroy');
    Route::post('/kecamatan/store', [KecamatanController::class,'store'])->name('kecamatan.store');

    Route::get('/sekolah', [SekolahController::class, 'index'])->name('sekolah');
    Route::get('/sekolah/create', [SekolahController::class, 'create'])->name('sekolah.create');
    Route::post('/sekolah/store', [SekolahController::class, 'store'])->name('sekolah.store');
    Route::get('/sekolah/show/{id}', [SekolahController::class, 'show'])->name('sekolah.show');
    Route::get('/sekolah/edit/{id}', [SekolahController::class, 'edit'])->name('sekolah.edit');
    Route::put('/sekolah/{id}', [SekolahController::class, 'update'])->name('sekolah.update');
    Route::delete('/sekolah/destroy/{id}', [SekolahController::class, 'destroy'])->name('sekolah.destroy');

    Route::post('/kategori', [KategoriPTKController::class, 'store'])->name('kategori.store');

    Route::get('/data-ptk', [DataPTKController::class, 'index'])->name('data-ptk');
    Route::get('/data-ptk/create', [DataPTKController::class, 'create'])->name('data-ptk.create');
    Route::post('/data-ptk', [DataPTKController::class, 'store'])->name('data-ptk.store');
    Route::get('/data-ptk/show/{id}', [DataPTKController::class, 'show'])->name('data-ptk.show');
    Route::get('/data-ptk/edit/{id}', [DataPTKController::class, 'edit'])->name('data-ptk.edit');
    Route::put('/data-ptk/{id}', [DataPTKController::class, 'update'])->name('data-ptk.update');
    Route::delete('/data-ptk/destroy/{id}', [DataPTKController::class, 'destroy'])->name('data-ptk.destroy');

    // Resource CRUD pengajuan
    Route::resource('pengajuan', PengajuanController::class)->names([
        'index'   => 'pengajuan.index',
        'create'  => 'pengajuan.create',
        'store'   => 'pengajuan.store',
        'show'    => 'pengajuan.show',
        'edit'    => 'pengajuan.edit',
        'update'  => 'pengajuan.update',
        'destroy' => 'pengajuan.destroy',
    ]);

    // Route tambahan: admin ubah status
    Route::patch('pengajuan/{pengajuan}/status', [PengajuanController::class, 'updateStatus'])
         ->name('pengajuan.update-status')
         ->middleware('role:admin');


    Route::get('operator', [OperatorController::class, 'index'])->middleware(['auth', 'role:admin'])->name('operator');
    Route::get('operator/create', [OperatorController::class, 'create'])->name('operator.create');
    Route::post('operator', [OperatorController::class, 'store'])->name('operator.store');
    Route::get('operator/edit/{id}', [OperatorController::class, 'edit'])->name('operator.edit');
    Route::put('operator/{id}', [OperatorController::class, 'update'])->name('operator.update');
    Route::delete('operator/destroy/{id}', [OperatorController::class, 'destroy'])->name('operator.destroy');

});

// Route::get('/dashboard', function() {
//     return view('dashboard.index');~
// })->name('dashboard');


