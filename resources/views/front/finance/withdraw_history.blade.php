@extends('front.layouts.master')
@section('title', 'Withdraw History')

@section('content')

    <section class="padding-top">
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
                        <th class="fs-5">User Bank</th>
                        <th class="fs-5">Requested</th>
                        <th class="fs-5">Amount</th>
                        {{-- <th class="fs-5">Conversion</th> --}}
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
                            'completed' => ['bg-success', 'Completed'],
                        ];

                    @endphp
                    @foreach ($withdrawal_requests as $withdrawal_request)
                        @php
                            $date = \Carbon\Carbon::parse($withdrawal_request->request_date);
                            [$class, $label] = $statuses[$withdrawal_request->status] ?? ['bg-secondary', 'Unknown'];
                        @endphp
                        <tr>
                            <td>
                                {{ $withdrawal_request->bank_name }}<br>
                                <small>{{ $withdrawal_request->account_no }}</small>
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
                            {{-- <td>
                                $100.00 <span class="text-danger">+ 2.00</span><br>
                                <strong>98.00 USD</strong>
                            </td> --}}
                            <td>
                                1 USD = 1.00 USDT<br>
                                <strong>{{ $withdrawal_request->requested_amount }} USDT</strong>
                            </td>
                            <td>
                                <span class="badge {{ $class }}">{{ $label }}</span>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#withdrawalRequestDetail"
                                    data-bank_name="{{ $withdrawal_request->bank_name }}"
                                    data-account_no="{{ $withdrawal_request->account_no }}"
                                    data-requested_amount="{{ $withdrawal_request->requested_amount }}"
                                    data-request_date="{{ \Carbon\Carbon::parse($withdrawal_request->request_date)->format('d M Y') }}"
                                    data-status="{{ $withdrawal_request->status }}"
                                    data-approval_date="{{ $withdrawal_request->approval_date ? \Carbon\Carbon::parse($withdrawal_request->approval_date)->format('d M Y') : '—' }}"
                                    data-payout_date="{{ $withdrawal_request->payout_date ? \Carbon\Carbon::parse($withdrawal_request->payout_date)->format('d M Y') : '—' }}"
                                    data-payout_amount="{{ $withdrawal_request->payout_amount ?? '—' }}"
                                    data-fee="{{ $withdrawal_request->fee ?? '—' }}"
                                    data-total_payout="{{ $withdrawal_request->total_payout ?? '—' }}"
                                    data-transaction_id="{{ $withdrawal_request->transaction_id ?? '—' }}"
                                    data-screenshot="{{ $withdrawal_request->screenshot ? asset($withdrawal_request->screenshot) : '' }}"
                                    data-client_status="{{ $withdrawal_request->client_status ?? '—' }}">
                                    <i class="fa fa-eye"></i> Detail
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const withdrawalModal = document.getElementById('withdrawalRequestDetail');
            withdrawalModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;

                // Extract data attributes
                const bankName = button.getAttribute('data-bank_name');
                const accountNo = button.getAttribute('data-account_no');
                const requestedAmount = button.getAttribute('data-requested_amount');
                const requestDate = button.getAttribute('data-request_date');
                const status = button.getAttribute('data-status');
                const approvalDate = button.getAttribute('data-approval_date');
                const payoutDate = button.getAttribute('data-payout_date');
                const payoutAmount = button.getAttribute('data-payout_amount');
                const fee = button.getAttribute('data-fee');
                const totalPayout = button.getAttribute('data-total_payout');
                const transactionId = button.getAttribute('data-transaction_id');
                const screenshot = button.getAttribute('data-screenshot');
                const clientStatus = button.getAttribute('data-client_status');

                // Populate modal fields
                withdrawalModal.querySelector('#modal-bank-name').textContent = bankName;
                withdrawalModal.querySelector('#modal-account-no').textContent = accountNo;
                withdrawalModal.querySelector('#modal-requested-amount').textContent = requestedAmount;
                withdrawalModal.querySelector('#modal-request-date').textContent = requestDate;
                withdrawalModal.querySelector('#modal-status').textContent = status;
                withdrawalModal.querySelector('#modal-approval-date').textContent = approvalDate;
                withdrawalModal.querySelector('#modal-payout-date').textContent = payoutDate;
                withdrawalModal.querySelector('#modal-payout-amount').textContent = payoutAmount;
                withdrawalModal.querySelector('#modal-fee').textContent = fee;
                withdrawalModal.querySelector('#modal-total-payout').textContent = totalPayout;
                withdrawalModal.querySelector('#modal-transaction-id').textContent = transactionId;

                // Screenshot (if exists)
                const screenshotContainer = withdrawalModal.querySelector('#modal-screenshot');
                if (screenshot) {
                    screenshotContainer.innerHTML = `<a href="${screenshot}" target="_blank">
                                                    <img src="${screenshot}" alt="Screenshot" class="img-fluid rounded" style="max-height:150px;">
                                                 </a>`;
                } else {
                    screenshotContainer.textContent = '—';
                }

                // Status colors
                const statusBadge = withdrawalModal.querySelector('#modal-status');
                statusBadge.className = 'badge';
                if (status === 'approved') statusBadge.classList.add('bg-success');
                else if (status === 'pending') statusBadge.classList.add('bg-warning', 'text-dark');
                else if (status === 'rejected') statusBadge.classList.add('bg-danger');
                else if (status === 'completed') statusBadge.classList.add('bg-primary');

                const clientBadge = withdrawalModal.querySelector('#modal-client-status');
                clientBadge.textContent = clientStatus;
                clientBadge.className = 'badge';
                if (clientStatus === 'verified') clientBadge.classList.add('bg-success');
                else clientBadge.classList.add('bg-secondary');
            });
        });
    </script>

@endsection
