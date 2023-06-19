<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShowClipController;
use App\Http\Controllers\ShowGameController;
use App\Http\Controllers\PaginateClipController;
use App\Http\Controllers\PaginateGameController;
use App\Http\Controllers\ShowRandomClipController;

Route::get('/', HomeController::class);

Route::prefix('clips')
    ->as('clips.')
    ->group(function() {
        Route::get('/', PaginateClipController::class)->name('index');
        Route::get('random', ShowRandomClipController::class)->name('random');
        Route::get('{uuid}', ShowClipController::class)->name('show');
    });

Route::prefix('games')
    ->as('games.')
    ->group(function () {
        Route::get('/', PaginateGameController::class)->name('index');
        Route::get('{uuid}', ShowGameController::class)->name('show');
    });

Route::prefix('games')
    ->as('games.')
    ->group(function () {
        Route::get('/', PaginateGameController::class)->name('index');
        Route::get('{external_id}', ShowGameController::class)->name('show');
    });
