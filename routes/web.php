<?php

use Illuminate\Support\Facades\Route;

// Middleware

use App\Http\Controllers\{
    DashboardController,
    ProfileController
};
use App\Http\Controllers\Admin\AdminBankController;

use App\Http\Controllers\Admin\{
    UserController,
    AnnouncementController,
    SalaryRulesController,
};

use App\Http\Controllers\Auth\{
    PasswordResetLinkController,
    NewPasswordController
};
use App\Models\SalaryRule;
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

        // announcement routes

        Route::get('/announcement', [AnnouncementController::class, 'index'])->name('admin.announcement.index');
        Route::get('/announcement/add', [AnnouncementController::class, 'add'])->name('admin.announcement.add');
        Route::post('/announcement/store', [AnnouncementController::class, 'store'])->name('admin.announcement.store');
        Route::get('/announcement/{id}/edit', [AnnouncementController::class, 'edit'])->name('admin.announcement.edit');
        Route::post('/announcement/{id}/update', [AnnouncementController::class, 'update'])->name('admin.announcement.update');
        Route::post('/announcement/{id}/delete', [AnnouncementController::class, 'delete'])->name('admin.announcement.delete');
        Route::get('announcement/restore', [AnnouncementController::class, 'restorePage'])->name('admin.announcement.restore.page');
        Route::get('announcement/restore/{id}', [AnnouncementController::class, 'restore'])->name('admin.announcement.restore');
        Route::post('announcement/force_delete/{id}', [AnnouncementController::class, 'forceDelete'])->name('admin.announcement.force.delete');

       // admin bank routes
Route::get('/admin-banks', [AdminBankController::class, 'index'])->name('admin.admin_banks.index');
Route::get('/admin-banks/add', [AdminBankController::class, 'add'])->name('admin.admin_banks.add');
Route::post('/admin-banks/store', [AdminBankController::class, 'store'])->name('admin.admin_banks.store');
Route::get('/admin-banks/{id}/edit', [AdminBankController::class, 'edit'])->name('admin.admin_banks.edit');
Route::post('/admin-banks/{id}/update', [AdminBankController::class, 'update'])->name('admin.admin_banks.update');
Route::post('/admin-banks/{id}/delete', [AdminBankController::class, 'delete'])->name('admin.admin_banks.delete');
Route::get('/admin-banks/restore', [AdminBankController::class, 'restorePage'])->name('admin.admin_banks.restore.page');
Route::get('/admin-banks/restore/{id}', [AdminBankController::class, 'restore'])->name('admin.admin_banks.restore');
Route::post('/admin-banks/force_delete/{id}', [AdminBankController::class, 'forceDelete'])->name('admin.admin_banks.force.delete');











   // salary rules routes
        Route::get('/salary-rules', [SalaryRulesController::class, 'index'])->name('admin.salary-rules.index');
        Route::get('/salary-rules/add', [SalaryRulesController::class, 'add'])->name('admin.salary-rules.add');
        Route::post('/salary-rules/store', [SalaryRulesController::class, 'store'])->name('admin.salary-rules.store');
        Route::get('/salary-rules/{id}/edit', [SalaryRulesController::class, 'edit'])->name('admin.salary-rules.edit');
        Route::post('/salary-rules/{id}/update', [SalaryRulesController::class, 'update'])->name('admin.salary-rules.update');
        Route::post('/salary-rules/{id}/delete', [SalaryRulesController::class, 'delete'])->name('admin.salary-rules.delete');
    });
});
