@extends('admin.layouts.master')
@section('title', 'Add Investment')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-gift"></i> {{ __('Add Investment') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-home"></i> {{ __('Home') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item">{{ __('Investment') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">{{ __('Add Investment') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.investment.index') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.investment.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                {{-- Amount --}}
                                <div class="col-6 mb-3">
                                    <label for="amount">{{ __('Amount') }} <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" id="amount" class="form-control form-control-sm" name="amount" value="{{ old('amount') }}" required>
                                    @error('amount') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- Status --}}
                                <div class="col-6 mb-3">
                                    <label for="status">{{ __('Status') }} <span class="text-danger">*</span></label>
                                    <select id="status" name="status" class="form-control form-control-sm" required>
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    @error('status') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- Transaction ID --}}
                                <div class="col-6 mb-3">
                                    <label for="transaction_id">{{ __('Transaction ID') }}</label>
                                    <input type="text" id="transaction_id" class="form-control form-control-sm" name="transaction_id" value="{{ old('transaction_id') }}">
                                    @error('transaction_id') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- Screenshot --}}
                                <div class="col-6 mb-3">
                                    <label for="screenshot">{{ __('Screenshot') }}</label>
                                    <input type="file" id="screenshot" name="screenshot" class="form-control form-control-sm">
                                    <img src="{{ asset('assets/uploads/core/img-demo.jpg') }}" alt="" width="50">
                                    @error('screenshot') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- Is Active --}}
                                <div class="col-6 mb-3">
                                    <label for="is_active">{{ __('Is Active') }} <span class="text-danger">*</span></label>
                                    <select id="is_active" name="is_active" class="form-control form-control-sm" required>
                                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>True</option>
                                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>False</option>
                                    </select>
                                    @error('is_active') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- Investor --}}
                                <div class="col-6 mb-3">
                                    <label for="user_id">{{ __('Investor') }}</label>
                                    <select name="user_id" id="user_id" class="form-control form-control-sm" required>
                                        <option value="">Select Investor</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->username }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- Referral --}}
                                <div class="col-6 mb-3">
                                    <label for="referral_id">{{ __('Referred By') }}</label>
                                    <select name="referral_id" id="referral_id" class="form-control form-control-sm">
                                        <option value="">None</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('referral_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->username }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('referral_id') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- Submit --}}
                                <div class="col-3">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-paper-plane"></i> {{ __('Add Investment') }}
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
