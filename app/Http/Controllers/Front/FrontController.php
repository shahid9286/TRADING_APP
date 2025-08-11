<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    
    
}




