<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaginateClipController;
use App\Http\Controllers\ShowClipController;

Route::get('/', HomeController::class);
Route::get('clips', PaginateClipController::class);
Route::get('clips/{external_id}', ShowClipController::class);
