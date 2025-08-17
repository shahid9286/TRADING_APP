@extends('front.layouts.master')
@section('title', 'User Login')
@section('content')
    <section class="account padding-top padding-bottom sec-bg-color2">
        <div class="container">
            <div class="account__wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="account__content account__content--style1">

                            <div class="row">
                                <div class="col-12 text-center">
                                    <h3><i class="fas fa-wallet"></i> USDT Payment</h3>
                                    <h6>You have requested <b>{{ $amount ?? '1.00' }} USD</b>, Please pay
                                        <b>{{ $amount ?? '1.00' }} USDT</b> USDT for successful payment
                                    </h6>
                                </div>
                                <div class="col-12">
                                    <p class="p-0 m-0">You can Deposite on the given Addresses:</p>
                                    <p class="p-0 m-0">
                                        <b>{{ $admin_bank->account_no ?? "No Addresses available, can't deposite at this time. Try again later." }}</b>
                                    </p>
                                </div>
                            </div>
                            <!-- Laravel Login Form -->
                            <form id="depositForm" action="{{ route('front.deposit.store') }}" method="POST"
                                class="account__form needs-validation mt-2" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label text-white" for="transaction_id">
                                        Transaction ID <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" step="any" name="transaction_id" id="transaction_id"
                                        value="{{ old('transaction_id') }}" class="form-control">
                                </div>

                                <input type="hidden" name="amount" value="{{ $amount ?? '1' }}">
                                <input type="hidden" name="admin_bank_id" value="{{ $admin_bank->id ?? '' }}">

                                {{-- Amount --}}
                                <div class="mb-3">
                                    <label class="form-label text-white" for="screenshot">
                                        Screenshot <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" step="any" name="screenshot" id="screenshot"
                                        value="{{ old('screenshot') }}" class="form-control">
                                    <span class="text-muted">Supported mimes: jpg,jpeg,png | Max size: 1MB</span>
                                </div>

                                {{-- Submit --}}
                                <button type="submit" class="trk-btn trk-btn--border trk-btn--primary mt-3 d-block">
                                    Pay Now
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#depositForm').on('submit', function(e) {
                e.preventDefault();

                let form = this;
                let formData = new FormData(form);

                $.ajax({
                    url: "{{ route('front.deposit.store.validate') }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        form.removeEventListener('submit', arguments.callee);
                        form.submit();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            let messages = [];
                            for (let field in errors) {
                                messages.push(errors[field][0]);
                            }

                            alert("Validation Failed:\n\n" + messages.join("\n"));
                        }
                    }
                });
            });
        });
    </script>
@endsection
