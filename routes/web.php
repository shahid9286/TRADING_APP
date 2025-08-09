<?php

use Illuminate\Support\Facades\Route;
// Middleware

use App\Http\Controllers\{
    DashboardController,
    ProfileController
};

use App\Http\Controllers\Admin\{
    UserController,
    RewardController,
    EnquiryController,
    InvestmentController,
};

use App\Http\Controllers\Auth\{
    PasswordResetLinkController,
    NewPasswordController
};
use Illuminate\Support\Facades\Auth;

Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');

Route::get('/pending-user', [UserController::class, 'pendingUser'])->name('pending.user');
Route::get('/blocked-user', [UserController::class, 'blockedUser'])->name('blocked.user');

require __DIR__ . '/auth.php';
Route::get('/dashboard', function () {
    if (Auth::user()->hasRole('admin'))
        return redirect()->route('admin.dashboard');
    elseif (Auth::user()->hasRole('user'))
        return redirect()->route('user.dashboard');
})->name('dashboard');

Route::middleware(['auth', 'status'])->group(function () {
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/admin-dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

        // profile routes
        Route::get('/editProfile', [ProfileController::class, 'editProfile'])->name('admin.profile.edit');
        Route::post('/updateProfile', [ProfileController::class, 'updateProfile'])->name('admin.profile.update');
        Route::post('/updatePassword', [ProfileController::class, 'updatePassword'])->name('admin.password.update');
        // user routes
        Route::get('/users', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/add-user', [UserController::class, 'add'])->name('admin.user.add');
        Route::post('/store-user', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::post('/update-user/{id}', [UserController::class, 'update'])->name('admin.user.update');
        Route::post('/delete-user/{id}', [UserController::class, 'delete'])->name('admin.user.delete');

        Route::post('/makependingUser/{id}', [UserController::class, 'makependingUser'])->name('admin.user.makependingUser');
        Route::post('/makeapprovedUser/{id}', [UserController::class, 'makeapprovedUser'])->name('admin.user.makeapprovedUser');
        Route::post('/makeblockedUser/{id}', [UserController::class, 'makeblockedUser'])->name('admin.user.makeblockedUser');

        Route::get('/pendingUsers', [UserController::class, 'pendingUsers'])->name('admin.user.pendingUsers');
        Route::get('/approvedUsers', [UserController::class, 'approvedUsers'])->name('admin.user.approvedUsers');
        Route::get('/blockedUsers', [UserController::class, 'blockedUsers'])->name('admin.user.blockedUsers');
            // reward Routes
        Route::get('/reward', [RewardController::class, 'index'])->name('admin.reward.index');
        Route::get('/reward/add', [RewardController::class, 'add'])->name('admin.reward.add');
        Route::post('/reward/store', [RewardController::class, 'store'])->name('admin.reward.store');
        Route::get('reward/restore', [RewardController::class, 'restorePage'])->name('admin.reward.restore.page');
        Route::get('/reward/edit/{id}', [RewardController::class, 'edit'])->name('admin.reward.edit');
        Route::put('/reward/update/{id}', [RewardController::class, 'update'])->name('admin.reward.update');
        Route::post('/reward/delete/{id}', [RewardController::class, 'delete'])->name('admin.reward.delete');
        Route::get('reward/restore/{id}', [RewardController::class, 'restore'])->name('admin.reward.restore');
        Route::post('reward/force_delete/{id}', [RewardController::class, 'forceDelete'])->name('admin.reward.force.delete');
        // End of reward

                    // investment Routes
        Route::get('/investment', [InvestmentController::class, 'index'])->name('admin.investment.index');
        Route::get('/investment/add', [InvestmentController::class, 'add'])->name('admin.investment.add');
        Route::post('/investment/store', [InvestmentController::class, 'store'])->name('admin.investment.store');
        Route::get('investment/restore', [InvestmentController::class, 'restorePage'])->name('admin.investment.restore.page');
        Route::get('/investment/edit/{id}', [InvestmentController::class, 'edit'])->name('admin.investment.edit');
        Route::put('/investment/update/{id}', [InvestmentController::class, 'update'])->name('admin.investment.update');
        Route::post('/investment/delete/{id}', [InvestmentController::class, 'delete'])->name('admin.investment.delete');
        Route::get('investment/restore/{id}', [InvestmentController::class, 'restore'])->name('admin.investment.restore');
        Route::post('investment/force_delete/{id}', [InvestmentController::class, 'forceDelete'])->name('admin.investment.force.delete');
        // End of Investment

        // Enquiry Routes
        Route::get('/enquiry', [EnquiryController::class, 'index'])->name('admin.enquiry.index');
        Route::get('/enquiry/add', [EnquiryController::class, 'add'])->name('admin.enquiry.add');
        Route::post('/enquiry/store', [EnquiryController::class, 'store'])->name('admin.enquiry.store');
        Route::get('enquiry/restore', [EnquiryController::class, 'restorePage'])->name('admin.enquiry.restore.page');
        Route::get('/enquiry/edit/{id}', [EnquiryController::class, 'edit'])->name('admin.enquiry.edit');
        Route::post('/enquiry/update/{id}', [EnquiryController::class, 'update'])->name('admin.enquiry.update');
        Route::post('/enquiry/delete/{id}', [EnquiryController::class, 'delete'])->name('admin.enquiry.delete');
        Route::get('/enquiry/detail/{id}', [EnquiryController::class, 'detail'])->name('admin.enquiry.detail');
        Route::post('/enquiry/comment/{id}', [EnquiryController::class, 'comment'])->name('admin.enquiry.comment.store');
        Route::get('/enquiry/comment/delete/{id}', [EnquiryController::class, 'deleteComment'])->name('admin.enquiry.comment.delete');
        Route::get('enquiry/restore/{id}', [EnquiryController::class, 'restore'])->name('admin.enquiry.restore');
        Route::post('enquiry/force_delete/{id}', [EnquiryController::class, 'forceDelete'])->name('admin.enquiry.force.delete');
        // End of Enquiry



    });
});
