<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
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

Route::get('/', HomeController::class);
Route::get('articles', [ArticleController::class,'index']);
Route::get('articles/create', [ArticleController::class,'create'])->middleware(['auth'])->name('articles.create');
Route::post('articles', [ArticleController::class,'store'])->middleware(['auth']);
Route::get('articles/{article:slug}', [ArticleController::class,'show'])->name('articles.show');
Route::get('articles/{article}/edit', [ArticleController::class,'edit'])->middleware(['auth'])->name('articles.edit');
Route::put('articles/{article}', [ArticleController::class,'update'])->middleware(['auth']);
Route::delete('articles/{article}', [ArticleController::class,'destroy'])->middleware(['auth']);
Route::post('articles/{article}/comments', [CommentController::class,'store'])->middleware(['auth']);
Route::get('tags/{tag:slug}', [TagController::class,'show'])->name('tags.show');
Route::get('login', [SessionController::class,'create'])->middleware(['guest'])->name('login');
Route::post('login', [SessionController::class,'store'])->middleware(['guest']);
Route::delete('logout', [SessionController::class,'destroy'])->middleware(['auth']);
Route::get('register', [UserController::class,'create'])->middleware(['guest']);
Route::post('register', [UserController::class,'store']);
Route::get('users/{name}', [UserController::class,'show']);
Route::get('settings', [UserController::class,'edit'])->middleware(['auth']);
Route::put('user', [UserController::class,'update'])->middleware(['auth']);
