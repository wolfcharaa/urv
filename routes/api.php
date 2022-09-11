<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Cn;

/**
 * Работа с контроллерами Эра
 */
Route::middleware('api')->group(function () {
   Route::post('/firebird_controller', [Cn\FirebirdControllerController::class, 'create']);
   Route::put('/firebird_controller/{id}', [Cn\FirebirdControllerController::class, 'update']);
});

/**
 * Работа с объектами системы
 */
Route::middleware('api')->group(function () {
    Route::post('/urv_object', [Cn\UrvObjectController::class, 'create']);
    Route::get('/urv_object', [Cn\UrvObjectController::class, 'getAll']);
    Route::get('/urv_object/{id}', [Cn\UrvObjectController::class, 'getOne']);
    Route::put('/urv_object/{id}', [Cn\UrvObjectController::class, 'update']);
    Route::delete('/urv_object/{id}', [Cn\UrvObjectController::class, 'delete']);
    Route::get('/urv_object/{id}/check_firebird', [Cn\UrvObjectController::class, 'checkFirebirdStatus']);
    Route::get('/urv_object/{id}/config', [Cn\ConfigController::class, 'getOne']);
    Route::put('/urv_object/{id}/config', [Cn\ConfigController::class, 'update']);
    Route::post('/urv_object/{id}/config', [Cn\ConfigController::class, 'create']);
});

/**
 * Работа с событиями
 */
Route::middleware('api')->group(function () {
    Route::get('/event', [Cn\EventController::class, '']);
    Route::get('/event/last', [Cn\EventController::class, 'getLast']);
    Route::get('/event/{id}', [Cn\EventController::class, 'get']);
    Route::delete('/event/{id}', [Cn\EventController::class, 'delete']);
    Route::post('/event', [Cn\EventController::class, 'create']);
    Route::put('/event/{id}', [Cn\EventController::class, 'update']);

});

/**
 * Работа с config
 */

Route::middleware('api')->group(function () {
    Route::get('/event', [Cn\EventController::class, '']);
    Route::get('/event/{id}', [Cn\EventController::class, 'get']);
    Route::delete('/event/{id}', [Cn\EventController::class, 'delete']);
    Route::post('/event', [Cn\EventController::class, 'create']);
    Route::put('/event/{id}', [Cn\EventController::class, 'update']);

});
