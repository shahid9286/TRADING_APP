@extends('admin.layouts.master')
@section('title', 'Dashboard')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Welcome back, {{ auth()->user()->username }}!</h1>
                </div>
            </div>
            <div class="row mt-2">

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="fas fa-bullhorn"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text font-weight-bold">Running Announcements</span>
                            <span class="info-box-number">3</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box bg-warning">
                        <span class="info-box-icon"><i class="fas fa-gift"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text font-weight-bold">Running Offers</span>
                            <span class="info-box-number">2</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text font-weight-bold">Total Users</span>
                            <span class="info-box-number">1,250</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box bg-dark">
                        <span class="info-box-icon"><i class="far fa-money-bill-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text font-weight-bold">Cash in Hand</span>
                            <span class="info-box-number">$25,000</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box bg-danger">
                        <span class="info-box-icon"><i class="fas fa-hand-holding-usd"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text font-weight-bold">Monthly Salaries to Give</span>
                            <span class="info-box-number">$18,000</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box bg-secondary">
                        <span class="info-box-icon"><i class="fas fa-question-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text font-weight-bold">Pending Enquiries</span>
                            <span class="info-box-number">15</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>5</h3>
                            <p>Recent Withdrawal Requests</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <a href="#" class="small-box-footer">See All <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>2</h3>
                            <p>Pending Withdrawal Requests</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <a href="#" class="small-box-footer">Review <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>10</h3>
                            <p>Recent Investments</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <a href="#" class="small-box-footer">See All <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h3>4</h3>
                            <p>Pending Investments</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <a href="#" class="small-box-footer">Review <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
