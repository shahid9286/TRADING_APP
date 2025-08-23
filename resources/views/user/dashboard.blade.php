@extends('front.layouts.master')
@section('title', 'Dashboard')
@section('css')
    <style>
        .radius-10 {
            border-radius: 10px !important;
        }

        .border-info {
            border-left: 5px solid #3bc9db !important;
        }

        .border-danger {
            border-left: 5px solid #ff6b6b !important;
        }

        .border-success {
            border-left: 5px solid #51cf66 !important;
        }

        .border-warning {
            border-left: 5px solid #ffd43b !important;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #122520;
            background-clip: border-box;
            border: 0px solid rgba(0, 0, 0, 0);
            border-radius: .25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 6px 0 #091E18, 0 2px 6px 0 #091E18;
            color: #e0e0e0;
        }

        .bg-gradient-info {
            background: linear-gradient(45deg, #1abc9c, #2980b9) !important;
        }

        .bg-gradient-danger {
            background: linear-gradient(45deg, #e74c3c, #c0392b) !important;
        }

        .bg-gradient-success {
            background: linear-gradient(45deg, #27ae60, #16a085) !important;
        }

        .bg-gradient-warning {
            background: linear-gradient(45deg, #f39c12, #d35400) !important;
        }

        .widgets-icons-2 {
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #1c332d;
            /* darker background */
            font-size: 27px;
            border-radius: 10px;
            color: #fff;
        }
    </style>

@endsection
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
                                            <h4 class="text-muted p-0 m-0">$
                                                {{ auth()->user()->userTotal->total_invested ?? 0 }}</h4>
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
                    {{-- <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card radius-10 border-start border-0 border-3 border-info">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Orders</p>
                                        <h4 class="my-1 text-info">4805</h4>
                                        <p class="mb-0 font-13">+2.5% from last week</p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-info text-white ms-auto"><i
                                            class="fa fa-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card radius-10 border-start border-0 border-3 border-danger">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Orders</p>
                                        <h4 class="my-1 text-danger">4805</h4>
                                        <p class="mb-0 font-13">+2.5% from last week</p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-danger text-white ms-auto"><i
                                            class="fa fa-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card radius-10 border-start border-0 border-3 border-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 text-secondary">Total Orders</p>
                                        <h4 class="my-1 text-success">4805</h4>
                                        <p class="mb-0 font-13">+2.5% from last week</p>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-success text-white ms-auto"><i
                                            class="fa fa-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card radius-10 border-start border-0 border-3 border-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6> <a class="stretched-link" href="#">Current Monthly Salary</a></h6>
                                        <h4 class="my-1 text-success">$ {{ auth()->user()->current_month_salary ?? 0 }}</h4>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-success text-white ms-auto">
                                        <i class="fa fa-dollar-sign"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card radius-10 border-start border-0 border-3 border-info">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6> <a class="stretched-link" href="#">Next Month Salary</a></h6>
                                        <h4 class="my-1 text-info">$ {{ auth()->user()->next_month_salary ?? 0 }}</h4>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-info text-white ms-auto">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card radius-10 border-start border-0 border-3 border-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6> <a class="stretched-link" href="#">Salaries Received</a></h6>
                                        <h4 class="my-1 text-success">$ {{ auth()->user()->userTotal->total_salaries ?? 0 }}</h4>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-success text-white ms-auto">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card radius-10 border-start border-0 border-3 border-warning">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6> <a class="stretched-link" href="#">Total Refferal Commision</a></h6>
                                        <h4 class="my-1 text-warning">$ {{ auth()->user()->userTotal->total_refferal_commision ?? 0 }}</h4>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-warning text-white ms-auto">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card radius-10 border-start border-0 border-3 border-warning">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6> <a class="stretched-link" href="#">Total  Rewards</a></h6>
                                        <h4 class="my-1 text-success">$ {{ auth()->user()->userTotal->total_rewards ?? 0 }}</h4>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-success text-white ms-auto">
                                        <i class="fas fa-trophy"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card radius-10 border-start border-0 border-3 border-danger">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6> <a class="stretched-link" href="#">Total  Withdraws</a></h6>
                                        <h4 class="my-1 text-danger">$ {{ auth()->user()->userTotal->total_withdraws ?? 0 }}</h4>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-danger text-white ms-auto">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card radius-10 border-start border-0 border-3 border-danger">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6> <a class="stretched-link" href="#">Total  Fee</a></h6>
                                        <h4 class="my-1 text-danger">$ {{ auth()->user()->userTotal->total_fee ?? 0 }}</h4>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-danger text-white ms-auto">
                                        <i class="fas fa-coins"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card radius-10 border-start border-0 border-3 border-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6> <a class="stretched-link" href="#">level_1_investment</a></h6>
                                        <h4 class="my-1 text-primary">$ {{ auth()->user()->userTotal->level_1_investment ?? 0 }}</h4>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-primary text-white ms-auto">
                                        <i class="fas fa-hand-holding-usd"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card radius-10 border-start border-0 border-3 border-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6> <a class="stretched-link" href="#">level_2_investment</a></h6>
                                        <h4 class="my-1 text-success">$ {{ auth()->user()->userTotal->level_2_investment ?? 0 }}</h4>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-success text-white ms-auto">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card radius-10 border-start border-0 border-3 border-warning">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6> <a class="stretched-link" href="#">level_3_investment</a></h6>
                                        <h4 class="my-1 text-warning">$ {{ auth()->user()->userTotal->level_3_investment ?? 0 }}</h4>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-warning text-white ms-auto">
                                        <i class="fas fa-piggy-bank"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card radius-10 border-start border-0 border-3 border-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6> <a class="stretched-link" href="#">level_4_investment</a></h6>
                                        <h4 class="my-1 text-primary">$ {{ auth()->user()->userTotal->level_4_investment ?? 0 }}</h4>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-primary text-white ms-auto">
                                        <i class="fas fa-donate"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card radius-10 border-start border-0 border-3 border-secondary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6> <a class="stretched-link" href="#">level_5_investment</a></h6>
                                        <h4 class="my-1 text-secondary">$ {{ auth()->user()->userTotal->level_5_investment ?? 0 }}</h4>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-secondary text-white ms-auto">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card radius-10 border-start border-0 border-3 border-info">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6> <a class="stretched-link" href="#">level_6_investment</a></h6>
                                        <h4 class="my-1 text-info">$ {{ auth()->user()->userTotal->level_6_investment ?? 0 }}</h4>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-info text-white ms-auto">
                                        <i class="fas fa-landmark"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="card radius-10 border-start border-0 border-3 border-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6> <a class="stretched-link" href="#">level_7_investment</a></h6>
                                        <h4 class="my-1 text-success">$ {{ auth()->user()->userTotal->level_7_investment ?? 0 }}</h4>
                                    </div>
                                    <div class="widgets-icons-2 rounded-circle bg-gradient-success text-white ms-auto">
                                        <i class="fas fa-sack-dollar"></i>
                                    </div>
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
