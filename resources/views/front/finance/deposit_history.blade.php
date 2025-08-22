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
                                    class="icon-btn bg--base text-white d-flex align-items-center">
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
