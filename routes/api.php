<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Cn;

/**
 * Работа с контроллерами Эра
 */
Route::middleware('api')->group(function () {
   Route::put('/firebird_controller', [Cn\FirebirdControllerController::class, 'createOrUpdate']);
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
    Route::get('/urv_object/{id}', [Cn\UrvObjectController::class, 'checkFirebirdStatus']);

});

/**
 * Работа с событиями
 */

Route::middleware('api')->group(function () {
    Route::get('/event', [Cn\EventController::class, '']);
});
