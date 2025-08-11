@extends('front.layouts.master')
@section('title', 'Sing Up')
@section('content')
 <!-- ===============>> account start here <<================= -->
  <section class="account padding-top padding-bottom sec-bg-color2">
    <div class="container">
      <div class="account__wrapper" data-aos="fade-up" data-aos-duration="800">
        <div class="row g-4">
          <div class="col-lg-12">
            <div class="account__content account__content--style1">

              <!-- account tittle -->
              <div class="account__header">
                <h2>Reset Your Password</h2>
                <p>Hey there! Forgot your password? No worries, just click "forgot password" and follow the steps to
                  recover it. Easy peasy lemon squeezy!</p>
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
                </div>

                <button type="submit" class="trk-btn trk-btn--border trk-btn--primary d-block mt-4">Reset
                  password</button>
              </form>


              <div class="account__switch">
                <p> <a href="signin.html" class="style2"><i class="fa-solid fa-arrow-left-long"></i> Back to <span>Login</span></a></p>
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
  <!-- ===============>> account end here <<================= -->



@endsection