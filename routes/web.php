<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\MaskapaiController;
use App\Http\Controllers\BandaraController;
use App\Http\Controllers\PesawatController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PemesananController;

Route::get('/', [HomepageController::class, 'index'])->name('homepage');
Route::post('/search-flights', [HomepageController::class, 'searchFlights'])->name('search.flights');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard')->middleware('auth');

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
    Auth::logout();
    return redirect('/');
})->name('logout');

// User management (admin)
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Pemesanan (admin)
Route::middleware('auth')->group(function(){
    Route::get('/admin/pemesanan', [PemesananController::class, 'index'])->name('admin.pemesanan.index');
    Route::get('/admin/pemesanan/{id}', [PemesananController::class, 'show'])->name('admin.pemesanan.show');
    Route::put('/admin/pemesanan/{id}', [PemesananController::class, 'updateStatus'])->name('admin.pemesanan.updateStatus');
});

// Health check route for debugging
Route::get('/status', function () {
    return response('OK', 200);
});
