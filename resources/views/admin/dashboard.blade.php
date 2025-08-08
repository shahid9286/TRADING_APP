@extends('admin.layouts.master')
@section('title', 'Dashboard')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Welcome back,') }} {{ auth()->user()->name }}!</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <h3 class="m-0 text-dark" id="current-month-display"></h3>
                </div>
            </div>
        </div>
    </div>
    
@endsection
