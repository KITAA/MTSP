<?php

use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/home' ,[HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->group(function(){//route untuk admin yang sudah login
    Route::get('/Ekhairat/Senarai', [MembershipController::class, 'index'])->name('membership.index');
    Route::get('/Ekhairat/Senarai/{membership}', [MembershipController::class, 'show'])->name('membership.semak');

});

Route::middleware('auth')->group(function () { //route untuk admin/user yang sudah login
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/Ekhairat/Daftar', [MembershipController::class, 'create'])->name('membership.create');
    Route::get('/Ekhairat/Semak', [MembershipController::class, 'index'])->name('membership.index');
    Route::get('/Ekhairat', [MembershipController::class, 'store'])->name('membership.store');
    Route::post('/Ekhairat/confirmation', [MembershipController::class, 'confirmation'])->name('membership.confirmation');
    Route::get('/Ekhairat/confirmation', [MembershipController::class, 'editConfirmation'])->name('membership.editConfirmation');
    Route::get('/Ekhairat/edit/{membership}', [MembershipController::class, 'edit'])->name('membership.edit');
    Route::put('/Ekhairat/update/{membership}', [MembershipController::class, 'update'])->name('membership.update');
});

Route::get('/Ekhairat/Polisi', [MembershipController::class, 'info'])->name('membership.polisi');

require __DIR__.'/auth.php';
