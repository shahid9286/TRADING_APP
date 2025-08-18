@extends('front.layouts.master')
@section('title', 'Reset Password')
@section('content')

    <section class="account padding-top padding-bottom sec-bg-color2">
        <div class="container">
            <div class="account__wrapper" data-aos="fade-up" data-aos-duration="800">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="account__content account__content--style1">

                            <div class="account__header">
                                <h2>Change Password</h2>
                            </div>

                            <form method="POST" action="{{ route('front.password.update') }}"
                                class="account__form needs-validation" novalidate>
                                @csrf

                                <!-- Hidden inputs -->
                                <input type="hidden" name="token" value="{{ request()->route('token') }}">
                                <input type="hidden" name="email" value="{{ old('email', request()->email) }}">

                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" required>
                                </div>

                                <button type="submit" class="trk-btn trk-btn--border trk-btn--primary d-block mt-4">
                                    Change Password
                                </button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
