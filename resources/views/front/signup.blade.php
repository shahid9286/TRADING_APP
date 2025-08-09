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
                                <h2>Create Your Account</h2>
                                <p>Hey there! Ready to join the party? We just need a few details from you to get started.
                                    Let's do
                                    this!</p>
                            </div>

                            <!-- account social -->
                            <div class="account__social">
                                <a href="#" class="account__social-btn"><span><img
                                            src="assets/images/others/google.svg" alt="google icon"></span>
                                    Continue with google
                                </a>
                            </div>

                            <!-- account divider -->
                            <div class="account__divider account__divider--style1">
                                <span>or</span>
                            </div>

                            <!-- account form -->
                            <form action="#" class="account__form needs-validation" novalidate>
                                <div class="row g-4">
                                    <div class="col-12 col-md-6">
                                        <div>
                                            <label for="first-name" class="form-label">First name</label>
                                            <input class="form-control" type="text" id="first-name"
                                                placeholder="Ex. Jhon">
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
                                            <label for="account-email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="account-email"
                                                placeholder="Enter your email" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-pass">
                                            <label for="account-pass" class="form-label">Password</label>
                                            <input type="password" class="form-control showhide-pass" id="account-pass"
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
