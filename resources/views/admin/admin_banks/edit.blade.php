@extends('admin.layouts.master')

@section('title', 'Edit Admin Bank')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Edit Admin Bank') }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.admin_banks.index') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.admin_banks.update', $bank->id) }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label for="name">{{ __('Bank Name') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" placeholder="Enter Bank Name"
                                        class="form-control" value="{{ old('name', $bank->name) }}" required>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="account_no">{{ __('Account No') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="account_no" id="account_no" placeholder="Enter Account No"
                                        class="form-control" value="{{ old('account_no', $bank->account_no) }}" required>
                                    @error('account_no')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">{{ __('Status') }} <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="">{{ __('-- Select Status --') }}</option>
                                        <option value="active"
                                            {{ old('status', $bank->status) == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive"
                                            {{ old('status', $bank->status) == 'inactive' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="order_no">{{ __('Order No') }} <span class="text-danger">*</span></label>
                                    <input type="number" name="order_no" id="order_no" placeholder="Enter Order No"
                                        class="form-control" value="{{ old('order_no', $bank->order_no) }}" min="0"
                                        required>
                                    @error('order_no')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="notes">{{ __('Notes') }}</label>
                                    <textarea name="notes" id="notes" placeholder="Enter Notes" class="form-control">{{ old('notes', $bank->notes) }}</textarea>
                                    @error('notes')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">{{ __('Update Admin Bank') }}</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
