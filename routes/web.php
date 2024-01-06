<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MembershipController;

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

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::middleware(['auth', 'admin'])->group(function () { //route untuk admin yang sudah login

    //Berita Masjid routes for admin


});

Route::middleware('auth')->group(function () { //route untuk user yang sudah login
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/Ekhairat/Daftar', [MembershipController::class, 'create'])->name('membership.create');
    Route::get('/Ekhairat', [MembershipController::class, 'store'])->name('membership.store');
    Route::post('/membership/confirmation', [MembershipController::class, 'confirmation'])->name('membership.confirmation');
    Route::get('/Ekhairat/confirmation', [MembershipController::class, 'editConfirmation'])->name('membership.editConfirmation');
});

//Berita Masjid routes for visitors
Route::get('/berita-masjid', [BeritaController::class, 'beritaMasjid'])->name('berita-masjid');
Route::get('/berita-masjid/aktiviti', [BeritaController::class, 'aktiviti'])->name('berita.aktiviti');
Route::get('/berita-masjid/tambah-aktiviti', [BeritaController::class, 'createAktiviti'])->name('berita.createAktiviti'); // nanti pindah dalam middleware admin
Route::post('/berita-masjid/tambah-aktiviti', [BeritaController::class, 'storeAktiviti'])->name('berita.storeAktiviti'); // nanti pindah dalam middleware admin
Route::get('/berita-masjid/aktiviti/{aktiviti}', [BeritaController::class, 'showAktiviti'])->name('berita.showAktiviti');
Route::get('/berita-masjid/edit-aktiviti/{aktiviti}', [BeritaController::class, 'editAktiviti'])->name('berita.editAktiviti'); //tak siap
Route::put('/berita-masjid/edit-aktiviti/{aktiviti}', [BeritaController::class, 'updateAktiviti'])->name('berita.updateAktiviti'); // nanti pindah dalam middleware admin
Route::delete('/berita-masjid/delete-aktiviti/{aktiviti}', [BeritaController::class, 'destroyAktiviti'])->name('berita.destroyAktiviti'); // nanti pindah dalam middleware admin

Route::get('/Ekhairat/Polisi', [MembershipController::class, 'info'])->name('membership.polisi');

require __DIR__ . '/auth.php';
