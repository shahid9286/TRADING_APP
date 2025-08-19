@extends('front.layouts.master')
@section('title', 'Sing Up')
@section('content')

    <section class="account padding-top padding-bottom sec-bg-color2">
        <div class="container">
            <div class="account__wrapper" data-aos="fade-up" data-aos-duration="800">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="account__content account__content--style1">

                            <div class="account__header">
                                <h2>Reset Your Password</h2>
                                <p>Hey there! Forgot your password? No worries, just click "forgot password" and follow the
                                    steps to
                                    recover it. Easy peasy lemon squeezy!</p>
                            </div>

                            <form method="POST" action="{{ route('password.email') }}"
                                class="account__form needs-validation" novalidate>
                                @csrf
                                <div class="row g-4">
                                    <div class="col-12">
                                        <div>
                                            <label for="account-email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="account-email" name="email" placeholder="Enter your email" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="trk-btn trk-btn--border trk-btn--primary d-block mt-4">
                                    Reset password
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
