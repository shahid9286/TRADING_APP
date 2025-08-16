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
                                    <label for="referral_id" class="form-label">Referral ID</label>
                                    @if (isset($refferal_user))
                                        <input type="text" class="form-control" id="referral_id_display"
                                            value="{{ $refferal_user->username }}" readonly>
                                        <input type="hidden" name="referral_id" value="{{ $refferal_user->id }}">
                                    @else
                                        <input type="text" class="form-control" id="referral_id" name="referral_id"
                                            placeholder="Enter Referral Username (Optional)">
                                    @endif
                                </div>

                                <div class="row g-4">
                                    {{-- Username --}}
                                    <div class="col-12 col-md-6">
                                        <label for="username" class="form-label">User Name</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="Ex. john_doe" value="{{ old('username') }}" required>
                                        @error('username')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                     {{-- Phone --}}
                                    <div class="col-12 col-md-6">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="Ex. john_doe" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                     {{-- Frist Name --}}
                                    <div class="col-12 col-md-6">
                                        <label for="first_name" class="form-label">Frist Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            placeholder="Ex. Doe" value="{{ old('first_name') }}">
                                        @error('first_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Last Name --}}
                                    <div class="col-12 col-md-6">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            placeholder="Ex. Doe" value="{{ old('last_name') }}">
                                        @error('last_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter your email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Password --}}
                                    <div class="col-12">
                                        <div class="form-pass">
                                            <label for="password" class="form-label">Password</label>
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
                                    <div class="col-12">
                                        <div class="form-pass">
                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control showhide-pass"
                                                id="password_confirmation" name="password_confirmation"
                                                placeholder="Re-type password" required>
                                            <button type="button" id="btnCToggle" class="form-pass__toggle">
                                                <i id="eyeIcon2" class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="trk-btn trk-btn--border trk-btn--primary d-block mt-4">
                                    Sign Up
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

        <!-- background shape -->
        <div class="account__shape">
            <span class="account__shape-item account__shape-item--1">
                <img src="{{ asset('front/images/contact/4.png') }}" alt="shape-icon">
            </span>
        </div>
    </section>

    @push('scripts')
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
    @endpush
@endsection
