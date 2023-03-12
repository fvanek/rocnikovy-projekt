<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
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

Route::get('/', [Controller::class, 'home'])->name('home');
Route::get('/about', [Controller::class, 'about'])->name('about');

//User
Route::get('/login', [UserController::class, 'RedirectToLoginPage'])->name('login');
Route::get('/register', [UserController::class, 'RedirectToRegisterPage'])->name('register');
Route::post('/user/auth', [UserController::class, 'Login'])->name('user/auth');
Route::post('/user/store', [UserController::class, 'Register'])->name('user/store');
Route::post('/logout', [UserController::class, 'Logout'])->name('logout');
Route::get('/admin/dashboard', [UserController::class, 'RedirectToAdminDashboard'])->name('admin/dashboard');

Route::group(['prefix' => 'profile'], function () {
    Route::get('/{id}', [UserController::class, 'RedirectToProfilePage'])->name('profile');
    Route::post('/update', [UserController::class, 'UpdateProfile'])->name('profile/update');
    Route::post('/delete', [UserController::class, 'DeleteProfile'])->name('profile/delete');
});

//Socialite
Route::get('/googlelogin', [UserController::class, 'RedirectToGoogle'])->name('googlelogin');
Route::get('/google/callback', [UserController::class, 'GoogleCallback']);

//Subforum
Route::get('/subforums', [SubforumController::class, 'RedirectToSubforumsPage'])->name('subforums');
Route::group(['prefix' => 'subforum'], function () {
    Route::get('/{id}', [SubforumController::class, 'RedirectToSubforumPage'])->name('subforum');
    Route::post('/create', [SubforumController::class, 'CreateSubforum'])->name('subforum/create');
    Route::delete('/{subforum}', [SubforumController::class, 'DeleteSubforum'])->name('subforum/delete');
    Route::put('/{subforum}', [SubforumController::class, 'UpdateSubforum'])->name('subforum/update');
    Route::post('/like', [SubforumController::class, 'LikeSubforum'])->name('subforum/like');
});

//Post
Route::group(['prefix' => 'post'], function () {
    Route::post('/create', [PostController::class, 'CreatePost'])->name('post/create');
    Route::get('/{id}', [PostController::class, 'RedirectToPostPage'])->name('post');
    Route::delete('/{post}', [PostController::class, 'DeletePost'])->name('post/delete');
    Route::post('/like', [PostController::class, 'LikePost'])->name('post/like');
});
Route::get('/posts/favorites', [PostController::class, 'RedirectToFavoritesPage'])->name('posts/favorites');
Route::get('/posts/mine', [PostController::class, 'RedirectToMyPostsPage'])->name('posts/mine');

//Comment
Route::group(['prefix' => 'comment'], function () {
    Route::post('/create', [CommentController::class, 'CreateComment'])->name('comment/create');
    Route::delete('/{comment}', [CommentController::class, 'DeleteComment'])->name('comment/delete');
});

//Search
Route::get('/search', [Controller::class, 'Search'])->name('search');
