@extends('admin.layouts.master')
@section('title', 'Withdrawal Request List')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mt-2 card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><b>{{ __('Search Investment') }}</b></h3>
                        </div>
                        <div class="card-body py-2">
                            <div class="col-lg-12">
                                <form id="searchForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="user_id" class="form-label">User ID</label>
                                            <input type="text" class="form-control" name="user_id" id="user_id"
                                                placeholder="Enter User ID">
                                        </div>

                                        <!-- Date Range Picker -->
                                        <div class="col-md-3 mb-3">
                                            <label for="request_date" class="form-label">Requested Date</label>
                                            <input type="date" class="form-control" name="request_date" id="request_date"
                                                placeholder="Select Requested Date">
                                        </div>

                                        <!-- Amount -->
                                        <div class="col-md-3 mb-3">
                                            <label for="requested_amount" class="form-label">Request Amount</label>
                                            <input type="number" step="0.01" class="form-control"
                                                name="requested_amount" id="requested_amount"
                                                placeholder="Enter Request Amount">
                                        </div>

                                        <!-- Status -->
                                        <div class="col-md-3 mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="">Select Status</option>
                                                <option value="pending">Pending</option>
                                                <option value="approved">Approved</option>
                                                <option value="rejected">Rejected</option>
                                            </select>
                                        </div>

                                    </div>

                                    <!-- Buttons -->
                                    <div class="col-lg-12 text-right mt-3">
                                        <button type="button" class="btn btn-primary btn-sm" id="refreshBtn">
                                            <i class="bi bi-arrow-clockwise"></i> Refresh
                                        </button>
                                        <button type="submit" class="btn btn-success btn-sm" id="searchBtn">
                                            <i class="bi bi-search"></i> Search
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline mt-3">
                        <div class="card-header">
                            <h3 class="card-title mt-1"><b>{{ __('List of Withdrawal Requests') }}</b></h3>
                            <div class="card-tools d-flex">



                            </div>
                        </div>

                        <div class="card-body">
                            <div class="tableContent">
                                <table class="table table-striped table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>{{ __('#') }}</th>
                                            <th>{{ __('Screenshot') }}</th>
                                            <th>{{ __('User') }}</th>
                                            <th>{{ __('Request Date') }}</th>
                                            <th>{{ __('Requested Amount') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($withdrawal_requests as $withdrawal_request)
                                            <tr>
                                                <td class="text-center">{{ $withdrawal_request->id }}</td>


                                                {{-- Screenshot --}}
                                                <td>
                                                    @if ($withdrawal_request->screenshot)
                                                        <img src="{{ asset('assets/admin/uploads/withdrawal_request/' . $withdrawal_request->screenshot) }}"
                                                            alt="Screenshot" width="50">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>


                                                {{-- User --}}
                                                <td>{{ $withdrawal_request->user->username ?? 'N/A' }}</td>

                                                {{-- Request Date --}}
                                                <td>{{ $withdrawal_request->request_date->format('d M, Y') }}</td>

                                                {{-- Requested Amount --}}
                                                <td>{{ number_format($withdrawal_request->requested_amount, 2) }}</td>

                                                {{-- Status --}}
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $withdrawal_request->status == 'approved'
                                                            ? 'success'
                                                            : ($withdrawal_request->status == 'pending'
                                                                ? 'warning'
                                                                : ($withdrawal_request->status == 'rejected'
                                                                    ? 'danger'
                                                                    : 'info')) }}">
                                                        {{ ucfirst($withdrawal_request->status) }}
                                                    </span>
                                                </td>

                                                <td>
                                                        <a href="#" data-bs-toggle="modal"
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
                                                            data-client_status="{{ $withdrawal_request->client_status ?? '—' }}"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        @if ($withdrawal_request->status === 'pending')
                                                            <form id="deleteform" class="d-inline-block"
                                                                action="{{ route('admin.withdrawal-request.delete', $withdrawal_request->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    id="delete">
                                                                    <i class="fas fa-trash"></i>{{ __('Delete') }}
                                                                </button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-secondary btn-sm" disabled>
                                                                <i class="fas fa-ban"></i> Cannot Delete
                                                            </button>
                                                        @endif

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No withdrawal requests
                                                    found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')

    <script>
        $(document).ready(function() {
            $('#searchForm').on('submit', function(e) {
                e.preventDefault();

                $('#searchBtn').html('<i class="fa fa-spinner fa-spin"></i> Searching...');
                $('#searchBtn').prop('disabled', true);

                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.withdrawal-request.search') }}",
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        $('.tableContent').html(response.html);
                    },
                    error: function(xhr) {
                        alert(xhr.responseJSON?.message || 'Something went wrong.');
                    },
                    complete: function() {
                        $('#searchBtn').html('<i class="bi bi-search"></i> Search');
                        $('#searchBtn').prop('disabled', false);
                    }
                });
            });

            $('#refreshBtn').on('click', function() {
                $('#searchForm')[0].reset();
                $('#searchForm').submit();
            });
        });
    </script>
@endsection
