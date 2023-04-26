<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChallengeCategoryController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\EquipmentCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;

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
    return ['Laravel' => app()->version()];
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
    Route::put('equipment-categories/restore/{id}', [EquipmentCategoryController::class, 'restore'])->name('equipment-categories.restore');
    Route::put('challenge-categories/restore/{id}', [ChallengeCategoryController::class, 'restore'])->name('challenge-categories.restore');
    Route::put('challenges/restore/{id}', [ChallengeController::class, 'restore'])->name('challenges.restore');
    Route::post('challenges/upload-image', [ChallengeController::class, 'uploadImage'])->name('challenges.uploadImage');

    Route::resource('users', UserController::class);
    Route::resource('challenge-categories', ChallengeCategoryController::class);
    Route::resource('challenges', ChallengeController::class);
    Route::resource('equipment-categories', EquipmentCategoryController::class);
});

Route::get('login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::get('reset-password/{email}/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('resetPassword')->middleware('guest');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

// Route::get('register', [RegisterController::class, 'register']);

require __DIR__.'/auth.php';
