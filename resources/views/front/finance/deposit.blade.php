@extends('front.layouts.master')
@section('title', 'User Login')
@section('content')
    <section class="account padding-top padding-bottom sec-bg-color2">
        <div class="container">
            <div class="account__wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="account__content account__content--style1">

                            <!-- Laravel Login Form -->
                            <form method="post" action="{{ route('front.deposit.manual') }}"
                                class="account__form needs-validation" novalidate>
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label text-white" for="method_code">
                                        Method <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control @error('method_code') is-invalid @enderror"
                                        name="method_code" id="method_code" disabled>
                                        <option selected>USDT</option>
                                    </select>
                                    @error('method_code')
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
                                            class="form-control @error('amount') is-invalid @enderror" required>
                                        <span class="input-group-text bg-success text-white">USD</span>
                                        @error('amount')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
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
