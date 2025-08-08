<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontController;

// Front Routes
Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/user-signup', [FrontController::class, 'signup'])->name('front.signup');
Route::post('/user-store', [FrontController::class, 'storeUser'])->name('front.store.user');
Route::get('/user-login', [FrontController::class, 'login'])->name('front.login');
Route::post('/user-login', [FrontController::class, 'loginUser'])->name('front.login.user');
Route::get('/user-forgot-password', [FrontController::class, 'forgotPassword'])->name('front.forgot.password');
Route::post('/user-forgot-password', [FrontController::class, 'resetPassword'])->name('front.reset.password');
Route::get('/about-us', [FrontController::class, 'about'])->name('front.about');
Route::get('/contact-us', [FrontController::class, 'contact-us'])->name('front.contact');
Route::post('/contact-us', [FrontController::class, 'storeContactUs'])->name('front.store.contact');
Route::get('/privacy-policy', [FrontController::class, 'privacyPolicy'])->name('front.privacy.policy');
