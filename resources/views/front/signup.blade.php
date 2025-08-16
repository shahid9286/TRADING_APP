@extends('front.layouts.master')
@section('title', 'Sing Up')
@section('content')

    <section class="account padding-top padding-bottom sec-bg-color2">
        <div class="container">
            <div class="account__wrapper" data-aos="fade-up" data-aos-duration="800">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="account__content account__content--style1">

                            <!-- account tittle -->
                            <div class="account__header">
                                <h1>Create Your Account</h1>
                                
                            </div>

                           

                            <!-- account form -->
                             
                            <form action="{{ route('front.store.user')}}" class="account__form needs-validation" novalidate>
                                @csrf
                                
                                <div class="col-12 mb-2">
                                        <div>
                                            <label for="account-Refferal iD" class="form-label">Refferal iD  </label>
                                            @if(isset($refferal_user))
                                                <input type="text" class="form-control" id="Refferal iD" placeholder="Enter your Refferal iD" value="{{ $refferal_user->email}}">
                                                <input type="hidden" value="{{$refferal_user->id}}" name="refferal_id">
                                                @else
                                                    <input type="text" class="form-control" id="Refferal iD" placeholder="Enter your Refferal iD" >
                                                @endif
                                        </div>
                                    </div>
                                <div class="row g-4">
                                    <div class="col-12 col-md-6">
                                        <div>
                                            <label for="first-name" class="form-label">User Name</label>
                                            <input class="form-control" type="text" id="first-name" name="username" placeholder="Ex. Jhon" >
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div>
                                            <label for="last-name" class="form-label">Last name</label>
                                            <input class="form-control" type="text" id="last-name" placeholder="Ex. Doe">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div>
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-pass">
                                            <label for="account-pass" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control showhide-pass" id="account-pass"
                                                placeholder="Password" required>

                                            <button type="button" id="btnToggle" class="form-pass__toggle"><i
                                                    id="eyeIcon1" class="fa fa-eye"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-pass">
                                            <label for="account-cpass" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control showhide-pass" id="account-cpass"
                                                placeholder="Re-type password" required>

                                            <button type="button" id="btnCToggle" class="form-pass__toggle"><i
                                                    id="eyeIcon2" class="fa fa-eye"></i></button>
                                        </div>
                                    </div>
                                </div>


                                <button type="submit" class="trk-btn trk-btn--border trk-btn--primary d-block mt-4">Sign
                                    Up</button>
                            </form>


                            <div class="account__switch">
                                <p>Don’t have an account yet? <a href="signin.html">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="account__shape">
            <span class="account__shape-item account__shape-item--1"><img src="assets/images/contact/4.png"
                    alt="shape-icon"></span>
        </div>
    </section>

@endsection
