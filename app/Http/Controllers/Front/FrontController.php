<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Models\Enquiry;
use App\Models\UserBank;
use App\Models\AdminBank;
use App\Models\Investment;
use App\Helpers\FileHelper;
use Illuminate\Http\Request;
use App\Models\WithdrawalRequest;
use App\Models\BusinessRule;
use App\Models\UserLedger;
use App\Models\UserProfile;
use App\Models\UserTotal;
use App\Services\EmailService;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{

    public function login()
    {
        if (Auth::check() && Auth::user()->hasRole('user')) {
            $profile = UserProfile::where('user_id', Auth::id())->first();

            if ($profile) {
                return redirect()->route('user.dashboard');
            } else {
                return redirect()->route('front.CreateProfile');
            }
        }
        return view('front.login');
    }
    public function loginUser(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|min:6',
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password,
        ];

        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->hasRole('user')) {
                $profile = UserProfile::where('user_id', $user->id)->first();

                if ($profile) {
                    // ✅ Go to dashboard if profile exists
                    return redirect()->route('user.dashboard')
                        ->with('success', 'You have logged in successfully!');
                } else {
                    // ✅ Go to create profile if not created yet
                    return redirect()->route('front.CreateProfile')
                        ->with('success', 'Please complete your profile.');
                }
            }

            Auth::logout();
            return back()->withErrors([
                'login' => 'You are not authorized to log in from here.',
            ]);
        }

        return back()->withErrors([
            'login' => 'Invalid username/email or password.',
        ])->withInput($request->only('login', 'remember'));
    }


    public function signup($referral_username = null)
    {

        return view('front.signup', compact('referral_username'));
    }

    public function storeUser(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'username' => 'required|min:3|alpha_dash|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|confirmed|min:6',
            'referral_username' => 'nullable|exists:users,username',
        ]);

        // ✅ Handle referral (always by username)
        $referral_user = null;
        if ($request->filled('referral_username')) {
            $referral_user = User::where('username', $request->referral_username)->first();

            if (!$referral_user) {
                return back()->withErrors(['referral_username' => 'Referral username not found!'])->withInput();
            }
        }

        // ✅ Assign referral hierarchy (up to 7 levels)
        $level_1_user_id = $referral_user->id ?? null;
        $level_2_user_id = $referral_user->level_1_user_id ?? null;
        $level_3_user_id = $referral_user->level_2_user_id ?? null;
        $level_4_user_id = $referral_user->level_3_user_id ?? null;
        $level_5_user_id = $referral_user->level_4_user_id ?? null;
        $level_6_user_id = $referral_user->level_5_user_id ?? null;
        $level_7_user_id = $referral_user->level_6_user_id ?? null;

        // ✅ Create User
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'status' => 'approved',
            'net_balance' => 0,
            'referral_username' => $referral_user->username ?? null,
            'referral_user_id' => $referral_user->id ?? null,
            'level_1_user_id' => $level_1_user_id,
            'level_2_user_id' => $level_2_user_id,
            'level_3_user_id' => $level_3_user_id,
            'level_4_user_id' => $level_4_user_id,
            'level_5_user_id' => $level_5_user_id,
            'level_6_user_id' => $level_6_user_id,
            'level_7_user_id' => $level_7_user_id,
        ]);

        // ✅ Assign role
        $user->assignRole('user');

        UserTotal::create([
            'user_id' => $user->id,
        ]);

        Auth::login($user);

        return redirect()->route('front.CreateProfile')
            ->with('success', 'Account created successfully! Please complete your Profile !.');
    }

    public function createProfile()
    {
        $profile = UserProfile::where('user_id', Auth::id())->first();
        if ($profile) {
            return redirect()->route('front.editProfile');
        }
        return view('front.create-profile');
    }


    public function ProfileStore(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'whatsapp_no' => 'nullable|string|max:20',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'address' => 'nullable|string|max:255',
        ]);

        $profile = new UserProfile();
        $profile->user_id = Auth::id();
        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->whatsapp_no = $request->whatsapp_no;
        $profile->country = $request->country;
        $profile->city = $request->city;
        $profile->address = $request->address;

        if ($request->hasFile('profile_image')) {
            $profile->image = FileHelper::upload($request->file('profile_image'), 'assets/user/profile');
        }

        $profile->save();

        return redirect()->route('front.editProfile')
            ->with('success', 'Profile created successfully!');
    }
    public function editProfile()
    {
        $profile = UserProfile::where('user_id', Auth::id())->first();
        return view('front.edit-profile', compact('profile'));
    }
    public function ProfileUpdate(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'profile_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'whatsapp_no' => 'nullable|string|max:20',

        ]);

        $profile = UserProfile::firstOrNew(['user_id' => Auth::id()]);
        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->country = $request->country;
        $profile->city = $request->city;
        $profile->address = $request->address;
        $profile->whatsapp_no = $request->whatsapp_no;

        // Handle image upload
        if ($request->hasFile('profile_image')) {
            $profile->image = FileHelper::update(
                $profile->image,
                $request->file('profile_image'),
                'assets/user/profile'
            );
        }

        $profile->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function userReferral()
    {
        return view('front.user-referral');
    }


    public function about()
    {
        return view('front.about');
    }
    public function privacyPolicy()
    {
        return view('front.privacy.policy');
    }



    public function contact()
    {
        return view('front.contact');
    }

    public function userLevels()
    {
        $authId = Auth::id();
        $levels = [];
        $previousLevelUserIds = [$authId];

        for ($i = 1; $i <= 7; $i++) {
            $levelUsers = User::whereIn('referral_user_id', $previousLevelUserIds)->pluck('id')->toArray();

            $totalUsers = count($levelUsers);

            $totalInvestments = UserTotal::whereIn('user_id', $levelUsers)->sum('total_invested');

            $levels[$i] = [
                'users' => $totalUsers,
                'investments' => $totalInvestments
            ];

            $previousLevelUserIds = $levelUsers;
        }

        $totalUsersAll = array_sum(array_column($levels, 'users'));
        $totalInvestmentsAll = array_sum(array_column($levels, 'investments'));

        return view('front.finance.user-levels', compact('levels', 'totalUsersAll', 'totalInvestmentsAll'));
    }

    public function userLevelEarning()
    {
        $authId = Auth::id();
        $levelsData = [];
        $previousLevelUserIds = [$authId];

        for ($i = 1; $i <= 7; $i++) {
            $levelUsers = User::whereIn('referral_user_id', $previousLevelUserIds)->pluck('id')->toArray();

            $investments = Investment::where('status', 'approved')->whereIn('user_id', $levelUsers)
                ->select('id', 'user_id', 'amount', 'created_at')
                ->orderBy('created_at', 'desc')
                ->get();

            $levelsData[$i] = [
                'investments' => $investments,
                'total_transactions' => $investments->count(),
                'total_amount' => $investments->sum('amount'),
            ];

            $previousLevelUserIds = $levelUsers;
        }
        return view('front.finance.user-level-earning', compact('levelsData'));
    }

    public function contactUsStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone_no' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'enquiry_message' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $enquiry = new Enquiry();
        $enquiry->name = $request->name;
        $enquiry->email = $request->email;
        $enquiry->phone_no = $request->phone_no;
        $enquiry->subject = $request->subject;
        $enquiry->enquiry_message = $request->enquiry_message;
        $enquiry->save();

        $notification = array(
            'message' => 'Form Submitted Successfully!',
            'alert' => 'success',
        );

        return back()->with('notification', $notification);
    }
    public function withdrawRequest()
    {
        $user_banks = UserBank::where('user_id', Auth::id())->get();
        return view('front.finance.withdraw', compact('user_banks'));
    }

    public function withdrawRequestStore(Request $request)
    {
        $available_balance = Auth::user()->net_balance - Auth::user()->locked_amount;
        $min_withdraw_limit = BusinessRule::first()->min_withdraw_limit;
        $validator = Validator::make($request->all(), [
            'bank_account' => 'required|exists:user_banks,id',
            'amount' => 'required|numeric|min:' . $min_withdraw_limit . '|max:' . $available_balance,
        ]);

        if ($validator->fails()) {
            $errors = implode('<br>', $validator->errors()->all());
            return redirect()->back()->with('error', $errors)->withInput();
        }

        DB::beginTransaction();

        $user_bank = UserBank::find($request->bank_account);

        $withdrawal_request = new WithdrawalRequest();
        $withdrawal_request->account_no = $user_bank->account_no;
        $withdrawal_request->bank_name = $user_bank->bank_name;
        $withdrawal_request->user_bank_id = $user_bank->id;
        $withdrawal_request->user_id = Auth::id();
        $withdrawal_request->request_date = today();
        $withdrawal_request->requested_amount = $request->amount;
        $withdrawal_request->save();

        $user = Auth::user();
        $user->locked_amount = $user->locked_amount + $request->amount;
        $user->save();

        DB::commit();

        return redirect()->route('front.withdraw.request.history')->with('success', 'Request Submitted Successfully!');
    }

    public function withdrawHistory()
    {
        $withdrawal_requests = WithdrawalRequest::where('user_id', Auth::id())->get();
        return view('front.finance.withdraw_history', compact('withdrawal_requests'));
    }

    public function transaction()
    {
        $transactions = UserLedger::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('front.finance.transaction', compact('transactions'));
    }
    public function plan()
    {
        return view('front.plan');
    }
    public function user_level()
    {
        return view('front.user_level');
    }

    public function deposit()
    {
        return view('front.finance.deposit');
    }

    public function depositDetail($transaction_id)
    {
        $investment = Investment::where('transaction_id', $transaction_id)->first();
        return view('front.finance.deposit-detail', compact('investment'));
    }

    public function depositHistory()
    {
        $investments = Investment::where('user_id', Auth::id())->orderByRaw("FIELD(status, 'pending', 'approved', 'rejected')")->get();
        // return $investments;
        return view('front.finance.deposit_history', compact('investments'));
    }

    public function depositManual(Request $request)
    {
        $min_deposit = BusinessRule::first()->min_deposit;
        $request->validate(['amount' => 'required|numeric|min:' . $min_deposit]);
        $amount = $request->amount;
        $admin_bank = AdminBank::where('status', 'active')->orderBy('order_no', 'ASC')->first();
        return view('front.finance.deposit-manual', compact('amount', 'admin_bank'));
    }

    public function depositStoreValidate(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'admin_bank_id' => 'required',
            'transaction_id' => 'required|max:255|unique:investments,transaction_id',
            'screenshot' => 'required|image|mimes:jpg,png,jpeg|max:1024',
        ]);

        return response()->json(['message' => 'Validation passed']);
    }

    public function depositStore(Request $request)
    {

        DB::beginTransaction();

        $admin_bank_address = AdminBank::find($request->admin_bank_id)->account_no;

        $investment = new Investment();
        $investment->amount = $request->amount;
        $investment->start_date = now();
        $investment->expiry_date = now()->addYear();
        $investment->status = 'pending';
        $investment->transaction_id = $request->transaction_id;
        $investment->is_active = 'active';
        $investment->user_id = Auth::user()->id;
        $investment->admin_bank_id = $request->admin_bank_id;
        $investment->admin_bank_address = $admin_bank_address;
        $investment->referral_id = Auth::user()->referral_user_id;

        $file = $request->file('screenshot');
        $extension = $file->getClientOriginalExtension();
        $screenshot = time() . rand() . '.' . $extension;
        $file->move('assets/admin/investments/screenshots/', $screenshot);
        $investment->screenshot = 'assets/admin/investments/screenshots/' . $screenshot;

        $investment->save();



        $emailService = new EmailService();
        $user = Auth::user();

        // Send email to user
        $userVariables = [
            'user_name' => $user->username,
            'investment_amount' => number_format($request->amount, 2),
            'investment_date' => now()->format('Y-m-d H:i:s'),
            'company_name' => config('app.name', 'Your Company') // You can set this in config/app.php
        ];

        $emailService->sendEmailToSingleUser('investment_submitted_user', $userVariables, $user->email);
        // Send notification to all admins
        $adminVariables = [
            'user_name' => $user->username,
            'user_email' => $user->email,
            'investment_amount' => number_format($request->amount, 2),
            'investment_date' => now()->format('Y-m-d H:i:s'),
            'company_name' => config('app.name', 'Your Company')
        ];
        $emailService->sendEmailsToAllAdmins('investment_submitted_admin', $adminVariables, 'admin');
        DB::commit();

        return redirect()
            ->route('front.deposit.history')
            ->with('success', 'Request submitted Successfully!');
    }

    public function storeUserBank(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required|max:255',
            'account_no' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Something went wrong, please try again!');
        }

        $user_bank = new UserBank();
        $user_bank->bank_name = $request->bank_name;
        $user_bank->account_no = $request->account_no;
        $user_bank->user_id = Auth::id();
        $user_bank->save();

        return redirect()->back()->with('success', 'Bank added Successfully!');
    }
    public function blockedUser()
    {
        return view('front.blocked-user');
    }

    public function changePassword()
    {
        return view('front.password.change');
    }

    public function changePasswordStore(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/'
            ],
        ]);

        $user = Auth::user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()->with('success', 'Password Updated Successfully');
        }

        return redirect()->back()->with('error', 'Current password does not match!');
    }
}
