<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogUserController;

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
Route::get(
    '/users', [BlogUserController::class, 'index']
);
Route::get('/posts',
    [PostController::class, 'index']
)->name('posts.index');
Route::get('/posts/{id}',
    [PostController::class, 'show']
)->name('posts.show');
