<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Role;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('users/register', [App\Http\Controllers\Api\V1\Users\AuthController::class, 'register']);

Route::post('users/login', [App\Http\Controllers\Api\V1\Users\AuthController::class, 'login']);


Route::middleware(['auth:sanctum', 'role:'.Role::REGISTERED_USER])->group(function () {

    Route::post('users/logout', [App\Http\Controllers\Api\V1\Users\AuthController::class, 'logout']);
    Route::get('users/profile', [App\Http\Controllers\Api\V1\Users\AuthController::class, 'getProfile'])->name('user.profile');
    Route::post('users/producer', [App\Http\Controllers\Api\V1\Users\AuthController::class, 'producerRegister']);
});

Route::middleware(['auth:sanctum', 'role:'.Role::PRODUCER])->group(function () {
    Route::get('cliente/prueba', [App\Http\Controllers\Api\V1\Users\ClienteController::class, 'prueba'])->name('user.prueba');
});
