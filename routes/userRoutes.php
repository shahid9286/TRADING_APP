<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\User\{
    ProfileController
};

Route::middleware(['approved.user','user.profile'])->group(function () {

    Route::get('/user/dashboard', [ProfileController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/editProfile', [ProfileController::class, 'editProfile'])->name('user.profile.edit');
    Route::post('/user/updateProfile', [ProfileController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/user/updatePassword', [ProfileController::class, 'updatePassword'])->name('user.password.update');

    Route::get('/profile/create', [FrontController::class, 'createProfile'])->name('user.profile.create');

});
