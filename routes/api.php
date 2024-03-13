<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BilletController;
use App\Http\Controllers\DocController;
use App\Http\Controllers\FoundAndLostController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WallController;
use App\Http\Controllers\WarningController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return ['pong' => true];
});

Route::get('/401', [AuthController::class, 'unauthorized'])->name('login');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/register', [AuthController::class, 'register']);

/* TODAS AS ROTAS SERA NECESSARIO ESTAR LOGADO */
Route::middleware('auth:api')->group(function () {
    Route::post('/auth/validate', [AuthController::class, 'validateToken']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    /* MURAL */
    Route::get('/walls', [WallController::class, 'getAll']);
    Route::post('/wall/{id}/like', [WallController::class, 'like']);

    /* DOCUMENTOS */
    Route::get('/docs', [DocController::class, 'getAll']);

    /* AVISOS */
    Route::get('/warnigs', [WarningController::class, 'getMyWarnings']);
    Route::post('/warning', [WarningController::class, 'setWarning']);
    Route::post('/warning/file', [WarningController::class, 'addWarningFile']);

    /* BILETES */
    Route::get('/billets', [BilletController::class, 'getAll']);

    /* ACHADOS E PERDIDOS */
    Route::get('/foundandlost', [FoundAndLostController::class, 'getAll']);
    Route::post('/foundandlost', [FoundAndLostController::class, 'insert']);
    Route::put('/foundandlost/{id}', [FoundAndLostController::class, 'update']);

    /* UNIDADES */
    Route::get('/units/{id}', [UnitController::class, 'getInfo']);
    Route::post('/units/{id}/addperson', [UnitController::class, 'addPerson']);
    Route::post('/units/{id}/addvehicle', [UnitController::class, 'addVehicle']);
    Route::post('/units/{id}/addpet', [UnitController::class, 'addPet']);

    Route::post('/units/{id}/removeperson', [UnitController::class, 'removePerson']);
    Route::post('/units/{id}/removehicle', [UnitController::class, 'removeVehicle']);
    Route::post('/units/{id}/removepet', [UnitController::class, 'removePet']);

    /* RESERVAS */
    Route::get('/reservations', [ReservationController::class, 'getReservations']);
    Route::get('/myreservations', [ReservationController::class, 'getMyReservations']);
    Route::delete('/myreservation/{id}', [ReservationController::class, 'delMyReservation']);
    Route::post('/reservation/{id}', [ReservationController::class, 'setMyReservation']);
    Route::get('/reservation/{id}/disableddates', [ReservationController::class, 'getdisableddates']);
    Route::get('/reservation/{id}/times', [ReservationController::class, 'getTimes']);
});
