<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NoteController;
use App\Http\Middleware\CheckHeader;

Route::middleware(CheckHeader::class)->group(function () {
    Route::apiResource('notes', NoteController::class);
});
