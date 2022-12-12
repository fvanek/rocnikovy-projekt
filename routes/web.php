<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
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

//User
Route::get('/login', [UserController::class, 'RedirectToLoginPage'])->name('login');
Route::get('/register', [UserController::class, 'RedirectToRegisterPage'])->name('register');
Route::get('/profile/{id}', [UserController::class, 'RedirectToProfilePage'])->name('profile');
Route::post('/login', [UserController::class, 'Login'])->name('login');
Route::post('/register', [UserController::class, 'Register'])->name('register');
Route::post('/logout', [UserController::class, 'Logout'])->name('logout');
Route::post('/profile/update', [UserController::class, 'UpdateProfile'])->name('profile/update');
Route::post('/profile/delete', [UserController::class, 'DeleteProfile'])->name('profile/delete');

//Socialite
Route::get('/googlelogin', [UserController::class, 'RedirectToGoogle'])->name('googlelogin');
Route::get('/google/callback', [UserController::class, 'GoogleCallback']);

//Subforum
Route::get('/subforums', [SubforumController::class, 'RedirectToSubforumsPage'])->name('subforums');
Route::get('/subforum/{id}', [SubforumController::class, 'RedirectToSubforumPage'])->name('subforum');
Route::post('/subforum/create', [SubforumController::class, 'CreateSubforum'])->name('subforum/create');
Route::delete('/subforum/{subforum}', [SubforumController::class, 'DeleteSubforum'])->name('subforum/delete');
Route::put('/subforum/{subforum}', [SubforumController::class, 'UpdateSubforum'])->name('subforum/update');

//Post
Route::post('/post/create', [PostController::class, 'CreatePost'])->name('post/create');
Route::get('/post/{id}', [PostController::class, 'RedirectToPostPage'])->name('post');
Route::delete('/post/{post}', [PostController::class, 'DeletePost'])->name('post/delete');
Route::get('/posts/favorites', [PostController::class, 'RedirectToFavoritesPage'])->name('posts/favorites');
Route::get('/posts/mine', [PostController::class, 'RedirectToMyPostsPage'])->name('posts/mine');

//Like
Route::post('/post/like', [LikeController::class, 'LikePost'])->name('post/like');

//Comment
Route::post('/comment/create', [CommentController::class, 'CreateComment'])->name('comment/create');
Route::delete('/comment/{comment}', [CommentController::class, 'DeleteComment'])->name('comment/delete');

//Search
Route::get('/search', [SearchController::class, 'Search'])->name('search');