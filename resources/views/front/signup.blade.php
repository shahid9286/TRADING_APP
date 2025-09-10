@extends('front.layouts.master')
@section('title', 'Sign Up')

@section('content')
    <section class="account padding-top padding-bottom sec-bg-color2">
        <div class="container">
            <div class="account__wrapper" data-aos="fade-up" data-aos-duration="800">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="account__content account__content--style1">

                            <!-- account title -->
                            <div class="account__header">
                                <h1>Create Your Account</h1>
                            </div>

                            <!-- account form -->
                            <form action="{{ route('front.store.user') }}" method="POST"
                                class="account__form needs-validation" novalidate>
                                @csrf

                                {{-- Referral ID --}}
                                <div class="col-12 mb-3">
                                    <label for="referral_username" class="form-label">Referred By</label>

                                    @if (!empty($referral_username))
                                        {{-- Case: Came from referral link --}}
                                        <input type="text" class="form-control" id="referral_username"
                                            name="referral_username" value="{{ $referral_username }}" readonly>
                                        @error('referral_username')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    @else
                                        {{-- Case: Manual input OR blank --}}
                                        <input type="text" class="form-control" id="referral_username"
                                            name="referral_username" placeholder="Enter Referral Username (Optional)"
                                            value="{{ old('referral_username') }}">
                                        @error('referral_username')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    @endif
                                </div>


                                <div class="row g-4">
                                    {{-- Username --}}
                                    <div class="col-12 col-md-6">
                                        <label for="username" class="form-label">Username <span class="text-danger"> *
                                            </span></label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="Ex. john_doe" value="{{ old('username') }}" required>
                                        @error('username')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Phone --}}
                                    <div class="col-12 col-md-6">
                                        <label for="phone" class="form-label">Mobile <span class="text-danger"> *
                                            </span></label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="+971123456789" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="col-12">
                                        <label for="email" class="form-label">Email Address <span class="text-danger"> *
                                            </span></label>
                                        <div class="input-group">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Enter your email" value="{{ old('email') }}" required>
                                            <button type="button" id="sendOtpBtn" class="btn btn-outline-primary">
                                                <span class="btn-text">Verify Email</span>
                                                <span class="spinner-border spinner-border-sm d-none" role="status"
                                                    aria-hidden="true"></span>
                                            </button>
                                        </div>
                                        <small id="emailMsg" class="text-success d-none"></small>
                                    </div>

                                    {{-- OTP --}}
                                    <div class="col-12 d-none" id="otpSection">
                                        <label for="otp" class="form-label">Enter OTP</label>

                                        <div class="input-group">
                                            <input type="text" class="form-control" id="otp" name="otp"
                                                placeholder="Enter OTP">
                                            <button type="button" id="verifyOtpBtn" class="btn btn-outline-success">
                                                <span class="btn-text">Submit OTP</span>
                                                <span class="spinner-border spinner-border-sm d-none" role="status"
                                                    aria-hidden="true"></span>
                                            </button>
                                        </div>
                                        <small id="otpMsg" class="d-none"></small>
                                    </div>


                                    {{-- Password --}}
                                    <div class="col-12 col-md-6">
                                        <div class="form-pass">
                                            <label for="password" class="form-label">Password <span class="text-danger">
                                                    *
                                                </span></label>
                                            <input type="password" name="password" class="form-control showhide-pass"
                                                id="password" placeholder="Password" required>
                                            <button type="button" id="btnToggle" class="form-pass__toggle">
                                                <i id="eyeIcon1" class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Confirm Password --}}
                                    <div class="col-12 col-md-6">
                                        <div class="form-pass">
                                            <label for="password_confirmation" class="form-label">Confirm Password
                                                <span class="text-danger"> * </span></label>
                                            <input type="password" class="form-control showhide-pass"
                                                id="password_confirmation" name="password_confirmation"
                                                placeholder="Re-type password" required>
                                            <button type="button" id="btnCToggle" class="form-pass__toggle">
                                                <i id="eyeIcon2" class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="signupBtn"
                                    class="trk-btn trk-btn--border trk-btn--primary d-block mt-4" disabled>
                                    <span class="btn-text">Sign Up</span>
                                    <span class="spinner-border spinner-border-sm d-none" role="status"
                                        aria-hidden="true"></span>
                                </button>
                            </form>

                            <div class="account__switch">
                                <p>Already have an account? <a href="{{ route('front.login') }}">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('js')
    <script>
        // Toggle password visibility
        document.getElementById('btnToggle').addEventListener('click', function() {
            let pass = document.getElementById('password');
            let icon = document.getElementById('eyeIcon1');
            if (pass.type === 'password') {
                pass.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                pass.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });

        document.getElementById('btnCToggle').addEventListener('click', function() {
            let pass = document.getElementById('password_confirmation');
            let icon = document.getElementById('eyeIcon2');
            if (pass.type === 'password') {
                pass.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                pass.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Send OTP
            $("#sendOtpBtn").click(function() {
                let email = $("#email").val();
                if (!email) {
                    alert("Please enter email first!");
                    return;
                }

                let btn = $(this);
                btn.find(".btn-text").addClass("d-none");
                btn.find(".spinner-border").removeClass("d-none");
                btn.prop("disabled", true);
                $.ajax({
                    url: "{{ route('send.otp') }}",
                    type: "POST",
                    data: {
                        email: email,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        if (res.status) {
                            $("#otpSection").removeClass("d-none");
                            $("#emailMsg").text(res.message).removeClass("d-none text-danger")
                                .addClass("text-success");
                        } else {
                            $("#emailMsg").text(res.message).removeClass("d-none text-success")
                                .addClass("text-danger");
                        }
                    },
                    error: function(xhr) {
                        let err = xhr.responseJSON.errors;
                        if (err && err.email) {
                            $("#emailMsg").text(err.email[0]).removeClass("d-none text-success")
                                .addClass("text-danger");
                        }
                    },
                    complete: function() {
                        btn.find(".btn-text").removeClass("d-none");
                        btn.find(".spinner-border").addClass("d-none");
                        btn.prop("disabled", false);
                    }
                });
            });
            $("#verifyOtpBtn").click(function() {
                let otp = $("#otp").val();
                if (!otp) {
                    alert("Enter OTP first!");
                    return;
                }

                let btn = $(this);
                btn.find(".btn-text").addClass("d-none");
                btn.find(".spinner-border").removeClass("d-none");
                btn.prop("disabled", true);

                $.ajax({
                    url: "{{ route('verify.otp') }}",
                    type: "POST",
                    data: {
                        otp: otp,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        if (res.status) {
                            $("#otpMsg").text(res.message).removeClass("d-none text-danger")
                                .addClass("text-success");
                            $("#sendOtpBtn").prop("disabled", true);
                            $("#verifyOtpBtn").prop("disabled", true);
                            $("#email").prop("readonly", true);
                            $("#signupBtn").prop("disabled", false);
                        } else {
                            $("#otpMsg").text(res.message).removeClass("d-none text-success")
                                .addClass("text-danger");
                            btn.prop("disabled", false);
                        }
                    },
                    complete: function() {
                        btn.find(".btn-text").removeClass("d-none");
                        btn.find(".spinner-border").addClass("d-none");
                    }
                });
            });
            $("#signupForm").on("submit", function(e) {
                let form = $(this);
                let valid = true;
                form.find("input[required], select[required], textarea[required]").each(function() {
                    if (!$(this).val()) {
                        valid = false;
                        $(this).addClass("is-invalid"); // bootstrap red border
                    } else {
                        $(this).removeClass("is-invalid");
                    }
                });

                if (!valid) {
                    e.preventDefault(); 
                    return;
                }

                // show spinner only when valid
                let btn = $("#signupBtn");
                btn.find(".btn-text").addClass("d-none");
                btn.find(".spinner-border").removeClass("d-none");
                btn.prop("disabled", true);
            });

        });
    </script>

@endsection
