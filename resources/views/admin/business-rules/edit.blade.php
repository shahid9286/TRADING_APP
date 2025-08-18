@extends('admin.layouts.master')
@section('title', 'Business Rules')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Business Rules') }} </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                    class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">{{ __('Business Rules') }}</li>
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
                            <h1 class="card-title mt-1">{{ __(' Edit Business Rule') }}</h1>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.business.rules.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                {{-- Min Deposit --}}
                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label for="min_deposit">Minimum Deposit <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" name="min_deposit" id="min_deposit"
                                            value="{{ old('min_deposit', $business_rules->min_deposit) }}"
                                            class="form-control @error('min_deposit') is-invalid @enderror">
                                        @error('min_deposit')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Min Withdraw Limit --}}
                                    <div class="col-md-6 mb-3">
                                        <label for="min_withdraw_limit">Minimum Withdraw Limit <span
                                                class="text-danger">*</span></label>
                                        <input type="number" step="0.01" name="min_withdraw_limit"
                                            id="min_withdraw_limit"
                                            value="{{ old('min_withdraw_limit', $business_rules->min_withdraw_limit) }}"
                                            class="form-control @error('min_withdraw_limit') is-invalid @enderror">
                                        @error('min_withdraw_limit')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Return Rates --}}
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="daily_return_rate">Daily Return Rate (%) <span
                                                class="text-danger">*</span></label>
                                        <input type="number" step="0.01" name="daily_return_rate" id="daily_return_rate"
                                            value="{{ old('daily_return_rate', $business_rules->daily_return_rate) }}"
                                            class="form-control @error('daily_return_rate') is-invalid @enderror">
                                        @error('daily_return_rate')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="monthly_return_rate">Monthly Return Rate (%) <span
                                                class="text-danger">*</span></label>
                                        <input type="number" step="0.01" name="monthly_return_rate"
                                            id="monthly_return_rate"
                                            value="{{ old('monthly_return_rate', $business_rules->monthly_return_rate) }}"
                                            class="form-control @error('monthly_return_rate') is-invalid @enderror">
                                        @error('monthly_return_rate')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Commission Rates --}}
                                <h5 class="mt-4 fw-4">Commission Rates (%)</h5>
                                <div class="row">
                                    @for ($i = 1; $i <= 7; $i++)
                                        <div class="col-md-3 mb-3">
                                            <label for="level_{{ $i }}_comm_rate">Level {{ $i }}
                                                <span class="text-danger">*</span></label>
                                            <input type="number" step="0.01" name="level_{{ $i }}_comm_rate"
                                                id="level_{{ $i }}_comm_rate"
                                                value="{{ old('level_' . $i . '_comm_rate', $business_rules->{'level_' . $i . '_comm_rate'}) }}"
                                                class="form-control @error('level_' . $i . '_comm_rate') is-invalid @enderror">
                                            @error('level_' . $i . '_comm_rate')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    @endfor
                                </div>

                                {{-- Dates --}}
                                <h5 class="mt-4">Important Dates</h5>
                                <div class="row">
<div class="col-md-4 mb-3">
    <label for="salary_day">Salary Day <span class="text-danger">*</span></label>
    <select name="salary_day" id="salary_day"
        class="form-control @error('salary_day') is-invalid @enderror">
        <option value="">-- Select Day --</option>
        @for ($d = 1; $d <= 31; $d++)
            <option value="{{ $d }}" {{ old('salary_day', $business_rules->salary_day) == $d ? 'selected' : '' }}>
                {{ $d }}
            </option>
        @endfor
    </select>
    @error('salary_day')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
                                    <div class="col-md-4 mb-3">
                                        <label for="salary_payout_date">Salary Payout Date</label>
                                        <input type="date" name="salary_payout_date" id="salary_payout_date"
                                            value="{{ old('salary_payout_date', $business_rules->salary_payout_date) }}"
                                            class="form-control @error('salary_payout_date') is-invalid @enderror">
                                        @error('salary_payout_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="entry_approval_date">Entry Approval Date</label>
                                        <input type="date" name="entry_approval_date" id="entry_approval_date"
                                            value="{{ old('entry_approval_date', $business_rules->entry_approval_date) }}"
                                            class="form-control @error('entry_approval_date') is-invalid @enderror">
                                        @error('entry_approval_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="withdraw_last_date">Withdraw Last Date</label>
                                        <input type="date" name="withdraw_last_date" id="withdraw_last_date"
                                            value="{{ old('withdraw_last_date', $business_rules->withdraw_last_date) }}"
                                            class="form-control @error('withdraw_last_date') is-invalid @enderror">
                                        @error('withdraw_last_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="withdraw_payout_date">Withdraw Payout Date</label>
                                        <input type="date" name="withdraw_payout_date" id="withdraw_payout_date"
                                            value="{{ old('withdraw_payout_date', $business_rules->withdraw_payout_date) }}"
                                            class="form-control @error('withdraw_payout_date') is-invalid @enderror">
                                        @error('withdraw_payout_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="withdraw_payout_date_2">Withdraw Payout Date 2</label>
                                        <input type="date" name="withdraw_payout_date_2" id="withdraw_payout_date_2"
                                            value="{{ old('withdraw_payout_date_2', $business_rules->withdraw_payout_date_2) }}"
                                            class="form-control @error('withdraw_payout_date_2') is-invalid @enderror">
                                        @error('withdraw_payout_date_2')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
