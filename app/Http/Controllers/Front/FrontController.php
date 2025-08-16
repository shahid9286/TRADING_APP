<?php

namespace App\Http\Controllers\Front;

use App\Models\Enquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\UserProfile;
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
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        $remember    = $request->filled('remember');

        // ✅ Step 2: Try login
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // ✅ Step 3: Check if user has "user" role
            if ($user->hasRole('user')) {
                return redirect()->intended('/dashboard') // user dashboard
                    ->with('success', 'You have logged in successfully!');
            }

            // 🚫 If role is not "user", logout immediately
            Auth::logout();
            return back()->withErrors([
                'email' => 'You are not authorized to log in from here.',
            ]);
        }

        // ✅ Step 4: Wrong credentials
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput($request->only('email', 'remember'));
    }


    public function signup($user_name = null)
    {
        $refferal_user = null;

        if (isset($user_name)) {
            $refferal_user = User::where('username', $user_name)->first();
        }

        return view('front.signup', compact('refferal_user'));
    }

    public function storeUser(Request $request)
    {
        //return $request;
        $request->validate([
            'username'   => 'required|min:3|alpha_dash|unique:users,username',
            'email'      => 'required|email|max:255|unique:users,email',
            'password'   => 'required|confirmed|min:6',
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'phone'      => 'required|string|max:20',
            'address'    => 'nullable|string|max:255',
            'referral_id' => 'nullable|exists:users,id',
        ]);

        // ✅ Handle referral
        $referral_user = null;
        if ($request->filled('referral_id')) {
            $referral_user = User::find($request->referral_id);
        }

        // ✅ Assign referral hierarchy (up to 7 levels)
        $level_1_user_id = $referral_user->id ?? null;
        $level_2_user_id = $referral_user->level_1_user_id ?? null;
        $level_3_user_id = $referral_user->level_2_user_id ?? null;
        $level_4_user_id = $referral_user->level_3_user_id ?? null;
        $level_5_user_id = $referral_user->level_4_user_id ?? null;
        $level_6_user_id = $referral_user->level_5_user_id ?? null;
        $level_7_user_id = $referral_user->level_6_user_id ?? null;

        // ✅ Create user
        $user = new User();
        $user->username          = $request->username;
        $user->email             = $request->email;
        $user->phone             = $request->phone;
        $user->password          = Hash::make($request->password);
        $user->status            = 'pending'; // default from schema
        $user->net_balance       = 0;

        // referral tracking
        $user->referral_username = $referral_user->username ?? null;
        $user->referral_user_id  = $referral_user->id ?? null;

        // levels
        $user->level_1_user_id   = $level_1_user_id;
        $user->level_2_user_id   = $level_2_user_id;
        $user->level_3_user_id   = $level_3_user_id;
        $user->level_4_user_id   = $level_4_user_id;
        $user->level_5_user_id   = $level_5_user_id;
        $user->level_6_user_id   = $level_6_user_id;
        $user->level_7_user_id   = $level_7_user_id;

        $user->save();

        // ✅ Assign role "user" (Spatie)
        $user->assignRole('user');

        // ✅ Create profile
        UserProfile::create([
            'user_id'      => $user->id,
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'whatsapp_no'  => $request->whatsapp_no ?? null,
            'address'      => $request->address ?? '',
            'profile_image' => null,
        ]);

        return redirect()->route('front.login')->with('success', 'Account created successfully!');
    }

    public function resetPassword()
    {
        return view('front.reset.password');
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
    public function withdraw()
    {
        return view('front.finance.withdraw');
    }
    public function withdraw_history()
    {

        return view('front.finance.withdraw_history');
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
}
