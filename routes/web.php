<?php

use App\Http\Controllers\AktivitiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\InfaqController;
use App\Http\Controllers\InformasiController;


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
    return view('dashboard');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::get('/home', [HomeController::class, 'index'])->name('home');


// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/Ekhairat/Senarai', [MembershipController::class, 'index'])->name('membership.index');
    Route::get('/Ekhairat/Senarai/{membership}', [MembershipController::class, 'show'])->name('membership.semak');

    // Berita Umum Routes (Admin-only)
    Route::get('/create_berita', [BeritaController::class, 'create'])->name('create.berita');
    Route::post('/create_berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/edit_berita/{berita}', [BeritaController::class, 'edit'])->name('edit.berita');
    Route::put('/update_berita/{berita}', [BeritaController::class, 'update'])->name('update.berita');
    Route::get('/delete_berita/{berita}', [BeritaController::class, 'destroy'])->name('delete.berita');


    // Aktiviti Masjid Routes (Admin-only)
    Route::get('/berita-masjid/tambah-aktiviti', [AktivitiController::class, 'create'])->name('aktiviti.create');
    Route::post('/berita-masjid/tambah-aktiviti', [AktivitiController::class, 'store'])->name('aktiviti.store');
    Route::get('/berita-masjid/edit-aktiviti/{aktiviti}', [AktivitiController::class, 'edit'])->name('aktiviti.edit');
    Route::put('/berita-masjid/edit-aktiviti/{aktiviti}', [AktivitiController::class, 'update'])->name('aktiviti.update');
    Route::delete('/berita-masjid/delete-aktiviti/{aktiviti}', [AktivitiController::class, 'destroy'])->name('aktiviti.destroy');
});


// Logged In User Routes
Route::middleware('auth')->group(function () {
    // Profile Routes (Logged-in User)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Membership Routes (Logged-in User)
    Route::get('/Ekhairat/Daftar', [MembershipController::class, 'create'])->name('membership.create');
    Route::get('/Ekhairat/Semak', [MembershipController::class, 'index'])->name('membership.index');
    Route::get('/Ekhairat', [MembershipController::class, 'store'])->name('membership.store');
    Route::post('/Ekhairat/confirmation', [MembershipController::class, 'confirmation'])->name('membership.confirmation');
    Route::get('/Ekhairat/confirmation', [MembershipController::class, 'editConfirmation'])->name('membership.editConfirmation');

    Route::get('/Ekhairat/Polisi', [MembershipController::class, 'info'])->name('membership.polisi');
    Route::get('/Ekhairat/edit/{membership}', [MembershipController::class, 'edit'])->name('membership.edit');
    Route::put('/Ekhairat/update/{membership}', [MembershipController::class, 'update'])->name('membership.update');

    // Infaq Routes (Logged-in User)
    Route::get('/infaq', [InfaqController::class, 'derma'])->name('infaq.derma');
    Route::post('/infaq/bayar', [InfaqController::class, 'bayar'])->name('infaq.bayar');
    Route::get('/infaq/success', [InfaqController::class, 'success'])->name('infaq.success');
    Route::get('/infaq/cancel', [InfaqController::class, 'cancel'])->name('infaq.cancel');
});


// Informasi Routes (Public)
Route::get('/visi_misi', [InformasiController::class, 'visi_misi'])->name('visi misi');
Route::get('/carta_organisasi', [InformasiController::class, 'carta_organisasi'])->name('carta organisasi');

// Berita Umum Routes (Public)
Route::get('/berita_umum', [BeritaController::class, 'index'])->name('berita umum');
Route::get('/search', [BeritaController::class, 'search'])->name('search.berita');
Route::get('/details_berita/{berita}', [BeritaController::class, 'show'])->name('details.berita');

// Aktiviti Masjid Routes (Public)
Route::get('/berita-masjid', [BeritaController::class, 'beritaMasjid'])->name('berita-masjid');
Route::get('/berita-masjid/aktiviti', [AktivitiController::class, 'index'])->name('aktiviti.index');
Route::get('/berita-masjid/aktiviti/{aktiviti}', [AktivitiController::class, 'show'])->name('aktiviti.show');
Route::get('/berita-masjid/aktiviti/search', [AktivitiController::class, 'search'])->name('aktiviti.search');


Route::get('/Ekhairat/Polisi', [MembershipController::class, 'info'])->name('membership.polisi');


Route::post('/webhook', [InfaqController::class, 'webhook'])->name('infaq.webhook');


require __DIR__ . '/auth.php';
