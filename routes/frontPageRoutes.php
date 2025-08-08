<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontController;

// Front Routes
Route::get('/', [FrontController::class, 'index'])->name('front.index');