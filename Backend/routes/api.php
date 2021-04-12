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


Route::post('register', [App\Http\Controllers\Api\v1\RegisterController::class, 'register']);

Route::post('login', [App\Http\Controllers\Api\v1\LoginController::class, 'login']);


Route::middleware(['auth:sanctum', 'role:'.Role::USUARIO_REGISTRADO])->group(function () {

    Route::post('logout', [App\Http\Controllers\Api\v1\LoginController::class, 'logout']);
});