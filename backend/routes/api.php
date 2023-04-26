<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\ForgotPasswordController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\EquipmentCategoryController;
use App\Http\Controllers\API\EquipmentController;
use App\Http\Controllers\API\ChallengeCategoryController;
use App\Http\Controllers\API\ChallengeController;
use App\Http\Controllers\API\TestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('password/reset-link/{email}', [ForgotPasswordController::class, 'sendPasswordResetCode'])->name('sendPasswordResetCode');
Route::post('password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('resetPassword');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [LogoutController::class, 'logout']);
    Route::get('test', [TestController::class, 'index']);
    Route::get('authenticated', function (Request $request) {
        return new UserResource($request->user());
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/show/{id}', [UserController::class, 'show']);
        Route::post('/create', [UserController::class, 'create']);
        Route::put('/update/{id}', [UserController::class, 'update']);
        Route::delete('/delete/{id}', [UserController::class, 'destroy']);
    });

    Route::prefix('equipment-categories')->group(function () {
        Route::get('/', [EquipmentCategoryController::class, 'index']);
        Route::get('/show/{id}', [EquipmentCategoryController::class, 'show']);
        Route::post('/create', [EquipmentCategoryController::class, 'create']);
        Route::put('/update/{id}', [EquipmentCategoryController::class, 'update']);
        Route::delete('/delete/{id}', [EquipmentCategoryController::class, 'destroy']);
    });

    Route::prefix('challenge-categories')->group(function () {
        Route::get('/', [ChallengeCategoryController::class, 'index']);
    });

    Route::prefix('challenges')->group(function () {
        Route::get('/', [ChallengeController::class, 'index']);
        Route::get('toggle-completed/{id}', [ChallengeController::class, 'toggleCompleted']);
    });

    Route::prefix('equipments')->group(function () {
        Route::get('/', [EquipmentController::class, 'index']);
        Route::get('/show/{id}', [EquipmentController::class, 'show']);
        Route::post('/create', [EquipmentController::class, 'create']);
        Route::post('/update/{id}', [EquipmentController::class, 'update']);
        Route::post('/add-document/{id}', [EquipmentController::class, 'addDocument']);
        Route::delete('/delete/{id}', [EquipmentController::class, 'destroy']);
    });
});