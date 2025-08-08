@extends('branchManager.layouts.master')
@section('title', 'Dashboard')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Welcome back,') }} {{ auth()->user()->name }} !</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                
            </div>
        </div>
    </div>
@endsection
