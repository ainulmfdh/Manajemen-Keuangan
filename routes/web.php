<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendapatanController;

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

Route::get('/test', function () {
    return view('login');
});

Route::get('/header', function () {
    return view('dashboard/header');
});

Route::get('/sidebar', function () {
    return view('dashboard/sidebar');
});

Route::get('/pengeluaran', function () {
    return view('pengeluaran/index');
});

Route::get('/hutang', function () {
    return view('hutang/index');
});

Route::get('/karyawan', function () {
    return view('karyawan/index');
});

Route::get('/laporan', function () {
    return view('laporan/index');
});


// PENDAPATAN
Route::middleware('auth')->group(function () {
    Route::get('/pendapatan', [PendapatanController::class, 'index'])->name('pendapatan.index');
    Route::post('/pendapatan', [PendapatanController::class, 'store'])->name('pendapatan.store');
    Route::get('/pendapatan/{id}/edit', [PendapatanController::class, 'edit']);
    Route::post('/pendapatan/{id}', [PendapatanController::class, 'update'])->name('pendapatan.update');
    Route::delete('/pendapatan/{id}', [PendapatanController::class, 'destroy'])->name('pendapatan.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
