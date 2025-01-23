<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TraceabilityRawMaterialController;
use App\Http\Middleware\AuthLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(AuthLogin::class)->group(function () {
    Route::get('/insert-data', [TraceabilityRawMaterialController::class, 'index'])->name('insert.excel');
    Route::post('/import-data', [TraceabilityRawMaterialController::class, 'import'])->name('import.excel');
    Route::get('qrcode-generate', [TraceabilityRawMaterialController::class, 'qrcodeGenerate'])->name('qrcode.generate');
    Route::get('list-data', [TraceabilityRawMaterialController::class, 'listData'])->name('list.data');
});
Route::get('login', function () {
    return view('login');
})->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.process');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
