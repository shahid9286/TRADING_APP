<?php

namespace App\Http\Controllers\Front;

use App\Models\Enquiry;
use App\Models\Investment;
use App\Models\UserBank;
use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminBank;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{

    public function login()
    {
        if (Auth::check() && Auth::user()->hasRole('user')) {
            return redirect()->route('user.dashboard');
        }
        return view('front.login');
    }
    public function loginUser(Request $request)
    {
        // ✅ Step 1: Validate input
        $request->validate([
            'login'    => 'required|string', // can be email or username
            'password' => 'required|min:6',
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password,
        ];

        $remember = $request->filled('remember');

        // ✅ Step 2: Try login
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // ✅ Step 3: Check if user has "user" role
            if ($user->hasRole('user')) {
                return redirect()->intended('/user/dashboard') // user dashboard
                    ->with('success', 'You have logged in successfully!');
            }

            // 🚫 If role is not "user", logout immediately
            Auth::logout();
            return back()->withErrors([
                'login' => 'You are not authorized to log in from here.',
            ]);
        }

        // ✅ Step 4: Wrong credentials
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
            'username'    => 'required|min:3|alpha_dash|unique:users,username',
            'email'       => 'required|email|max:255|unique:users,email',
            'phone'       => 'required|string|max:20',
            'password'    => 'required|confirmed|min:6',
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
            'username'          => $request->username,
            'email'             => $request->email,
            'phone'             => $request->phone,
            'password'          => Hash::make($request->password),
            'status'            => 'pending',
            'net_balance'       => 0,
            'referral_username' => $referral_user->username ?? null,
            'referral_user_id'  => $referral_user->id ?? null,
            'level_1_user_id'   => $level_1_user_id,
            'level_2_user_id'   => $level_2_user_id,
            'level_3_user_id'   => $level_3_user_id,
            'level_4_user_id'   => $level_4_user_id,
            'level_5_user_id'   => $level_5_user_id,
            'level_6_user_id'   => $level_6_user_id,
            'level_7_user_id'   => $level_7_user_id,
        ]);

        // ✅ Assign role
        $user->assignRole('user');

        return redirect()->route('front.login')
            ->with('success', 'Account created successfully! Please login.');
    }

    public function createProfile()
    {
        $profile = UserProfile::where('user_id', Auth::id())->first();
        // if ($profile) {
        //     return redirect()->route('front.profile.edit');
        // }
        return view('front.create-profile');
    }

    
public function ProfileStore(Request $request)
{
    $validator = Validator::make($request->all(), [
        'first_name'    => 'required|string|max:255',
        'last_name'     => 'required|string|max:255',
        'country'       => 'required|string|max:255',
        'city'          => 'required|string|max:255',
        'profile_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ], 422);
    }

    // Get logged-in user
    $user = Auth::user();

    // Update profile details
    $user->first_name = $request->first_name;
    $user->last_name  = $request->last_name;
    $user->country    = $request->country;
    $user->city       = $request->city;

    // Handle profile image upload
    if ($request->hasFile('profile_image')) {
        $image = $request->file('profile_image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/profile_images'), $filename);

        // store only file path
        $user->profile_image = 'uploads/profile_images/' . $filename;
    }

    $user->save();

    return redirect()->back()->with([
        'message' => 'Profile updated successfully!',
        'alert'   => 'success',
    ]);
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

        $validator = Validator::make($request->all(), [
            'bank_account'  => 'required|exists:user_banks,id',
            'amount' => 'required|numeric|min:1|max:'.$available_balance,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Validation failed, please recheck the form!');
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
        return view('front.finance.transaction');
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

    public function depositManual(Request $request)
    {
        $request->validate(['amount' => 'required']);
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

        $investment = new Investment();
        $investment->amount = $request->amount;
        $investment->start_date = now();
        $investment->expiry_date = now()->addYear();
        $investment->status = 'pending';
        $investment->transaction_id = $request->transaction_id;
        $investment->is_active = 'active';
        $investment->user_id = Auth::user()->id;
        $investment->admin_bank_id = $request->admin_bank_id;
        $investment->referral_id = Auth::user()->referral_user_id;

        $file = $request->file('screenshot');
        $extension = $file->getClientOriginalExtension();
        $screenshot = time() . rand() . '.' . $extension;
        $file->move('assets/admin/investments/screenshots/', $screenshot);
        $investment->screenshot = 'assets/admin/investments/screenshots/' . $screenshot;

        $investment->save();


        DB::commit();

        return redirect()
            ->route('front.deposit')
            ->with('success', 'Request submitted Successfully!');
    }

    public function storeUserBank(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank_name'  => 'required|max:255',
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
}
