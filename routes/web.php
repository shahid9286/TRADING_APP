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
    RewardController,
    EnquiryController,
    InvestmentController,
    AnnouncementController,
    SalaryRulesController,
    UserReturnController,
    UserBankController,
    AdminController,
    WithdrawalRequestController,
    SettingController,
    BusinessRuleController,
    EmailTemplateController,
    TransactionController,
};

use App\Http\Controllers\Auth\{
    PasswordResetLinkController,
    NewPasswordController
};
use App\Models\SalaryRule;
use App\Models\WithdrawalRequest;
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

        Route::get('/user-detail/{id}', [UserController::class, 'detail'])->name('admin.user.detail');

        Route::post('/makependingUser/{id}', [UserController::class, 'makependingUser'])->name('admin.user.makependingUser');
        Route::post('/makeapprovedUser/{id}', [UserController::class, 'makeapprovedUser'])->name('admin.user.makeapprovedUser');
        Route::post('/makeblockedUser/{id}', [UserController::class, 'makeblockedUser'])->name('admin.user.makeblockedUser');

        Route::get('/pendingUsers', [UserController::class, 'pendingUsers'])->name('admin.user.pendingUsers');
        Route::get('/approvedUsers', [UserController::class, 'approvedUsers'])->name('admin.user.approvedUsers');
        Route::get('/blockedUsers', [UserController::class, 'blockedUsers'])->name('admin.user.blockedUsers');

        // admins
        Route::get('/admins', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/add-admin', [AdminController::class, 'add'])->name('admin.add');
        Route::post('/store-admin', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/edit-admin/{id}', [AdminController::class, 'edit'])->name('admin.edit');
        Route::post('/update-admin/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::post('/delete-admin/{id}', [AdminController::class, 'delete'])->name('admin.delete');

        Route::post('/makependingAdmin/{id}', [AdminController::class, 'makependingAdmin'])->name('admin.makependingAdmin');
        Route::post('/makeapprovedAdmin/{id}', [AdminController::class, 'makeapprovedAdmin'])->name('admin.makeapprovedAdmin');
        Route::post('/makeblockedAdmin/{id}', [AdminController::class, 'makeblockedAdmin'])->name('admin.makeblockedAdmin');

        Route::get('/pendingAdmins', [AdminController::class, 'pendingAdmins'])->name('admin.pendingAdmins');
        Route::get('/approvedAdmins', [AdminController::class, 'approvedAdmins'])->name('admin.approvedAdmins');
        Route::get('/blockedAdmins', [AdminController::class, 'blockedAdmins'])->name('admin.blockedAdmins');

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


        Route::get('/transactions', [TransactionController::class, 'index'])->name('admin.transaction.index');
        Route::post('/transactions/search', [TransactionController::class, 'search'])->name('admin.transaction.search');

        // investment Routes
        Route::get('/investments', [InvestmentController::class, 'index'])->name('admin.investment.index');

        Route::post('/investment-approved/{id}', [InvestmentController::class, 'investmentApproved'])->name('admin.investment.approved');


        Route::post('/investment-search', [InvestmentController::class, 'search'])->name('admin.investment.search');

        // End of Investment
        // userreturn Routes
        Route::get('/UserReturn', [UserReturnController::class, 'index'])->name('admin.user_returns.index');
        Route::get('/UserReturn/add', [UserReturnController::class, 'add'])->name('admin.user_returns.add');
        Route::post('/UserReturn/store', [UserReturnController::class, 'store'])->name('admin.user_returns.store');
        Route::get('UserReturn/restore', [UserReturnController::class, 'restorePage'])->name('admin.user_returns.restore.page');
        Route::get('/UserReturn/edit/{id}', [UserReturnController::class, 'edit'])->name('admin.user_returns.edit');
        Route::put('/UserReturn/update/{id}', [UserReturnController::class, 'update'])->name('admin.user_returns.update');
        Route::post('/UserReturn/delete/{id}', [UserReturnController::class, 'delete'])->name('admin.user_returns.delete');
        Route::get('UserReturn/restore/{id}', [UserReturnController::class, 'restore'])->name('admin.user_returns.restore');
        Route::post('UserReturn/force_delete/{id}', [UserReturnController::class, 'forceDelete'])->name('admin.user_returns.force.delete');
        // End of userreturn

        Route::get('/withdrawal-request/detail/{id}', [WithdrawalRequestController::class, 'detail'])->name('admin.withdrawal-request.detail');
        Route::post('/withdrawal-request/approve', [WithdrawalRequestController::class, 'approve'])->name('admin.withdrawal-request.approve');
        Route::post('/withdrawal-request/reject', [WithdrawalRequestController::class, 'reject'])->name('admin.withdrawal-request.reject');
        Route::post('/withdrawal-request/pay', [WithdrawalRequestController::class, 'pay'])->name('admin.withdrawal-request.pay');

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


        // Setting Routes
        Route::get('/setting', [SettingController::class, 'edit'])->name('admin.setting.edit');
        Route::post('/setting/update', [SettingController::class, 'update'])->name('admin.setting.update');
        // End of Setting Routes

        // BusinessRule Routes
        Route::get('/business-rules', [BusinessRuleController::class, 'edit'])->name('admin.business.rules.edit');
        Route::post('/business-rules/update', [BusinessRuleController::class, 'update'])->name('admin.business.rules.update');
        // End of BusinessRule Routes


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
        Route::put('/admin-banks/{id}/update', [AdminBankController::class, 'update'])->name('admin.admin_banks.update');
        Route::post('/admin-banks/{id}/delete', [AdminBankController::class, 'delete'])->name('admin.admin_banks.delete');
        Route::get('/admin-banks/restore', [AdminBankController::class, 'restorePage'])->name('admin.admin_banks.restore.page');
        Route::get('/admin-banks/restore/{id}', [AdminBankController::class, 'restore'])->name('admin.admin_banks.restore');
        Route::post('/admin-banks/force_delete/{id}', [AdminBankController::class, 'forceDelete'])->name('admin.admin_banks.force.delete');

        //end of admin bank routes

        Route::prefix('admin/email-templates')->name('admin.email-templates.')->middleware(['auth'])->group(function () {
            Route::get('/', [EmailTemplateController::class, 'index'])->name('index');
            Route::get('/add', [EmailTemplateController::class, 'add'])->name('add');
            Route::post('/', [EmailTemplateController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [EmailTemplateController::class, 'edit'])->name('edit');
            Route::put('/{id}', [EmailTemplateController::class, 'update'])->name('update');
            Route::delete('/{id}', [EmailTemplateController::class, 'destroy'])->name('delete');
            Route::get('/{id}/detail', [EmailTemplateController::class, 'show'])->name('show');

            // Route::delete('/email-attachments/{id}', [EmailTemplateController::class, 'destroyAttachment'])->name('email-attachments.destroy');

            Route::post('/upload-attachment', [EmailTemplateController::class, 'uploadAttachment'])->name('upload.attachment');
        });

        // user bank routes
        Route::get('/user-banks', [UserBankController::class, 'index'])->name('admin.user-banks.index');
        Route::get('/user-banks/add', [UserBankController::class, 'add'])->name('admin.user-banks.add');
        Route::post('/user-banks/store', [UserBankController::class, 'store'])->name('admin.user-banks.store');
        Route::get('/user-banks/{id}/edit', [UserBankController::class, 'edit'])->name('admin.user-banks.edit');
        Route::post('/user-banks/{id}/update', [UserBankController::class, 'update'])->name('admin.user-banks.update');
        Route::post('/user-banks/{id}/delete', [UserBankController::class, 'delete'])->name('admin.user-banks.delete');

        //end of user bank routes

        // Withdrawal Request routes
        Route::get('/withdrawal-requests', [WithdrawalRequestController::class, 'index'])->name('admin.withdrawal-request.index');
        Route::post('/search', [WithdrawalRequestController::class, 'search'])->name('admin.withdrawal-request.search');
        Route::post('/withdrawal-requests/{id}/delete', [WithdrawalRequestController::class, 'delete'])->name('admin.withdrawal-request.delete');

        //end of Withdrawal Request routes

        // salary rules routes
        Route::get('/salary-rules', [SalaryRulesController::class, 'index'])->name('admin.salary-rules.index');
        Route::get('/salary-rules/add', [SalaryRulesController::class, 'add'])->name('admin.salary-rules.add');
        Route::post('/salary-rules/store', [SalaryRulesController::class, 'store'])->name('admin.salary-rules.store');
        Route::get('/salary-rules/{id}/edit', [SalaryRulesController::class, 'edit'])->name('admin.salary-rules.edit');
        Route::post('/salary-rules/{id}/update', [SalaryRulesController::class, 'update'])->name('admin.salary-rules.update');
        Route::post('/salary-rules/{id}/delete', [SalaryRulesController::class, 'delete'])->name('admin.salary-rules.delete');
        Route::get('/update-salary', [SalaryRulesController::class, 'updateSalary'])->name('admin.salary-rules.update-salary');
        Route::get('/give-salary', [SalaryRulesController::class, 'giveSalary'])->name('admin.salary-rules.give-salary');
Route::get('/zameer', function () {
    return view('zameer');
});

    });
});


