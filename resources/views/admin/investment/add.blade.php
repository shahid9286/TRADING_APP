@extends('admin.layouts.master')
@section('title', 'Add Investment')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-hand-holding-usd"></i> {{ __('Add Investment') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-home"></i> {{ __('Home') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item">{{ __('Investments') }}</li>
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
                        <form class="form-horizontal" action="{{ route('admin.investment.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                {{-- User --}}
                                <div class="col-6 mb-3">
                                    <label for="user_id">{{ __('User') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <select id="user_id" name="user_id" class="form-control form-control-sm" required>
                                            <option value="" disabled selected>{{ __('Select User') }}</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->username }} ({{ $user->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('user_id') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- Referral ID --}}
                                <div class="col-6 mb-3">
                                    <label for="referral_id">{{ __('Referral ID') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                                        </div>
                                        <select id="referral_id" name="referral_id" class="form-control form-control-sm">
                                            <option value="">{{ __('Select Referral (Optional)') }}</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ old('referral_id') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->username }} ({{ $user->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('referral_id') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- Amount --}}
                                <div class="col-6 mb-3">
                                    <label for="amount">{{ __('Amount') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input type="number" step="0.01" id="amount" class="form-control form-control-sm" name="amount" value="{{ old('amount') }}" placeholder="{{ __('Enter Amount') }}" required>
                                    </div>
                                    @error('amount') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- Start Date --}}
                                <div class="col-6 mb-3">
                                    <label for="s_date">{{ __('Start Date') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="datetime-local" id="s_date" name="s_date" class="form-control form-control-sm" value="{{ old('start_date') }}" required>
                                    </div>
                                    @error('start_date') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- Expiry Date --}}
                                <div class="col-6 mb-3">
                                    <label for="expiry_date">{{ __('Expiry Date') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-times"></i></span>
                                        </div>
                                        <input type="datetime-local" id="expiry_date" name="expiry_date" class="form-control form-control-sm" value="{{ old('expiry_date') }}" required>
                                    </div>
                                    @error('expiry_date') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- Transaction ID --}}
                                <div class="col-6 mb-3">
                                    <label for="transaction_id">{{ __('Transaction ID') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-receipt"></i></span>
                                        </div>
                                        <input type="text" id="transaction_id" class="form-control form-control-sm" name="transaction_id" value="{{ old('transaction_id') }}" placeholder="{{ __('Enter Transaction ID') }}" required>
                                    </div>
                                    @error('transaction_id') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- Screenshot --}}
                            {{-- Image --}}
                                    <div class="col-6 mb-3">
                                        <label for="screenshot">
                                            {{ __('Screenshot') }}
                                        </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    </div>
                                            <input type="file" class="form-control form-control-sm form-control form-control-sm-sm up-img" name="screenshot"
                                                id="screenshot">
                                        </div>
                                        <img class="mw-400 mt-1 show-img img-demo"
                                            src="{{ asset('assets/uploads/core/img-demo.jpg') }}" alt=""
                                            width="50px">
                                        @if ($errors->has('screenshot'))
                                            <p class="text-danger">{{ $errors->first('screenshot') }}</p>
                                        @endif
                                    </div>


                                {{-- Status --}}
                                <div class="col-6 mb-3">
                                    <label for="status">{{ __('Status') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                                        </div>
                                        <select id="status" name="status" class="form-control form-control-sm" required>
                                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </div>
                                    @error('status') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- Active Status --}}
                                <div class="col-6 mb-3">
                                    <label for="is_active">{{ __('Active Status') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                        </div>
                                        <select id="is_active" name="is_active" class="form-control form-control-sm" required>
                                            <option value="active" {{ old('is_active') == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="expired" {{ old('is_active') == 'expired' ? 'selected' : '' }}>Expired</option>
                                        </select>
                                    </div>
                                    @error('is_active') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- Admin Bank Account --}}
                                <div class="col-6 mb-3">
                                    <label for="admin_bank_id">{{ __('Admin Bank Account') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-university"></i></span>
                                        </div>
                                        <select id="admin_bank_id" name="admin_bank_id" class="form-control form-control-sm" required>
                                            <option value="" disabled selected>{{ __('Select Bank') }}</option>
                                            @foreach($bankAccounts as $bank)
                                                <option value="{{ $bank->id }}" {{ old('admin_bank_id') == $bank->id ? 'selected' : '' }}>
                                                    {{ $bank->bank_name }} - {{ $bank->account_number }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('admin_bank_id') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- Submit --}}
                                <div class="form-group col-3">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-paper-plane"></i> {{ __('Add Investment') }}
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div> <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
