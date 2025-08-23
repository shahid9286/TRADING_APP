@extends('front.layouts.master')
@section('title', 'User Level Earnings')
@section('css')
    <style>
        .table th,
        .table td {
            background-color: transparent !important;
            text-align: center;
        }
    </style>

@endsection
@section('content')

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

@endsection
