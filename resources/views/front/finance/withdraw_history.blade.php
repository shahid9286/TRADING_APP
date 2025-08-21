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
                                [$class, $label] = $statuses[$withdrawal_request->status] ?? [
                                    'bg-secondary',
                                    'Unknown',
                                ];
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
                                    <a href="javascript:void(0)"
                                        class="icon-btn bg--base text-white d-flex justify-content-center align-items-center detailBtn"
                                        data-bs-toggle="modal" data-bs-target="#withdrawModal"
                                        data-trx="TB3dN33BQCN9ddBtRY6KNSR66iar4VpfkK"
                                        data-screenshot="{{ asset('front/images/favicon.png') }}">
                                        <i class="fa fa-desktop"></i>
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

    <div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="withdrawModalLabel">Transaction Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p><strong>Trx ID:</strong> <span id="trxId"></span></p>
                    <p><strong>Screenshot:</strong></p>
                    <img id="screenshotImg" src="" alt="Screenshot" class="img-fluid border">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.detailBtn').forEach(button => {
            button.addEventListener('click', function() {
                let trx = this.getAttribute('data-trx');
                let screenshot = this.getAttribute('data-screenshot');

                document.getElementById('trxId').textContent = trx;
                document.getElementById('screenshotImg').src = screenshot;
            });
        });
    </script>

@endsection
