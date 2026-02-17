<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;

Route::prefix('/')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('client.home');
});
