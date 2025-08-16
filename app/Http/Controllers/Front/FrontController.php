<?php

namespace App\Http\Controllers\Front;

use App\Models\Enquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{

    public function index()
    {
        return view('front.index');
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

        $request->validate([
            'email' => 'required|email|max:255|unique:users,email',
            'username' => 'required|min:3|alpha_dash|unique:users,username',
            'password' => 'required',
            'refferal_id' => 'required',
        ]);

        // Referral username (default admin if not provided)
        $refferal_username = $request->refferal_username ?? 'admin';

        // Check referral user exist
        $refferal_user = User::where('username', $refferal_username)->first();

        if (!$refferal_user) {
            Alert::toast('Referral User Does not Exist!', 'warning');
            return redirect()->back();
        }

        // Assign levels without loop
        $level_1_user_id = $refferal_user->id ?? null;
        $level_2_user_id = $refferal_user->level_1_user_id ?? null;
        $level_3_user_id = $refferal_user->level_2_user_id ?? null;
        $level_4_user_id = $refferal_user->level_3_user_id ?? null;
        $level_5_user_id = $refferal_user->level_4_user_id ?? null;
        $level_6_user_id = $refferal_user->level_5_user_id ?? null;
        $level_7_user_id = $refferal_user->level_6_user_id ?? null;

        // Create new user
        $user_role = Role::findOrFail($request->role_id);
        $user = new User();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->status = 0;
        $user->voucher_status = 0;

        $user->refferal_username = $refferal_username;
        $user->refferal_user_id = $refferal_user->id;

        // Save referral levels
        $user->level_1_user_id = $level_1_user_id;
        $user->level_2_user_id = $level_2_user_id;
        $user->level_3_user_id = $level_3_user_id;
        $user->level_4_user_id = $level_4_user_id;
        $user->level_5_user_id = $level_5_user_id;
        $user->level_6_user_id = $level_6_user_id;
        $user->level_7_user_id = $level_7_user_id;

        $user->save();
        $user->assignRole($user_role);


        return redirect()->route('login');
    }

    public function login()
    {
        return view('front.login');
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
