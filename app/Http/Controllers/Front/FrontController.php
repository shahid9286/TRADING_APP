<?php

namespace App\Http\Controllers\Front;

use App\Models\Enquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{

    public function index()
    {
        return view('front.index');
    }

    public function signup()
    {
        return view('front.signup');
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
<<<<<<< HEAD
     public function privacyPolicy()
    {
        return view('front.privacy.policy');
    }

    
    
=======
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

>>>>>>> de4fe0abe1e3ee1bcb937f0b03c80380bdd27081
}




