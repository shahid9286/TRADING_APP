@extends('front.layouts.master')
@section('title', 'Dashboard')
@section('css')
    <style>
        /* p {
                            margin: 0 !important;
                        } */

        .announcement-link:hover {
            color: #ffffff;
        }

        .custom-marquee {
            background: #032830;
            border: 1px solid #087990;
            color: #6EDFF6;
            padding: 10px 20px;
            font-weight: 500;
            font-size: 16px;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .custom-marquee a {
            text-decoration: underline;
            color: #00e1ff;
        }

        marquee span {
            margin-right: 40px;
        }
    </style>
@endsection
@section('content')
    <section class="cta padding-top bg-color">
        <div class="container">
            {{-- @foreach ($announcements as $announcement)
                <div class="cta__wrapper mb-2">
                    <div class="cta__newsletter justify-content-center">
                        <div class="cta__newsletter-inner aos-init aos-animate p-4 m-0 w-100">
                            <div class="cta__subscribe">
                                <h4 class="mb-0"> {{ $announcement->title ?? '' }} (<a target="_blank"
                                        href="{{ $announcement->link_url }}"
                                        class="announcement-link">{{ $announcement->link_text }}</a>)</h4>
                                {!! $announcement->message ?? '' !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach --}}
            <marquee behavior="scroll" direction="left" scrollamount="5" class="custom-marquee">
                @foreach ($announcements as $announcement)
                    <span><b>{{ $announcement->title }}: </b>(<a target="_blank" href="{{ $announcement->link_url }}"
                            class="announcement-link">{{ $announcement->link_text }}</a>) {!! $announcement->message !!}</span>
                @endforeach
            </marquee>
            {{-- <div class="alert alert-info" role="alert">
                sdf
            </div> --}}
        </div>
    </section>

    <section class="service py-3 bg-color">
        <div class="container">
            <div class="service__wrapper">
                <div class="row g-4 align-items-center">
                    <div class="col-12">
                        <div class="service__item service__item--style1 aos-init aos-animate" data-aos="fade-up"
                            data-aos-duration="800">
                            <div class="service__item-inner px-3 pt-4 pb-3">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <div class="service__item-thumb mb-20">
                                            <img width="50px"
                                                src="https://app.supertradeway.com/assets/images/user_rankings/661222da1ea751712464602.png"
                                                alt="s">
                                        </div>
                                        <div class="service__item-content">
                                            <h5>My Invest
                                            </h5>
                                            <h4 class="text-muted p-0 m-0">$0</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="service__item-thumb mb-20">
                                            <img width="50px"
                                                src="https://app.supertradeway.com/assets/templates/bit_gold/dashboard/images/tteam.svg"
                                                alt="s">
                                        </div>
                                        <div class="service__item-content">
                                            <h5>Direct Referrals
                                            </h5>
                                            <h4 class="text-muted p-0 m-0">0</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="service__item-thumb mb-20">
                                            <img width="50px"
                                                src="https://app.supertradeway.com/assets/templates/bit_gold/dashboard/images/tsale.svg"
                                                alt="s">
                                        </div>
                                        <div class="service__item-content">
                                            <h5>Team Invest
                                            </h5>
                                            <h4 class="text-muted p-0 m-0">$0</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="d-flex align-items-center justify-content-center bg-color py-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">

                    <label for="referralLink" class="form-label fw-bold mb-3 text-white fs-4">
                        Your Referral Link
                    </label>

                    <div class="input-group shadow-sm">
                        <input type="text" id="referralLink" class="form-control text-center"
                            value="{{ url('/') }}/user-signup/{{ Auth::user()->username }}" readonly>
                        <button class="trk-btn trk-btn--primary" id="copyBtn" type="button">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>

                    <small id="copyMsg" class="text-success d-none mt-3">
                        ✅ Copied to clipboard!
                    </small>

                </div>
            </div>
        </div>
    </section>
    <section class="service py-3 bg-color">
        <div class="container">
            <div class="service__wrapper">
                <div class="row g-4 align-items-center">
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="service__item service__item--style1 aos-init aos-animate" data-aos="fade-up"
                            data-aos-duration="800">
                            <div class="service__item-inner px-5 pt-5 pb-4">
                                <div class="service__item-thumb mb-20">
                                    <img width="50px"
                                        src="https://app.supertradeway.com/assets/templates/bit_gold/dashboard/images/dollar.svg"
                                        alt="s">
                                </div>
                                <div class="service__item-content">
                                    <h5> <a class="stretched-link" href="#">Deposit Wallet Balance</a>
                                    </h5>
                                    <span class="text-muted">$0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="service__item service__item--style1 aos-init aos-animate" data-aos="fade-up"
                            data-aos-duration="800">
                            <div class="service__item-inner px-5 pt-5 pb-4">
                                <div class="service__item-thumb mb-20">
                                    <img width="50px"
                                        src="https://app.supertradeway.com/assets/templates/bit_gold/dashboard/images/wallet.svg"
                                        alt="s">
                                </div>
                                <div class="service__item-content">
                                    <h5> <a class="stretched-link" href="#">Profit Wallet Balance</a>
                                    </h5>
                                    <span class="text-muted">$0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="service__item service__item--style1 aos-init aos-animate" data-aos="fade-up"
                            data-aos-duration="800">
                            <div class="service__item-inner px-5 pt-5 pb-4">
                                <div class="service__item-thumb mb-20">
                                    <img width="50px"
                                        src="https://app.supertradeway.com/assets/templates/bit_gold/dashboard/images/users.svg"
                                        alt="s">
                                </div>
                                <div class="service__item-content">
                                    <h5> <a class="stretched-link" href="#">Referral Earnings</a>
                                    </h5>
                                    <span class="text-muted">$0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="service__item service__item--style1 aos-init aos-animate" data-aos="fade-up"
                            data-aos-duration="800">
                            <div class="service__item-inner px-5 pt-5 pb-4">
                                <div class="service__item-thumb mb-20">
                                    <img width="50px"
                                        src="https://app.supertradeway.com/assets/templates/bit_gold/dashboard/images/tdeposit.svg"
                                        alt="s">
                                </div>
                                <div class="service__item-content">
                                    <h5> <a class="stretched-link" href="#">Total Deposit</a>
                                    </h5>
                                    <span class="text-muted">$0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="service__item service__item--style1 aos-init aos-animate" data-aos="fade-up"
                            data-aos-duration="800">
                            <div class="service__item-inner px-5 pt-5 pb-4">
                                <div class="service__item-thumb mb-20">
                                    <img width="50px"
                                        src="https://app.supertradeway.com/assets/templates/bit_gold/dashboard/images/invest.svg"
                                        alt="s">
                                </div>
                                <div class="service__item-content">
                                    <h5> <a class="stretched-link" href="#">Total Invest</a>
                                    </h5>
                                    <span class="text-muted">$0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="service__item service__item--style1 aos-init aos-animate" data-aos="fade-up"
                            data-aos-duration="800">
                            <div class="service__item-inner px-5 pt-5 pb-4">
                                <div class="service__item-thumb mb-20">
                                    <img width="50px"
                                        src="https://app.supertradeway.com/assets/templates/bit_gold/dashboard/images/twithdraw.svg"
                                        alt="s">
                                </div>
                                <div class="service__item-content">
                                    <h5> <a class="stretched-link" href="#">Total Withdraw</a>
                                    </h5>
                                    <span class="text-muted">$0</span>
                                </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            const copyBtn = document.getElementById('copyBtn');
            const input = document.getElementById('referralLink');
            const msg = document.getElementById('copyMsg');

            copyBtn.addEventListener('click', function() {
                input.select();
                input.setSelectionRange(0, 99999); // For mobile
                navigator.clipboard.writeText(input.value).then(() => {
                    msg.classList.remove('d-none');
                    setTimeout(() => msg.classList.add('d-none'), 2000);
                });
            });
        });
    </script>
@endsection
