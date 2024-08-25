<?php

Route::get('/extract', [\App\Http\Controllers\ExtractorController::class, 'extract']);
Route::post('/store', [\App\Http\Controllers\ExtractorController::class, 'store']);
