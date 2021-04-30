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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


//Doing Refactor
Route::group(['prefix'=>'v1','as'=>'api.v1.'], function(){
    
    Route::post('auth', [App\Http\Controllers\Api\V1\Users\AuthController::class, 'login']);
   
    Route::post('users', [App\Http\Controllers\Api\V1\Users\RegisteredUserController::class, 'store']);

    Route::get('events', [App\Http\Controllers\Api\V1\EventsAgro\EventController::class, 'index']); 
    
    Route::get('events/{id}', [App\Http\Controllers\Api\V1\EventsAgro\EventController::class, 'show']); 

    Route::get('events/{id}/addr', [App\Http\Controllers\Api\V1\EventsAgro\EventController::class, 'addr']); 

    Route::get('events/{id}/geo-location', [App\Http\Controllers\Api\V1\EventsAgro\EventController::class, 'geoLocation']);
    
    Route::get('producers/{id}/events', [App\Http\Controllers\Api\V1\Producers\ProducerController::class, 'events']);

    Route::get('events/geo/{lt}/{lng}/{val}', [App\Http\Controllers\Api\V1\GeoLocation\GeographicLocationController::class, 'circundantes']);

    Route::middleware(['auth:sanctum', 'role:'.Role::REGISTERED_USER])->group(function () {
        Route::delete('auth', [App\Http\Controllers\Api\V1\Users\AuthController::class, 'logout']);
        Route::apiResource('producers', App\Http\Controllers\Api\V1\Producers\ProducerController::class)->only('store');
        Route::apiResource('users', App\Http\Controllers\Api\V1\Users\RegisteredUserController::class)->except(['store','index']);
        Route::get('users/{id}/addrs', [App\Http\Controllers\Api\V1\Users\RegisteredUserController::class, 'addrs']);
        Route::apiResource('addrs', App\Http\Controllers\Api\V1\Addrs\AddrController::class)->only(['store', 'show', 'update', 'destroy']);
        Route::get('addrs/{id}/geo-location', [App\Http\Controllers\Api\V1\Addrs\AddrController::class, 'geoLocation']);    
        Route::apiResource('geo-locations', App\Http\Controllers\Api\V1\GeoLocation\GeographicLocationController::class)->only(['store']);    
        
    });

    Route::middleware(['auth:sanctum', 'role:'.Role::PRODUCER])->group(function () {
        Route::apiResource('events', App\Http\Controllers\Api\V1\EventsAgro\EventController::class)->except(['index']);    
    });

    Route::middleware(['auth:sanctum', 'role:'.Role::ADMIN])->group(function () {
        Route::group(['prefix'=>'admin','as'=>'api.v1.'], function(){
            Route::apiResource('users', App\Http\Controllers\Api\V1\Users\RegisteredUserController::class);
            Route::apiResource('addrs', App\Http\Controllers\Api\V1\Addrs\AddrController::class);
            Route::apiResource('geo-locations', App\Http\Controllers\Api\V1\GeoLocation\GeographicLocationController::class);
        });
    });
});




//ok Route::post('users/register', [App\Http\Controllers\Api\V1\Users\AuthController::class, 'register']);

//ok Route::post('users/login', [App\Http\Controllers\Api\V1\Users\AuthController::class, 'login']);



// Route::middleware(['auth:sanctum', 'role:'.Role::REGISTERED_USER])->group(function () {

//     /*Refactor pte */
// ok    Route::post('users/logout', [App\Http\Controllers\Api\V1\Users\AuthController::class, 'logout']);
// ok    Route::get('users/profile', [App\Http\Controllers\Api\V1\Users\AuthController::class, 'getProfile'])
//                 ->name('user.profile');
// ok    Route::post('users/producer', [App\Http\Controllers\Api\V1\Users\AuthController::class, 'producerRegister']);
//     /* */

// ok    Route::apiResource('addrs', App\Http\Controllers\Api\V1\Geo\AddrController::class);
//     Route::apiResource('geolocation', App\Http\Controllers\Api\V1\Geo\GeographicLocationController::class);
// });

// Route::middleware(['auth:sanctum', 'role:'.Role::PRODUCER])->group(function () {
//     Route::get('producers/profile', [App\Http\Controllers\Api\V1\Users\AuthController::class, 'getProducerProfile'])
//                 ->name('producer.profile');
//     Route::apiResource('producers', App\Http\Controllers\Api\V1\Users\Producer\ProducerController::class);
//     Route::apiResource('events', App\Http\Controllers\Api\V1\Geo\EventController::class);
// });
