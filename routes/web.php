<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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
});

Route::view('login','auth.login')->name('login');
Route::post('login', [AuthController::class, 'authenticate']);

Route::view('register','auth.register')->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.store');

Route::view('forgot-password','auth.forgot-password')->name('forgot-password');
Route::post('forgot-password', [AuthController::class, 'forgot_password'])->name('password.email');
