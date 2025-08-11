@extends('admin.layouts.master')

@section('title', 'Add New User Bank')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Add New User Bank') }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.user0banks.index') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.user-banks.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="name">{{ __('Bank Name') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="bank_name" id="bank_name" class="form-control"
                                        value="{{ old('bank_name') }}" required>
                                    @error('bank_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="account_no">{{ __('Account No') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="account_no" id="account_no" class="form-control"
                                        value="{{ old('account_no') }}" required>
                                    @error('account_no')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">{{ __('Add User Bank') }}</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
