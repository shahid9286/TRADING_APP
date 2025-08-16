@extends('admin.layouts.master')

@section('title', 'Edit User Bank')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Edit User Bank') }}</h3>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.user-banks.update', $user_bank->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="user_id">{{ __('User') }} <span class="text-danger">*</span></label>
                                        <select name="user_id" id="user_id" class="form-control" required>
                                            <option value="">{{ __('-- Select User --') }}</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ old('user_id', $user_bank->user_id) == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('user_id'))
                                            <p class="text-danger">{{ $errors->first('user_id') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="bank_name">{{ __('Bank Name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="bank_name" id="bank_name" placeholder="Enter Bank Name"
                                            class="form-control" value="{{ old('bank_name', $user_bank->bank_name) }}"
                                            required>
                                        @if ($errors->has('bank_name'))
                                            <p class="text-danger">{{ $errors->first('bank_name') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="account_no">{{ __('Account No') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="account_no" id="account_no"
                                            placeholder="Enter Account No" class="form-control"
                                            value="{{ old('account_no', $user_bank->account_no) }}" required>
                                        @if ($errors->has('account_no'))
                                            <p class="text-danger">{{ $errors->first('account_no') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <button type="submit"
                                    class="btn btn-primary float-right">{{ __('Update User Bank') }}</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
