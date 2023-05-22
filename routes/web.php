<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaginateClipController;
use App\Http\Controllers\ShowClipController;

Route::get('/', HomeController::class);

Route::prefix('clips')
    ->as('clips.')
    ->group(function() {
        Route::get('/', PaginateClipController::class)->name('index');
        Route::get('{external_id}', ShowClipController::class)->name('show');
    });
