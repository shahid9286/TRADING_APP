@extends('front.layouts.master')
@section('title', 'Withdraw')

@section('content')


    <section class="account padding-top pb-3 sec-bg-color2">
        <div class="container">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color: #00150F;">
                        <form action="{{ route('front.user-bank.store') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Bank</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <input type="text" name="bank_name" class="form-control form-control-sm mb-2"
                                            placeholder="Enter Bank Name*" required>
                                        <input type="text" name="account_no" class="form-control form-control-sm"
                                            placeholder="Enter Account No*" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="trk-btn trk-btn--border text-white"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="trk-btn trk-btn--border trk-btn--primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="account__wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="account__content account__content--style1">

                            <!-- Laravel Login Form -->
                            <form id="withdrawform" method="POST" action="{{ route('front.withdraw.request.store') }}"
                                novalidate>
                                @csrf

                                {{-- Method --}}
                                <div class="mb-3">
                                    <label class="form-label text-white" for="bank_account">
                                        Method <span class="text-danger">*</span> <span class="text-muted fs-6">(No Bank
                                            Account Found! <a href="#" class="text-white text-decoration-underline"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">Add First</a>)</span>
                                    </label>
                                    <select class="form-control @error('bank_account') is-invalid @enderror"
                                        name="bank_account" id="bank_account" required>
                                        <option selected disabled>Select Bank*</option>
                                        @foreach ($user_banks as $user_bank)
                                            <option value="{{ $user_bank->id }}">
                                                ({{ $user_bank->bank_name }})
                                                {{ $user_bank->account_no }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('bank_account')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Amount --}}
                                <div class="mb-3">
                                    <label class="form-label text-white" for="amount">
                                        Amount <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="number" step="any" name="amount" id="amount"
                                            value="{{ old('amount') }}"
                                            max="{{ auth()->user()->net_balance - auth()->user()->locked_amount }}"
                                            class="form-control @error('amount') is-invalid @enderror"
                                            placeholder="Enter Amount*" required>
                                        <span class="input-group-text bg-success text-white">USD</span>
                                        @error('amount')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <p class="p-0 m-0">Available Balance: <b>${{ auth()->user()->net_balance }}</b></p>
                                    <p class="p-0 m-0">Locked Amount: <b>${{ auth()->user()->locked_amount }}</b></p>
                                    <p class="p-0 m-0">Available Amount:
                                        <b>${{ auth()->user()->net_balance - auth()->user()->locked_amount }}</b></p>
                                </div>

                                {{-- Submit --}}
                                <button type="submit" class="trk-btn trk-btn--border trk-btn--primary mt-3 d-block">
                                    Submit
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
