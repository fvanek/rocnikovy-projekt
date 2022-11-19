<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;

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

//Redirects
Route::get('/', [Controller::class, 'home'])->name('home');
Route::get('/login', [UserController::class, 'RedirectToLoginPage'])->name('login');
Route::get('/register', [UserController::class, 'RedirectToRegisterPage'])->name('register');

//Auth
Route::post('/login', [UserController::class, 'Login'])->name('login');
Route::post('/register', [UserController::class, 'Register'])->name('register');
Route::post('/logout', [UserController::class, 'Logout'])->name('logout');
