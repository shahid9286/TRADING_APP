<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontController;

// Front Routes
Route::get('/', [FrontController::class, 'login'])->name('front.login');
Route::post('/user-login', [FrontController::class, 'loginUser'])->name('front.login.user');
Route::get('/user-signup/{user_name?}', [FrontController::class, 'signup'])->name('front.signup');
Route::post('/user-store', [FrontController::class, 'storeUser'])->name('front.store.user');
Route::get('/user-forgot-password', [FrontController::class, 'forgotPassword'])->name('front.forgot.password');
Route::get('/user-reset-password', [FrontController::class, 'resetPassword'])->name('front.reset.password');
Route::get('/about-us', [FrontController::class, 'about'])->name('front.about');
Route::get('/contact-us', [FrontController::class, 'contact'])->name('front.contact');
Route::post('/contact-us', [FrontController::class, 'contactUsStore'])->name('front.contact.store');
Route::get('/privacy-policy', [FrontController::class, 'privacyPolicy'])->name('front.privacy.policy');
Route::get('/withdraw', [FrontController::class, 'withdraw'])->name('front.withdraw');
Route::get('/withdraw/store', [FrontController::class, 'withdraw'])->name('front.withdraw.store');

Route::get('/withdraw/history', [FrontController::class, 'withdraw_history'])->name('front.withdraw.history');

Route::get('/transaction', [FrontController::class, 'transaction'])->name('front.transaction');
Route::get('/plan', [FrontController::class, 'plan'])->name('front.plan');



Route::get('/account-blocked', [FrontController::class, 'blockedUser'])->name('user.blocked');
Route::get('/check-status', function () {
    $user = auth()->user();
    return response()->json(['status' => $user->status]);
})->name('check.status');


