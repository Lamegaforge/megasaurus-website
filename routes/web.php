<?php

use App\Dtos\Uuid;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShowClipController;
use App\Http\Controllers\ShowGameController;
use App\Http\Controllers\PaginateClipController;
use App\Http\Controllers\PaginateGameController;
use App\Http\Controllers\ShowRandomClipController;
use App\Http\Controllers\ToggleAutoplayController;
use App\Repositories\FindDisplayableClipRepository;

Route::get('/', HomeController::class)->name('home');

Route::get('toggle-autoplay', ToggleAutoplayController::class)->name('toggle-autoplay');

Route::prefix('clips')
    ->as('clips.')
    ->group(function() {
        Route::get('/', PaginateClipController::class)->name('index');
        Route::get('random', ShowRandomClipController::class)->name('random');
        Route::get('{uuid}', ShowClipController::class)->name('show')->whereUuid('uuid');
    });

Route::prefix('games')
    ->as('games.')
    ->group(function () {
        Route::get('/', PaginateGameController::class)->name('index');
        Route::get('{uuid}', ShowGameController::class)->name('show')->whereUuid('uuid');
    });

Route::prefix('api')
    ->as('api.')
    ->middleware([
        'throttle:20,1',
    ])
    ->group(function () {
        Route::get('clips/{uuid}', function (string $uuid) {

            $clip = app(FindDisplayableClipRepository::class)->handle(
                Uuid::fromString($uuid),
            );

            return response()->json([
                'slug' => $clip->external_id,
                'title' => $clip->title,
                'game' => $clip->game->name,
            ]);
        });
    });