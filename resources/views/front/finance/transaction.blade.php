@extends('front.layouts.master')
@section('title', 'Withdraw')
@section('css')
    <style>
        .table td,
        .table th {
            background-color: transparent !important;
        }
    </style>
@endsection
@section('content')

    {{-- <section class="contact-section py-5" style="background-color: #071700;">
        <div class="container my-4">
            <form method="GET" action="{{ route('front.withdraw.request.history') }}" class="p-3 rounded"
                style="border: 1px solid #ccc;">
                <div class="row g-3 align-items-end">

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
    </section> --}}

    <div class="container">
        <div class="row text-center pt-3">
            <h2>Transaction List</h2>
            <table id="myTable" class="table table-borderless align-middle text-white pt-2">
                <thead style="border-bottom: 1px solid #4a4a4a;" class="table-heading">
                    <tr>
                        <th class="fs-5">#</th>
                        <th class="fs-5">Description</th>
                        <th class="fs-5">Amount</th>
                        <th class="fs-5">Type</th>
                        <th class="fs-5">Old Balance</th>
                        <th class="fs-5">Current Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#withdrawalRequestDetail"
                                    data-amount="{{ $withdrawal_request->bank_name }}"
                                    data-entry_date="{{ $withdrawal_request->account_no }}"
                                    data-type="{{ $withdrawal_request->requested_amount }}"
                                    data-request_date="{{ \Carbon\Carbon::parse($withdrawal_request->request_date)->format('d M Y') }}"
                                    data-status="{{ $withdrawal_request->status }}"
                                    data-approval_date="{{ $withdrawal_request->approval_date ? \Carbon\Carbon::parse($withdrawal_request->approval_date)->format('d M Y') : '—' }}"
                                    data-payout_date="{{ $withdrawal_request->payout_date ? \Carbon\Carbon::parse($withdrawal_request->payout_date)->format('d M Y') : '—' }}"
                                    data-payout_amount="{{ $withdrawal_request->payout_amount ?? '—' }}"
                                    data-fee="{{ $withdrawal_request->fee ?? '—' }}"
                                    data-total_payout="{{ $withdrawal_request->total_payout ?? '—' }}"
                                    data-transaction_id="{{ $withdrawal_request->transaction_id ?? '—' }}"
                                    data-screenshot="{{ $withdrawal_request->screenshot ? asset($withdrawal_request->screenshot) : '' }}"
                                    data-client_status="{{ $withdrawal_request->client_status ?? '—' }}">{{ $transaction->description }}</a>
                            </td>
                            <td>
                                ${{ $transaction->amount }}
                            </td>
                            <td>
                                {{ ucwords(str_replace('_', ' ', $transaction->type)) }}
                            </td>
                            <td>
                                ${{ $transaction->balance_before }}
                            </td>
                            <td>
                                ${{ $transaction->balance_after }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="withdrawalRequestDetail" tabindex="-1" aria-labelledby="withdrawModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #00150F;">

                <div class="modal-header">
                    <h5 class="modal-title" id="withdrawModalLabel">Transaction Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-4">Bank Name</dt>
                        <dd class="col-sm-8" id="modal-bank-name"></dd>

                        <dt class="col-sm-4">Account No</dt>
                        <dd class="col-sm-8" id="modal-account-no"></dd>

                        <dt class="col-sm-4">Requested Amount</dt>
                        <dd class="col-sm-8" id="modal-requested-amount"></dd>

                        <dt class="col-sm-4">Request Date</dt>
                        <dd class="col-sm-8" id="modal-request-date"></dd>

                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8"><span id="modal-status" class="badge"></span></dd>

                        <dt class="col-sm-4">Approval Date</dt>
                        <dd class="col-sm-8" id="modal-approval-date"></dd>

                        <dt class="col-sm-4">Payout Date</dt>
                        <dd class="col-sm-8" id="modal-payout-date"></dd>

                        <dt class="col-sm-4">Payout Amount</dt>
                        <dd class="col-sm-8" id="modal-payout-amount"></dd>

                        <dt class="col-sm-4">Fee</dt>
                        <dd class="col-sm-8" id="modal-fee"></dd>

                        <dt class="col-sm-4">Total Payout</dt>
                        <dd class="col-sm-8" id="modal-total-payout"></dd>

                        <dt class="col-sm-4">Transaction ID</dt>
                        <dd class="col-sm-8" id="modal-transaction-id"></dd>

                        <dt class="col-sm-4">Screenshot</dt>
                        <dd class="col-sm-8" id="modal-screenshot"></dd>

                        <dt class="col-sm-4">Client Status</dt>
                        <dd class="col-sm-8"><span id="modal-client-status" class="badge"></span></dd>
                    </dl>
                </div>

                <div class="modal-footer">
                    <button type="button" class="trk-btn trk-btn--border text-white" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection
