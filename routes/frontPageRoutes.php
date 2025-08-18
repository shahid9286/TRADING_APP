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
Route::get('/withdraw-request', [FrontController::class, 'withdrawRequest'])->name('front.withdraw.request');
Route::post('/withdraw-request/store', [FrontController::class, 'withdrawRequestStore'])->name('front.withdraw.request.store');
Route::get('/deposit', [FrontController::class, 'deposit'])->name('front.deposit');
Route::post('/deposit/manual', [FrontController::class, 'depositManual'])->name('front.deposit.manual');
Route::post('/deposit/store/validate', [FrontController::class, 'depositStoreValidate'])->name('front.deposit.store.validate');
Route::post('/deposit/store', [FrontController::class, 'depositStore'])->name('front.deposit.store');
Route::post('/user-bank/store', [FrontController::class, 'storeUserBank'])->name('front.user-bank.store');
Route::get('/withdraw/history', [FrontController::class, 'withdrawHistory'])->name('front.withdraw.request.history');

Route::get('/transaction', [FrontController::class, 'transaction'])->name('front.transaction');
Route::get('/plan', [FrontController::class, 'plan'])->name('front.plan');



Route::get('/account-blocked', [FrontController::class, 'blockedUser'])->name('user.blocked');
Route::get('/check-status', function () {
    $user = auth()->user();
    return response()->json(['status' => $user->status]);
})->name('check.status');


Route::get('/user/forgot-password', function () {
    return view('front.password.forgot');
})->name('password.request');

Route::post('/user/forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'store'])
    ->name('front.password.email');

Route::get('/user/reset-password/{token}', function ($token) {
    return view('front.password.reset', ['token' => $token]);
})->name('password.reset');

Route::post('/user/reset-passwords', [\App\Http\Controllers\Auth\NewPasswordController::class, 'store'])
    ->name('front.password.update');
