<?php

use Illuminate\Support\Facades\Route;
// Middleware

use App\Http\Controllers\{
    DashboardController,
    ProfileController
};

use App\Http\Controllers\Admin\{
    UserController,
    AnnouncementController,
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

        // announcement routes

        Route::get('/', [AnnouncementController::class, 'index'])->name('admin.announcement.index');
        Route::get('/announcement/add', [AnnouncementController::class, 'add'])->name('admin.announcement.add');
        Route::post('/announcement/store', [AnnouncementController::class, 'store'])->name('admin.announcement.store');
        Route::get('/announcement/{id}/edit', [AnnouncementController::class, 'edit'])->name('admin.announcement.edit');
        Route::post('/announcement/{id}/update', [AnnouncementController::class, 'update'])->name('admin.announcement.update');
        Route::post('/announcement/{id}/delete', [AnnouncementController::class, 'delete'])->name('admin.announcement.delete');
        Route::get('announcement/restore', [AnnouncementController::class, 'restorePage'])->name('admin.announcement.restore.page');
        Route::get('announcement/restore/{id}', [AnnouncementController::class, 'restore'])->name('admin.announcement.restore');
        Route::post('announcement/force_delete/{id}', [AnnouncementController::class, 'forceDelete'])->name('admin.announcement.force.delete');
    });
});