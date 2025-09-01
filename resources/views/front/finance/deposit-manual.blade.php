@extends('front.layouts.master')
@section('title', 'User Login')
@section('content')
    <section class="account padding-bottom sec-bg-color2">
        <div class="container">
            <div class="account__wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="account__content account__content--style1">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h3 class="text-info"><i class="fas fa-wallet"></i> USDT Payment</h3>
                                    <h6>You have requested <b class="text-danger">{{ $amount ?? '1.00' }} USD</b> </h6>
                                    <h5>Please pay <b class="text-danger">{{ $amount ?? '1.00' }} USDT</b> for successful payment</h5>
                                </div>
                                <div class="col-12">
                                    <p class="p-0 m-0">You can Deposite on the given :  <span class="text-danger"> Trc20 Address</span></p>
                                    <p class="p-0 m-2 d-flex align-items-center">
                                        <b id="accountNo" class="text-warning">
                                            {{ $admin_bank->account_no ?? "No Addresses available, can't deposite at this time. Try again later." }}
                                        </b>

                                        @if (!empty($admin_bank->account_no))
                                            <button class="btn btn-sm btn-light ms-2" onclick="copyAccountNo()"
                                                title="Copy">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        @endif
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
                                    <span class="text-light">Supported mimes: jpg,jpeg,png | Max size: 1MB</span>
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
        function copyAccountNo() {
            const accountNo = document.getElementById("accountNo").innerText;

            navigator.clipboard.writeText(accountNo).then(() => {
                var notyf = new Notyf({
                    duration: 2000,
                    position: {
                        x: 'right',
                        y: 'top'
                    }
                });
                notyf.success("Account number copied!");
            }).catch(err => {
                alert("Failed to copy: " + err);
            });
        }
    </script>
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
