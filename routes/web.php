<?php

use App\Http\Controllers\TraceabilityRawMaterialController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/insert-data', [TraceabilityRawMaterialController::class, 'index']);
Route::post('/import-data', [TraceabilityRawMaterialController::class, 'import'])->name('import.excel');
Route::get('qrcode-generate', [TraceabilityRawMaterialController::class, 'qrcodeGenerate'])->name('qrcode.generate');
