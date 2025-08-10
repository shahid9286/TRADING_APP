@extends('admin.layouts.master')
@section('title', 'Add User Return')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-plus-circle"></i> {{ __('Add User Return') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> {{ __('Home') }}</a></li>
                    <li class="breadcrumb-item">{{ __('User Returns') }}</li>
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
                        <h3 class="card-title mt-1">{{ __('Add User Return') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.user_returns.index') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.user_returns.store') }}" method="POST" class="form-horizontal">
                            @csrf
                            <div class="row">

                                {{-- Investment --}}
                                <div class="col-6 mb-3">
                                    <label for="investment_id">{{ __('Investment') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-chart-line"></i></span>
                                        </div>
                                        <select id="investment_id" name="investment_id" class="form-control form-control-sm" required>
                                            <option value="">{{ __('Select Investment') }}</option>
                                            @foreach($investments as $inv)
                                                <option value="{{ $inv->id }}"
                                                    data-date="{{ \Carbon\Carbon::parse($inv->start_date)->toDateString() }}"
                                                    {{ old('investment_id') == $inv->id ? 'selected' : '' }}>
                                                    {{ __('Investment') }} #{{ $inv->id }} — {{ $inv->user->username ?? $inv->user->name ?? 'User '.$inv->user_id }} — {{ number_format($inv->amount,2) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('investment_id') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- User --}}
                                <div class="col-6 mb-3">
                                    <label for="user_id">{{ __('User') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <select id="user_id" name="user_id" class="form-control form-control-sm" required>
                                            <option value="">{{ __('Select User') }}</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->username ?? $user->name ?? $user->email }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('user_id') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- Amount --}}
                                <div class="col-4 mb-3">
                                    <label for="amount">{{ __('Amount') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-dollar-sign"></i></span></div>
                                        <input id="amount" type="number" step="0.01" name="amount" class="form-control form-control-sm" value="{{ old('amount') }}" placeholder="{{ __('Enter Amount') }}" required>
                                    </div>
                                    @error('amount') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- Entry Date (readonly, from investment) --}}
                                <div class="col-4 mb-3">
                                    <label for="e_date">{{ __('Entry Date') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>
                                        <input id="e_date" type="date" name="entry_date" class="form-control form-control-sm" value="{{ old('entry_date') }}" readonly>
                                    </div>
                                    @error('entry_date') <p class="text-danger">{{ $message }}</p> @enderror
                                    <small class="text-muted">{{ __('Auto-filled from selected investment and read-only') }}</small>
                                </div>

                                {{-- Type --}}
                                <div class="col-4 mb-3">
                                    <label for="type">{{ __('Type') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-list"></i></span></div>
                                        <select id="type" name="type" class="form-control form-control-sm" required>
                                            <option value="">{{ __('Select Type') }}</option>
                                            <option value="daily-return" {{ old('type') == 'daily-return' ? 'selected' : '' }}>{{ __('Daily Return') }}</option>
                                            <option value="monthly-commission" {{ old('type') == 'monthly-commission' ? 'selected' : '' }}>{{ __('Monthly Commission') }}</option>
                                            <option value="referral-commission" {{ old('type') == 'referral-commission' ? 'selected' : '' }}>{{ __('Referral Commission') }}</option>
                                            <option value="rewards" {{ old('type') == 'rewards' ? 'selected' : '' }}>{{ __('Rewards') }}</option>
                                            <option value="admin-fee" {{ old('type') == 'admin-fee' ? 'selected' : '' }}>{{ __('Admin Fee') }}</option>
                                        </select>
                                    </div>
                                    @error('type') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                                {{-- Submit --}}
                                <div class="form-group col-3">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-paper-plane"></i> {{ __('Add Return') }}
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
