<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\User\{
    ProfileController
};

Route::middleware(['approved.user', 'user.profile'])->group(function () {

    Route::get('/user/dashboard', [ProfileController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user//referral', [FrontController::class, 'userReferral'])->name('user.userreferral');

    Route::get('user/profile/create', [FrontController::class, 'createProfile'])->name('front.CreateProfile');
    Route::post('/user/profile/updatePassword', [ProfileController::class, 'updatePassword'])->name('user.password.update');

    Route::get('/user/levels', [FrontController::class, 'userLevels'])->name('front.user.levels');
    Route::get('/user/level/earning', [FrontController::class, 'userLevelEarning'])->name('front.user.level.earning');
    // Route::get('/user/create-profile', [FrontController::class, 'createProfile'])->name('front.CreateProfile');
    Route::get('/user/profile-edit', [FrontController::class, 'editProfile'])->name('front.editProfile');
    Route::post('/user/profile-update', [FrontController::class, 'ProfileUpdate'])->name('front.ProfileUpdate');
    Route::post('/user/profilestore', [FrontController::class, 'ProfileStore'])->name('front.ProfileStore');


    
    Route::get('/withdraw-request', [FrontController::class, 'withdrawRequest'])->name('front.withdraw.request');
    Route::post('/withdraw-request/store', [FrontController::class, 'withdrawRequestStore'])->name('front.withdraw.request.store');
    Route::get('/deposit-history', [FrontController::class, 'depositHistory'])->name('front.deposit.history');
    Route::get('/deposit', [FrontController::class, 'deposit'])->name('front.deposit');
    Route::post('/deposit/manual', [FrontController::class, 'depositManual'])->name('front.deposit.manual');
    Route::post('/deposit/store/validate', [FrontController::class, 'depositStoreValidate'])->name('front.deposit.store.validate');
    Route::post('/deposit/store', [FrontController::class, 'depositStore'])->name('front.deposit.store');
    Route::post('/user-bank/store', [FrontController::class, 'storeUserBank'])->name('front.user-bank.store');
    Route::get('/withdraw/history', [FrontController::class, 'withdrawHistory'])->name('front.withdraw.request.history');

    Route::get('/transaction', [FrontController::class, 'transaction'])->name('front.transaction');
   
    Route::get('/user/profile-edit', [FrontController::class, 'editProfile'])->name('front.editProfile');
    Route::post('/user/profile-update', [FrontController::class, 'ProfileUpdate'])->name('front.ProfileUpdate');

    Route::get('/user/change-password', [FrontController::class, 'changePassword'])->name('front.change.password');
    Route::post('/user/change-password/store', [FrontController::class, 'changePasswordStore'])->name('front.change.password.store');

    

    Route::get('/deposit-detail/{transaction_id}', [FrontController::class, 'depositDetail'])->name('front.deposit.detail');
});
 Route::post('/user/profilestore', [FrontController::class, 'ProfileStore'])->name('front.ProfileStore');



 Route::get('/account-blocked', [FrontController::class, 'blockedUser'])->name('user.blocked');