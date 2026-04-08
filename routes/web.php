<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;

Route::middleware(['auth'])->group(function () {
    Route::resource('projects', ProjectController::class);
    Route::resource('categories', CategoryController::class)->except(['show']);
});