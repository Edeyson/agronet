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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', [App\Http\Controllers\Api\V1\Users\RegisterController::class, 'register']);

Route::post('login', [App\Http\Controllers\Api\V1\Users\LoginController::class, 'login']);


Route::middleware(['auth:sanctum', 'role:'.Role::USUARIO_REGISTRADO])->group(function () {

    Route::post('logout', [App\Http\Controllers\Api\V1\Users\LoginController::class, 'logout']);
    Route::get('profile', [App\Http\Controllers\Api\V1\Users\ProfileController::class, 'show'])->name('user.profile');
    Route::post('cliente/register', [App\Http\Controllers\Api\V1\Users\ClienteController::class, 'register']);
});

Route::middleware(['auth:sanctum', 'role:'.Role::GESTOR])->group(function () {
    Route::get('cliente/prueba', [App\Http\Controllers\Api\V1\Users\ClienteController::class, 'prueba'])->name('user.prueba');
});
