<?php

use App\Http\Controllers\FrutaController;
use App\Http\Controllers\LegumeController;
use App\Http\Controllers\VerduraController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:api')->get('/user', function (Request $request){
    return $request->user();
});


Route::apiResource('Fruta', FrutaController::class);   
Route::apiResource('Legume', LegumeController::class);
Route::apiResource('Verdura', VerduraController::class);