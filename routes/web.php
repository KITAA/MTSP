<?php

use App\Http\Controllers\MembershipController;
use App\Http\Controllers\InfaqController;
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

Route::get('/home' ,[HomeController::class, 'index'])->middleware('auth')->name('home');

Route::middleware(['auth', 'admin'])->group(function(){//route untuk admin yang sudah login


});

Route::middleware('auth')->group(function () { //route untuk user yang sudah login

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/Ekhairat/Daftar', [MembershipController::class, 'create'])->name('membership.create');
    Route::get('/Ekhairat', [MembershipController::class, 'store'])->name('membership.store');
    Route::post('/membership/confirmation', [MembershipController::class, 'confirmation'])->name('membership.confirmation');
    Route::get('/Ekhairat/confirmation', [MembershipController::class, 'editConfirmation'])->name('membership.editConfirmation');

    Route::get('/Ekhairat/Polisi', [MembershipController::class, 'info'])->name('membership.polisi');

    Route::get('/infaq', [InfaqController::class, 'derma'])->name('infaq.derma');
    Route::post('/infaq/bayar', [InfaqController::class, 'bayar'])->name('infaq.bayar');
    Route::get('/infaq/success', [InfaqController::class, 'success'])->name('infaq.success');
    Route::get('/infaq/cancel', [InfaqController::class, 'cancel'])->name('infaq.cancel');
}); 

Route::post('/webhook', [InfaqController::class, 'webhook'])->name('infaq.webhook');

require __DIR__.'/auth.php';
