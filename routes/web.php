<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, CronJobController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/* ------------------------------- AUTH ROUTES ------------------------------- */
Route::group(['middleware' => 'guest'], function () {
    Route::view('register', 'auth.register')->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register.store');

    Route::view('login', 'auth.login')->name('login');
    Route::post('login', [AuthController::class, 'authenticate']);

    Route::view('forgot-password', 'auth.forgot-password')->name('password.request');
    Route::post('forgot-password', [AuthController::class, 'forgot_password'])->name('password.email');

    Route::get('reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'reset_password'])->name('password.update');

    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify_email'])
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('/email/verification-notification/{user_id}', [
        AuthController::class,
        'resend_verification_email',
    ])->name('verification.send');

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');
