@extends('front.layouts.master')
@section('title', 'Withdraw')

@section('content')

<section class="page-header">
    {{-- Add breadcrumb here if needed --}}
</section>

<section class="contact-section py-5" style="background-color: #071700;">
<div class="container mt-5">
    <div class="row row justify-content-center">
         <!-- Plan 3 -->
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header bg-warning text-dark">Investment Plan</div>
                <div class="card-body">
                    <h6 class="text-danger">Daily Return </h6>
                    <p>Get Daily  <span ><b class="text-warning">{{ $bussiness_rule->daily_return_rate }}</b></span> %   Returns Based on Your Investment</p>
                    <h6 class="text-danger">Mothly Refferral Comission</h6>
                    <p>Get Monthly  <span ><b class="text-warning">{{ $bussiness_rule->daily_return_rate }}</b></span> %  Profit on your direct Refferals</p>
                </div>
                <div class="card-footer">
                    <a href="{{route('front.deposit')}}" class="btn btn-warning btn-block">Invest Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection
