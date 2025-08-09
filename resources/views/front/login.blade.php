@extends('front.layouts.master')
@section('title', 'User Login')
@section('content')

<section class="account padding-top padding-bottom sec-bg-color2">
    <div class="container">
      <div class="account__wrapper" data-aos="fade-up" data-aos-duration="800">
        <div class="row g-4">
          <div class="col-lg-12">
            <div class="account__content account__content--style1">

              <!-- account tittle -->
              <div class="account__header">
                <h2>Welcome back!</h2>
                <p>Hey there! Ready to log in? Just enter your username and password below and you'll be back in action
                  in no time. Let's go!</p>
              </div>

              <!-- account social -->
             

              <!-- account divider -->
              <div class="account__divider account__divider--style1">
                <span>or</span>
              </div>

              <!-- account form -->
              <form action="#" class="account__form needs-validation" novalidate>
                <div class="row g-4">
                  <div class="col-12">
                    <div>
                      <label for="account-email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="account-email" placeholder="Enter your email"
                        required>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-pass">
                      <label for="account-pass" class="form-label">Password</label>
                      <input type="password" class="form-control showhide-pass" id="account-pass" placeholder="Password"
                        required>

                      <button type="button" id="btnToggle" class="form-pass__toggle"><i id="eyeIcon"
                          class="fa fa-eye"></i></button>
                    </div>
                  </div>
                </div>

                <div class="account__check">

                  <div class="account__check-remember">
                    <input type="checkbox" class="form-check-input" value="" id="terms-check">
                    <label for="terms-check" class="form-check-label">
                      Remember me
                    </label>
                  </div>
                  <div class="account__check-forgot">
                    <a href="forgot-pass.html">Forgot Password?</a>
                  </div>
                </div>

                <button type="submit" class="trk-btn trk-btn--border trk-btn--primary d-block mt-4">Sign in</button>
              </form>


              <div class="account__switch">
                <p>Don't have an account? <a href="signup.html">Sign up</a></p>
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