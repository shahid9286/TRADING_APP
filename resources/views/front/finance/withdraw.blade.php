@extends('front.layouts.master')
@section('title', 'Withdraw')

@section('content')

<section class="page-header">
    {{-- Add breadcrumb here if needed --}}
</section>

<section class="contact-section py-5" style="background-color: #071700;">
    <div class="container">
        <div class="row gy-4"><!-- Reduced gap here -->

            <!-- Withdraw History Button -->
            <div class="col-lg-6 offset-lg-3 mb-1"> 
                <div class="text-end">
                    <a href="{{ route('front.withdraw.history') }}" 
                       class="trk-btn trk-btn--border trk-btn--primary py-4 px-3"
                       style="font-size: 14px;">
                        Withdraw History
                    </a>
                </div>
            </div>

            <!-- Withdraw Form -->
            <div class="col-md-8 col-lg-6 offset-lg-3 p-4 rounded" style="background-color: #283D1F;">
                <h4 class="text-white text-center mb-4">Withdraw Funds</h4>

                <form id="withdrawform" method="POST" action="{{ route('front.withdraw.store') }}" novalidate>
                    @csrf

                    {{-- Method --}}
                    <div class="mb-3">
                        <label class="form-label text-white" for="method_code">
                            Method <span class="text-danger">*</span>
                        </label>
                        <select class="form-control @error('method_code') is-invalid @enderror"
                                name="method_code" id="method_code" required>
                            <option value="">Select Gateway</option>
                            <option value="1" {{ old('method_code') == 1 ? 'selected' : '' }}>USDT TRC20</option>
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
                    <button type="submit" 
                            class="trk-btn trk-btn--border trk-btn--primary mt-3 d-block">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
