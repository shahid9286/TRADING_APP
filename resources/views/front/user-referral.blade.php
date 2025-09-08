@extends('front.layouts.master')
@section('title', 'My Referral')
@section('css')
    <style>
        .table th,
        .table td {
            background-color: transparent !important;
            text-align: center;
        }
    </style>

@endsection

{{-- @section('content')

    
@endsection --}}


@section('content')

<section class="d-flex align-items-center justify-content-center bg-color min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">

                    <label for="referralLink" class="form-label fw-bold mb-3 text-white fs-4">
                        Your Referral Link
                    </label>

                    <div class="input-group shadow-sm">
                        <input type="text" id="referralLink" class="form-control text-center"
                            value="{{ url('/') }}/user-signup/{{ Auth::user()->username }}" readonly>
                        <button class="trk-btn trk-btn--primary" id="copyBtn" type="button">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>

                    <small id="copyMsg" class="text-success d-none mt-3">
                        ✅ Copied to clipboard!
                    </small>

                </div>
            </div>
             @foreach ($levelsData as $level => $data)
        <section class="pt-4">
            <div class="container text-center">
                <h2>Level {{ $level }}</h2>
                <table class="table table-dark table-bordered">
                    <thead>
                        <tr style="background-color: #00D094;">
                            <th class="fs-5">#</th>
                            <th class="fs-5">Username</th>
                            <th class="fs-5">Date</th>
                            <th class="fs-5">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data['investments'] as $index => $investment)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $investment->user->username }}</td>
                                <td>{{ $investment->created_at->format('d M Y') }}</td>
                                <td>{{ number_format($investment->amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No investments found for this level.</td>
                            </tr>
                        @endforelse
                        <tr class="fw-bold" style="background-color: #00D094;">
                            <td class="fs-5" colspan="2">Total Transactions: <span class="badge bg-danger">{{ $data['total_transactions'] }}</span></td>
                            <td class="fs-5">Total Amount:</td>
                            <td class="fs-5"><span class="badge bg-danger">{{ number_format($data['total_amount'], 2) }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    @endforeach
        </div>
    </section>
   

@endsection



@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const copyBtn = document.getElementById('copyBtn');
            const input = document.getElementById('referralLink');
            const msg = document.getElementById('copyMsg');

            copyBtn.addEventListener('click', function() {
                input.select();
                input.setSelectionRange(0, 99999); // For mobile
                navigator.clipboard.writeText(input.value).then(() => {
                    msg.classList.remove('d-none');
                    setTimeout(() => msg.classList.add('d-none'), 2000);
                });
            });
        });
    </script>
@endsection
