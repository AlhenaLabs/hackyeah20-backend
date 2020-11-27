<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FishnetsController;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

Route::get('/login', function () {
    throw new UnauthorizedHttpException('Unauthorized!');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/fishnets/my', [FishnetsController::class, 'viewMy']);
    Route::post('/fishnets', [FishnetsController::class, 'addFishnet']);
    Route::put('/fishnets/{fishnet}', [FishnetsController::class, 'updateFishnet']);
    Route::get('/fishnets/{fishnet}', [FishnetsController::class, 'getFishnet']);
    Route::get('/fishnets', [FishnetsController::class, 'getFishnets']);
    Route::delete('/fishnets/{fishnet}', [FishnetsController::class, 'deleteFishnet']);
    Route::post('/fishnets/{fishnet}/state', [FishnetsController::class, 'changeStatus']);
    Route::post('/fishnets/{fishnet}/lost', [FishnetsController::class, 'markAsLost']);

    Route::post('/users/{user}', [UsersController::class, 'resetPassword']);
    Route::post('/users', [UsersController::class, 'create']);
    Route::put('/users/{user}', [UsersController::class, 'updateUser']);
    Route::get('/users/{user}', [UsersController::class, 'getUserById']);
    Route::get('/users', [UsersController::class, 'getUsers']);
    Route::delete('users/{user}', [UsersController::class, 'deleteUser']);

    Route::get('/account', [AccountController::class, 'get']);
    Route::put('/account', [AccountController::class, 'update']);
    Route::patch('/account/password', [AccountController::class, 'changePassword']);

    Route::get('/notifications/{user}', [NotificationsController::class, 'getForUser']);
});
