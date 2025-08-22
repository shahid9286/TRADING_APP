@extends('front.layouts.master')
@section('title', 'Dashboard')
@section('content')


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
                                            <h5>Net Balance</h5>
                                            <h4 class="text-muted p-0 m-0">$ {{ auth()->user()->net_balance ?? 0 }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="service__item-thumb mb-20">
                                            <img width="50px"
                                                src="https://app.supertradeway.com/assets/templates/bit_gold/dashboard/images/tteam.svg"
                                                alt="s">
                                        </div>
                                        <div class="service__item-content">
                                            <h5>Locked Amount
                                            </h5>
                                            <h4 class="text-muted p-0 m-0">$ {{ auth()->user()->locked_amount ?? 0 }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="service__item-thumb mb-20">
                                            <img width="50px"
                                                src="https://app.supertradeway.com/assets/templates/bit_gold/dashboard/images/tsale.svg"
                                                alt="s">
                                        </div>
                                        <div class="service__item-content">
                                            <h5>Total Invested
                                            </h5>
                                            <h4 class="text-muted p-0 m-0">$ {{ auth()->user()->userTotal->total_invested ?? 0 }}</h4>
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
                                    <h6> <a class="stretched-link" href="#">Current Month Salary</a></h6>
                                    <h4 class="text-muted p-0 m-0">$ {{ auth()->user()->current_month_salary ?? 0 }}</h4>
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
                                    <h5> <a class="stretched-link" href="#">Next Month Salary</a>
                                    </h5>
                                    <h4 class="text-muted p-0 m-0">$ {{ auth()->user()->next_month_salary ?? 0 }}</h4>
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
                                    <h5> <a class="stretched-link" href="#">Salaries Received</a></h5>
                                    <h4 class="text-muted p-0 m-0">{{ auth()->user()->userTotal->total_salaries ?? 0 }}</h4>
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
                                    <h5> <a class="stretched-link" href="#">Total Refferal Commision</a></h5>
                                    <h4 class="text-muted p-0 m-0">{{ auth()->user()->userTotal->total_refferal_commision ?? 0 }}</h4>
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
                                    <h5> <a class="stretched-link" href="#">Total Rewards</a></h5>
                                    <h4 class="text-muted p-0 m-0">{{ auth()->user()->userTotal->total_rewards ?? 0 }}</h4>
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
                                    <h5> <a class="stretched-link" href="#">Total Withdraws</a></h5>
                                    <h4 class="text-muted p-0 m-0">{{ auth()->user()->userTotal->total_withdraws ?? 0 }}</h4>
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
                                    <h5> <a class="stretched-link" href="#">Total Refferal Commision</a></h5>
                                    <h4 class="text-muted p-0 m-0">{{ auth()->user()->userTotal->total_refferal_commision ?? 0 }}</h4>
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
                                    <h5> <a class="stretched-link" href="#">Total Rewards</a></h5>
                                    <h4 class="text-muted p-0 m-0">{{ auth()->user()->userTotal->total_rewards ?? 0 }}</h4>
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
                                    <h5> <a class="stretched-link" href="#">Total Withdraws</a></h5>
                                    <h4 class="text-muted p-0 m-0">{{ auth()->user()->userTotal->total_withdraws ?? 0 }}</h4>
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
                                    <h5> <a class="stretched-link" href="#">Total Fee</a></h5>
                                    <h4 class="text-muted p-0 m-0">{{ auth()->user()->userTotal->total_fee ?? 0 }}</h4>
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
                                    <h5> <a class="stretched-link" href="#">level_1_investment</a></h5>
                                    <h4 class="text-muted p-0 m-0">{{ auth()->user()->userTotal->level_1_investment ?? 0 }}</h4>
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
                                    <h5> <a class="stretched-link" href="#">level_2_investment</a></h5>
                                    <h4 class="text-muted p-0 m-0">{{ auth()->user()->userTotal->level_2_investment ?? 0 }}</h4>
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
                                    <h5> <a class="stretched-link" href="#">level_3_investment</a></h5>
                                    <h4 class="text-muted p-0 m-0">{{ auth()->user()->userTotal->level_3_investment ?? 0 }}</h4>
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
                                    <h5> <a class="stretched-link" href="#">level_4_investment</a></h5>
                                    <h4 class="text-muted p-0 m-0">{{ auth()->user()->userTotal->level_4_investment ?? 0 }}</h4>
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
                                    <h5> <a class="stretched-link" href="#">level_5_investment</a></h5>
                                    <h4 class="text-muted p-0 m-0">{{ auth()->user()->userTotal->level_5_investment ?? 0 }}</h4>
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
                                    <h5> <a class="stretched-link" href="#">level_6_investment</a></h5>
                                    <h4 class="text-muted p-0 m-0">{{ auth()->user()->userTotal->level_6_investment ?? 0 }}</h4>
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
                                    <h5> <a class="stretched-link" href="#">level_7_investment</a></h5>
                                    <h4 class="text-muted p-0 m-0">{{ auth()->user()->userTotal->level_7_investment ?? 0 }}</h4>
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
