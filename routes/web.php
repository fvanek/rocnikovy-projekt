<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubforumController;

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
Route::get('/profile', [UserController::class, 'RedirectToProfilePage'])->name('profile');
Route::get('/subforums', [SubforumController::class, 'RedirectToSubforumsPage'])->name('subforums');

//User
Route::post('/login', [UserController::class, 'Login'])->name('login');
Route::post('/register', [UserController::class, 'Register'])->name('register');
Route::post('/logout', [UserController::class, 'Logout'])->name('logout');
Route::post('/profile', [UserController::class, 'UpdateProfile'])->name('profile');
Route::post('/profile/delete', [UserController::class, 'DeleteProfile'])->name('profile/delete');

//Socialite
Route::get('/googlelogin', [UserController::class, 'RedirectToGoogle'])->name('googlelogin');
Route::get('/google/callback', [UserController::class, 'GoogleCallback']);

//Subforum
Route::post('/subforum/create', [SubforumController::class, 'CreateSubforum'])->name('subforum/create');