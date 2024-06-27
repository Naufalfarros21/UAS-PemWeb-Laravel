<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MatrixScoreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeleksiController;
use App\Http\Controllers\SubKriteria;
use App\Http\Controllers\TopsisController;
use App\Http\Controllers\UserBerandaController;
use App\Models\Kriteria;
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

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [LoginController::class, 'forgot_password'])->name('forgot-password');
Route::post('/forgot-password-act', [LoginController::class, 'forgot_password_act'])->name('forgot-password-act');

Route::get('/validasi-forgot-password/{token}', [LoginController::class, 'validasi_forgot_password'])->name('validasi-forgot-password');
Route::post('/validasi-forgot-password-act', [LoginController::class, 'validasi_forgot_password_act'])->name('validasi-forgot-password-act');


Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register-proses', [LoginController::class, 'register_proses'])->name('register-proses');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [LoginController::class, 'verifyEmail'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/resend', [LoginController::class, 'resendEmailVerification'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.resend');


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:Admin'], 'as' => 'admin.'], function () {
    Route::get('/beranda', [AdminController::class, 'index'])->name('beranda');

    // Kriteria
    Route::get('/beranda/kriteria', [KriteriaController::class, 'kriteria'])->name('kriteria');
    Route::post('/store', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::put('/update/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
    Route::delete('/delete/{id}', [KriteriaController::class, 'delete'])->name('kriteria.delete');

    Route::get('/beranda/sub-kriteria', [SubKriteria::class, 'sub_kriteria'])->name('sub-kriteria');

    // Alternatif
    Route::get('/beranda/alternatif', [AlternatifController::class, 'alternatif'])->name('alternatif');
    Route::post('/alternatif/store', [AlternatifController::class, 'store'])->name('alternatif.store');
    Route::put('/alternatif/update/{id}', [AlternatifController::class, 'update'])->name('alternatif.update');
    Route::delete('/alternatif/delete/{id}', [AlternatifController::class, 'delete'])->name('alternatif.delete');

    // Matrix Score
    Route::get('/beranda/matrix', [MatrixScoreController::class, 'index'])->name('matrix');
    Route::post('/matrix/store', [MatrixScoreController::class, 'store'])->name('matrix.store');
    Route::put('/matrix/update/{id}', [MatrixScoreController::class, 'update'])->name('matrix.update');
    Route::delete('/matrix/destroy/{id}', [MatrixScoreController::class, 'destroy'])->name('matrix.destroy');

    // Profile
    Route::get('/beranda/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/profile/update-picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.update');
    Route::delete('/profile/delete-picture', [ProfileController::class, 'deleteProfilePicture'])->name('profile.delete');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

    // Perhitungan
    Route::get('/beranda/topsis', [TopsisController::class, 'topsis'])->name('topsis.index');
});
