@extends('front.layouts.master')
@section('title', 'Withdraw')

@section('content')

<section class="page-header">
    {{-- Add breadcrumb here if needed --}}
</section>

<section class="contact-section py-5" style="background-color: #071700;">
<div class="container mt-5">
    <div class="row">
        <!-- Plan 1 -->
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-header bg-primary text-white">Annual Money Back Plan</div>
                <div class="card-body">
                    <h3 class="text-primary">$10</h3>
                    <p>Minimum Investment</p>
                    <h3 class="text-primary">$100</h3>
                    <p>Maximum Investment</p>
                    <p><strong>3%</strong> Daily for 365 days</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-block">Invest Now</button>
                </div>
            </div>
        </div>

        <!-- Plan 2 -->
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-header bg-success text-white">Annual Super Plan</div>
                <div class="card-body">
                    <h3 class="text-success">$100</h3>
                    <p>Minimum Investment</p>
                    <h3 class="text-success">$500</h3>
                    <p>Maximum Investment</p>
                    <p><strong>5%</strong> Daily for 365 days</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success btn-block">Invest Now</button>
                </div>
            </div>
        </div>

        <!-- Plan 3 -->
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-header bg-warning text-dark">Starter</div>
                <div class="card-body">
                    <h3 class="text-warning">$50</h3>
                    <p>Minimum Investment</p>
                    <h3 class="text-warning">$200</h3>
                    <p>Maximum Investment</p>
                    <p><strong>2%</strong> Daily for 30 days</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-warning btn-block">Invest Now</button>
                </div>
            </div>
        </div>

        <!-- Plan 4 -->
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-header bg-danger text-white">Premium</div>
                <div class="card-body">
                    <h3 class="text-danger">$200</h3>
                    <p>Minimum Investment</p>
                    <h3 class="text-danger">$1000</h3>
                    <p>Maximum Investment</p>
                    <p><strong>4%</strong> Daily for 60 days</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-danger btn-block">Invest Now</button>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection
