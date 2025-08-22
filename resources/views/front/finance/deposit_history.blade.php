@extends('front.layouts.master')
@section('title', 'Deposit History')

@section('content')

    <section class="pt-4">
        <div class="container">

            <!-- Search -->
            {{-- <div class="d-flex justify-content-end mb-4">
                <form method="GET" action="#" class="d-flex" style="max-width: 300px;">
                    <input type="text" name="search" placeholder="Search by transactions" class="form-control"
                        style="color: #fff; border: none; border-radius: 8px 0 0 8px;">
                    <button type="submit" style="border: none; border-radius: 0 8px 8px 0; padding: 0 12px;"
                        class="trk-btn trk-btn--border trk-btn--primary">
                        <i class="fas fa-search" style="color: #000;"></i>
                    </button>
                </form>
            </div> --}}

            <!-- History Table -->
            {{-- <div class="table-responsive"> --}}
            <table id="myTable" class="table table-borderless align-middle text-white">
                <thead style="border-bottom: 1px solid #4a4a4a;" class="table-heading">
                    <tr>
                        <th class="fs-5">Admin Bank</th>
                        <th class="fs-5">Date</th>
                        <th class="fs-5">Amount</th>
                        <th class="fs-5">Status</th>
                        <th class="fs-5">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $statuses = [
                            'pending' => ['bg-warning text-dark', 'Pending'],
                            'approved' => ['bg-primary', 'Approved'],
                            'rejected' => ['bg-danger', 'Rejected'],
                        ];

                    @endphp
                    @foreach ($investments as $investment)
                        @php
                            $date = \Carbon\Carbon::parse($investment->request_date);
                            [$class, $label] = $statuses[$investment->status] ?? ['bg-secondary', 'Unknown'];
                        @endphp
                        <tr>
                            <td>
                                <small>{{ $investment->admin_bank_address }}</small>
                            </td>
                            <td>
                                {{ $date->format('d M, Y') }}

                                <small>
                                    @if ($date->isToday())
                                        Today
                                    @elseif ($date->isYesterday())
                                        Yesterday
                                    @else
                                        {{ $date->diffInDays() }} days ago
                                    @endif
                                </small>
                            </td>
                            <td>
                                <strong>{{ $investment->amount }} USDT</strong>
                            </td>
                            <td>
                                <span class="badge {{ $class }}">{{ $label }}</span>
                            </td>
                            <td>
                                <a href="{{ route('front.deposit.detail', $investment->transaction_id) }}"
                                    data-bs-toggle="modal" data-bs-target="#investmentDetail"
                                    data-amount="{{ $investment->amount }}"
                                    data-start_date="{{ \Carbon\Carbon::parse($investment->start_date)->format('d M Y') }}"
                                    data-expiry_date="{{ \Carbon\Carbon::parse($investment->expiry_date)->format('d M Y') }}"
                                    data-status="{{ $investment->status }}"
                                    data-transaction_id="{{ $investment->transaction_id }}"
                                    data-screenshot="{{ asset($investment->screenshot) }}"
                                    data-active_status="{{ $investment->is_active }}"
                                    class="btn btn-success">
                                    <i class="fa fa-eye"></i> <span class="ps-1">Detail</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{-- </div> --}}

        </div>
    </section>

    <style>
        .table td,
        .table th {
            background-color: transparent !important;
        }
    </style>

    <div class="modal fade" id="investmentDetail" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="withdrawModalLabel">Transaction Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-4">Amount</dt>
                        <dd class="col-sm-8" id="modal-amount"></dd>

                        <dt class="col-sm-4">Start Date</dt>
                        <dd class="col-sm-8" id="modal-start-date"></dd>

                        <dt class="col-sm-4">Expiry Date</dt>
                        <dd class="col-sm-8" id="modal-expiry-date"></dd>

                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8"><span id="modal-status" class="badge"></span></dd>

                        <dt class="col-sm-4">Transaction ID</dt>
                        <dd class="col-sm-8" id="modal-transaction-id"></dd>

                        <dt class="col-sm-4">Screenshot</dt>
                        <dd class="col-sm-8" id="modal-screenshot"></dd>

                        <dt class="col-sm-4">Active Status</dt>
                        <dd class="col-sm-8"><span id="modal-active-status" class="badge"></span></dd>
                    </dl>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

@endsection
