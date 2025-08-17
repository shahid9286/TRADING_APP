@extends('front.layouts.master')
@section('title', 'User Login')
@section('content')
    <section class="account padding-top padding-bottom sec-bg-color2">
        <div class="container">
            <div class="account__wrapper" data-aos="fade-up" data-aos-duration="800">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="account__content account__content--style1">

                            <!-- Laravel Login Form -->
                            <form method="POST" action="{{ route('front.login.user') }}" class="account__form needs-validation"
                                novalidate>
                                @csrf

                                <div class="row">
                                    <!-- Email -->
                                    <div class="col-12">
                                        <div>
                                            <label for="email" class="form-label">Email  <span class="text-danger"> * </span></label>
                                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Enter your email" required autofocus>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-12">
                                        <div class="form-pass">
                                            <label for="password" class="form-label">Password  <span class="text-danger"> * </span></label>
                                            <input type="password" name="password" id="password"
                                                class="form-control showhide-pass @error('password') is-invalid @enderror"
                                                placeholder="Password" required>

                                            <button type="button" id="btnToggle" class="form-pass__toggle">
                                                <i id="eyeIcon" class="fa fa-eye"></i>
                                            </button>

                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Remember Me + Forgot Password -->
                                <div class="account__check">
                                    <div class="account__check-remember">
                                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                        <label for="remember" class="form-check-label">Remember me</label>
                                    </div>
                                    <div class="account__check-forgot">
                                        @if (Route::has('front.forgot.password'))
                                            <a href="{{ route('front.forgot.password') }}">Forgot Password?</a>
                                        @endif
                                    </div>
                                </div>

                                <!-- Submit -->
                                <button type="submit" class="trk-btn trk-btn--border trk-btn--primary d-block mt-4">
                                    Sign in
                                </button>
                            </form>

                            <!-- Switch to Signup -->
                            <div class="account__switch">
                                <p>Don't have an account?
                                    <a href="{{ route('front.signup') }}">Sign up</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decorative Shapes -->
        <div class="account__shape">
            <span class="account__shape-item account__shape-item--1">
                <img src="assets/images/contact/4.png" alt="shape-icon">
            </span>
        </div>
    </section>

    <!-- Show/Hide Password Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleBtn = document.getElementById("btnToggle");
            const passwordInput = document.getElementById("password");
            const eyeIcon = document.getElementById("eyeIcon");

            toggleBtn.addEventListener("click", function() {
                const isPassword = passwordInput.type === "password";
                passwordInput.type = isPassword ? "text" : "password";

                // Toggle eye / eye-slash icon
                eyeIcon.classList.toggle("fa-eye");
                eyeIcon.classList.toggle("fa-eye-slash");
            });
        });
    </script>

@endsection
