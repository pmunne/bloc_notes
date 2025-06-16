<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NoteController;

Route::middleware('api')->group(function () {
    Route::apiResource('notes', NoteController::class);
});