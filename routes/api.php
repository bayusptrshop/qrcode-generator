<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TraceabilityRawMaterialController;
use App\Http\Middleware\AuthApikey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(AuthApikey::class)->group(function () {
    Route::get('list-raw-material', [TraceabilityRawMaterialController::class, 'listRawMaterial']);
    Route::get('detail-raw-material/{id}', [TraceabilityRawMaterialController::class, 'detailRawMaterial']);
    Route::post('register', [AuthController::class, 'register']);
});
