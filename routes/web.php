<?php

use App\Http\Controllers\InformasiController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Informasi
Route::get('/visi_misi', [InformasiController::class, 'visi_misi'])->name('visi misi');

Route::get('/carta_organisasi', [InformasiController::class, 'carta_organisasi'])->name('carta organisasi');

// Berita Masjid

Route::get('/berita_umum', [BeritaController::class, 'index'])->name('berita umum');

Route::get('/search', [BeritaController::class, 'search'])->name('search.berita');

Route::get('/create_berita', [BeritaController::class, 'create'])->name('create.berita');

Route::post('/create_berita', [BeritaController::class, 'store'])->name('berita.store');

Route::get('/details_berita/{berita}', [BeritaController::class, 'show'])->name('details.berita');

Route::get('/edit_berita/{berita}', [BeritaController::class, 'edit'])->name('edit.berita');

Route::put('/update_berita/{berita}', [BeritaController::class, 'update'])->name('update.berita');

Route::get('/delete_berita/{berita}', [BeritaController::class, 'destroy'])->name('delete.berita');

require __DIR__.'/auth.php';
