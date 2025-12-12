<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\MaskapaiController;
use App\Http\Controllers\BandaraController;
use App\Http\Controllers\PesawatController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

Route::get('/maskapai', [MaskapaiController::class, 'index'])->name('maskapai');
Route::get('/maskapai/create', [MaskapaiController::class, 'create'])->name('maskapai.create');
Route::post('/maskapai', [MaskapaiController::class, 'store'])->name('maskapai.store');
Route::get('/maskapai/{id}/edit', [MaskapaiController::class, 'edit'])->name('maskapai.edit');
Route::put('/maskapai/{id}', [MaskapaiController::class, 'update'])->name('maskapai.update');
Route::delete('/maskapai/{id}', [MaskapaiController::class, 'destroy'])->name('maskapai.destroy');
Route::get('/bandara', [BandaraController::class, 'index'])->name('bandara');
Route::get('/bandara/create', [BandaraController::class, 'create'])->name('bandara.create');
Route::post('/bandara', [BandaraController::class, 'store'])->name('bandara.store');
Route::get('/bandara/{id}/edit', [BandaraController::class, 'edit'])->name('bandara.edit');
Route::put('/bandara/{id}', [BandaraController::class, 'update'])->name('bandara.update');
Route::delete('/bandara/{id}', [BandaraController::class, 'destroy'])->name('bandara.destroy');

Route::get('/pesawat', [PesawatController::class, 'index'])->name('pesawat');
Route::get('/pesawat/create', [PesawatController::class, 'create'])->name('pesawat.create');
Route::post('/pesawat', [PesawatController::class, 'store'])->name('pesawat.store');
Route::get('/pesawat/{id}/edit', [PesawatController::class, 'edit'])->name('pesawat.edit');
Route::put('/pesawat/{id}', [PesawatController::class, 'update'])->name('pesawat.update');
Route::delete('/pesawat/{id}', [PesawatController::class, 'destroy'])->name('pesawat.destroy');

Route::get('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');