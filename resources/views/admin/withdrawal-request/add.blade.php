@extends('admin.layouts.master')
@section('title', 'Add Withdrawal Request')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <form class="form-horizontal" action="{{ route('admin.withdrawal-request.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline mt-2">
                            <div class="card-header">
                                <h3 class="card-title mt-1"> <b> {{ __('Add Withdrawal Request') }} </b> </h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body py-3">

                                <div class="row">


                                    <!-- User Id -->
                                    <div class="col-md-4 mt-2">
                                        <label for="user_id">User <span class="text-danger">*</span></label>
                                        <select id="user_id" name="user_id" class="form-control form-control-sm" required>
                                            <option value="">-- Select User --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('user_id'))
                                            <span class="text-danger">{{ $errors->first('user_id') }}</span>
                                        @endif
                                    </div>

                                    {{-- Admin Bank --}}
                                    <div class="col-md-4 mt-2">
                                        <label for="admin_bank_id">Admin Bank</label>
                                        <select id="admin_bank_id" name="admin_bank_id"
                                            class="form-control form-control-sm">
                                            <option value="">-- Select Admin Bank --</option>
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('admin_bank_id'))
                                            <span class="text-danger">{{ $errors->first('admin_bank_id') }}</span>
                                        @endif
                                    </div>

                                    {{-- User Bank --}}
                                    <div class="col-md-4 mt-2">
                                        <label for="user_bank_id">User Bank</label>
                                        <select id="user_bank_id" name="user_bank_id" class="form-control form-control-sm">
                                            <option value="">-- Select User Bank --</option>
                                            @foreach ($user_banks as $user_bank)
                                                <option value="{{ $user_bank->id }}">{{ $user_bank->bank_name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('user_bank_id'))
                                            <span class="text-danger">{{ $errors->first('user_bank_id') }}</span>
                                        @endif
                                    </div>


                                    <!-- Request Date -->
                                    <div class="col-md-4 mt-2">
                                        <label for="request_date">{{ __('Request Date') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="date" id="request_date" name="request_date"
                                            class="form-control form-control-sm"
                                            placeholder="{{ __('Enter Request Date') }}" value="{{ old('request_date') }}"
                                            required>
                                        @if ($errors->has('request_date'))
                                            <p class="text-danger">{{ $errors->first('request_date') }}</p>
                                        @endif
                                    </div>

                                    {{-- Requested Amount --}}
                                    <div class="col-md-4 mt-2">
                                        <label for="requested_amount">{{ __('Requested Amount') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="number" id="requested_amount" name="requested_amount"
                                            class="form-control form-control-sm"
                                            placeholder="{{ __('Enter Requested Amount') }}"
                                            value="{{ old('requested_amount') }}" step="0.01" min="0" required>
                                        @if ($errors->has('requested_amount'))
                                            <p class="text-danger">{{ $errors->first('requested_amount') }}</p>
                                        @endif
                                    </div>



                                    {{-- Approval Date --}}
                                    <div class="col-md-4 mt-2">
                                        <label for="approval_date">{{ __('Approval Date') }}</label>
                                        <input type="date" id="approval_date" name="approval_date"
                                            class="form-control form-control-sm"
                                            placeholder="{{ __('Select Approval Date') }}"
                                            value="{{ old('approval_date') }}">
                                        @if ($errors->has('approval_date'))
                                            <p class="text-danger">{{ $errors->first('approval_date') }}</p>
                                        @endif
                                    </div>

                                    {{-- Payout Date --}}
                                    <div class="col-md-4 mt-2">
                                        <label for="payout_date">{{ __('Payout Date') }}</label>
                                        <input type="date" id="payout_date" name="payout_date"
                                            class="form-control form-control-sm"
                                            placeholder="{{ __('Select Payout Date') }}" value="{{ old('payout_date') }}">
                                        @if ($errors->has('payout_date'))
                                            <p class="text-danger">{{ $errors->first('payout_date') }}</p>
                                        @endif
                                    </div>

                                    {{-- Payout Amount --}}
                                    <div class="col-md-4 mt-2">
                                        <label for="payout_amount">{{ __('Payout Amount') }}</label>
                                        <input type="number" id="payout_amount" name="payout_amount"
                                            class="form-control form-control-sm"
                                            placeholder="{{ __('Enter Payout Amount') }}"
                                            value="{{ old('payout_amount') }}">
                                        @if ($errors->has('payout_amount'))
                                            <p class="text-danger">{{ $errors->first('payout_amount') }}</p>
                                        @endif
                                    </div>

                                    {{-- Total Payout --}}
                                    <div class="col-md-4 mt-2">
                                        <label for="total_payout">{{ __('Total Payout') }}</label>
                                        <input type="number" id="total_payout" name="total_payout"
                                            class="form-control form-control-sm"
                                            placeholder="{{ __('Enter Total Payout') }}"
                                            value="{{ old('total_payout') }}">
                                        @if ($errors->has('total_payout'))
                                            <p class="text-danger">{{ $errors->first('total_payout') }}</p>
                                        @endif
                                    </div>


                                    {{-- Fee --}}
                                    <div class="col-md-4 mt-2">
                                        <label for="fee">{{ __('Fee') }}</label>
                                        <input type="number" id="fee" name="fee"
                                            class="form-control form-control-sm" placeholder="{{ __('Enter Fee') }}"
                                            value="{{ old('fee') }}">
                                        @if ($errors->has('fee'))
                                            <p class="text-danger">{{ $errors->first('fee') }}</p>
                                        @endif
                                    </div>

                                    {{-- Transaction ID --}}
                                    <div class="col-md-4 mt-2">
                                        <label for="transaction_id">{{ __('Transaction ID') }}</label>
                                        <input type="text" id="transaction_id" name="transaction_id"
                                            class="form-control form-control-sm"
                                            placeholder="{{ __('Enter Transaction ID') }}"
                                            value="{{ old('transaction_id') }}">
                                        @if ($errors->has('transaction_id'))
                                            <p class="text-danger">{{ $errors->first('transaction_id') }}</p>
                                        @endif
                                    </div>

                                    {{-- Screenshot --}}
                                    <div class="col-md-4 mt-2">
                                        <label for="screenshot">{{ __('Screenshot') }}</label>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label class="custom-file-label"
                                                    for="screenshot">{{ __('Choose New Screenshot') }}</label>
                                                <input type="file" class="custom-file-input up-img form-control"
                                                    name="screenshot" id="screenshot">
                                                <img class="mw-400 mb-3 show-img img-demo mt-2"
                                                    src="{{ asset('assets/admin/img/img-demo.jpg') }}" alt="">
                                                @error('screenshot')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    {{-- Status --}}
                                    <div class="col-md-6 mt-2">
                                        <label for="status">{{ __('Status') }} <span
                                                class="text-danger">*</span></label>
                                        <select id="status" name="status" class="form-control form-control-sm"
                                            required>
                                            <option value="">{{ __('Select Status') }}</option>
                                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>
                                                Approved</option>
                                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>
                                                Rejected</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <p class="text-danger">{{ $errors->first('status') }}</p>
                                        @endif
                                    </div>

                                    <!-- Client Status -->
                                    <div class=" col-md-6 mt-2">
                                        <label for="status">{{ __('Client Status') }} <span
                                                class="text-danger">*</span></label>
                                        <select id="client_status" name="client_status"
                                            class="form-control form-control-sm" required>
                                            <option value="">{{ __('Select Client Status') }}</option>
                                            <option value="pending"
                                                {{ old('client_status') == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="verified"
                                                {{ old('client_status') == 'verified' ? 'selected' : '' }}>
                                                Verified</option>
                                        </select>
                                        @if ($errors->has('client_status'))
                                            <p class="text-danger">{{ $errors->first('client_status') }}</p>
                                        @endif
                                    </div>

                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                    <div class=" col-12">
                        <button type="submit"
                            class="btn btn-sm mb-1 btn-primary float-right">{{ __('Add Withdrawal Request') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row -->

    </section>
@endsection
