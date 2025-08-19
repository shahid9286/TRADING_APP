@extends('front.layouts.master')
@section('title', 'Withdraw')

@section('content')

    <section class="page-header">
        {{-- Add breadcrumb here if needed --}}
    </section>

    <section class="contact-section py-5" style="background-color: #071700;">
        <!-- Filter Bar -->
        <!-- Filter Bar -->
        <div class="container my-4">
            <form method="GET" action="{{ route('front.withdraw.request.history') }}" class="p-3 rounded"
                style="border: 1px solid #ccc;">
                <div class="row g-3 align-items-end">

                    <!-- Transaction Number -->
                    <div class="col-md-4">
                        <label for="transaction_no" class="form-label text-white">Transaction Number</label>
                        <input type="text" name="transaction_no" id="transaction_no"
                            class="form-control @error('transaction_no') is-invalid @enderror"
                            value="{{ request('transaction_no') }}">
                        @error('transaction_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Type -->
                    <div class="col-md-4">
                        <label for="type" class="form-label text-white">Type</label>
                        <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                            <option value="">All</option>
                            <option value="deposit" {{ request('type') == 'deposit' ? 'selected' : '' }}>Deposit</option>
                            <option value="withdraw" {{ request('type') == 'withdraw' ? 'selected' : '' }}>Withdraw</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remark -->
                    <div class="col-md-4">
                        <label for="remark" class="form-label text-white">Remark</label>
                        <select name="remark" id="remark" class="form-control @error('remark') is-invalid @enderror">
                            <option value="">Any</option>
                            <option value="success" {{ request('remark') == 'success' ? 'selected' : '' }}>Success</option>
                            <option value="pending" {{ request('remark') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="failed" {{ request('remark') == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                        @error('remark')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Filter Button -->
                    <button type="submit" class="trk-btn trk-btn--border trk-btn--primary mt-4 d-block"> <i
                            class="fas fa-filter"></i> Filter

                    </button>
                </div>
            </form>
        </div>
    </section>

@endsection
