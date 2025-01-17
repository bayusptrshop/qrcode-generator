<?php

use App\Http\Controllers\TraceabilityRawMaterialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('list-raw-material', [TraceabilityRawMaterialController::class, 'listRawMaterial']);
Route::get('detail-raw-material/{id}', [TraceabilityRawMaterialController::class, 'detailRawMaterial']);
