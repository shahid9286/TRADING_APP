@extends('admin.layouts.master')
@section('title', 'All Users')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 mt-2">
                    <div class="card card-primary">
                        <div class="card-body box-profile bg-light rounded shadow-sm p-0 pt-4">
                            <div class="text-center mb-3">
                                <img class="profile-user-img img-fluid rounded-circle border border-3 border-primary shadow"
                                    src="{{ asset('assets/admin/uploads/user.png') }}" alt="User profile picture"
                                    style="width:120px; height:120px; object-fit:cover;">
                            </div>

                            <h3 class="profile-username text-center fw-bold text-dark">
                                {{ $withdrawal_request->user->profile->first_name . ' ' . $withdrawal_request->user->profile->last_name }}
                            </h3>
                            <p class="text-center text-muted mb-4">@ {{ $withdrawal_request->user->username }}</p>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-telephone text-primary me-2"></i> Phone No</span>
                                    <span
                                        class="badge bg-primary rounded-pill">{{ $withdrawal_request->user->phone }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-envelope text-info me-2"></i> Email</span>
                                    <span class="text-info fw-semibold">{{ $withdrawal_request->user->email }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-wallet2 text-success me-2"></i> Net Balance</span>
                                    <span
                                        class="badge bg-success rounded-pill">{{ number_format($withdrawal_request->user->net_balance, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-lock text-danger me-2"></i> Locked Amount</span>
                                    <span
                                        class="badge bg-danger rounded-pill">{{ number_format($withdrawal_request->user->locked_amount, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-cash-stack text-warning me-2"></i> Available Withdrawal</span>
                                    <span class="badge bg-warning text-dark rounded-pill">
                                        {{ number_format($withdrawal_request->user->net_balance - $withdrawal_request->user->locked_amount, 2) }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mt-2">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="card-title">Withdrawal Info</div>
                            <div class="card-tools"><span class="badge bg-primary">{{ $withdrawal_request->status }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div>
                                        <strong>Bank Name:</strong>
                                        <p class="mb-0 text-muted">{{ $withdrawal_request->bank_name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <strong>Account No:</strong>
                                        <p class="mb-0 text-muted">{{ $withdrawal_request->account_no }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <strong>Request Date:</strong>
                                    <p class="mb-0 text-muted">{{ $withdrawal_request->request_date }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Requested Amount:</strong>
                                    <p class="mb-0 text-success fw-bold">
                                        {{ number_format($withdrawal_request->requested_amount, 2) }}</p>
                                </div>
                                @if ($withdrawal_request->status === 'rejected')
                                    <div class="col-md-6">
                                        <strong>Remarks:</strong>
                                        <p class="mb-0 text-muted">{{ $withdrawal_request->remarks ?? null }}</p>
                                    </div>
                                @endif
                                @if ($withdrawal_request->status === 'approved')
                                    <div class="col-md-6">
                                        <strong>Fee:</strong>
                                        <p class="mb-0 text-muted">{{ $withdrawal_request->fee ?? null }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Payout Amount:</strong>
                                        <p class="mb-0 text-muted">{{ $withdrawal_request->payout_amount ?? null }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Approved Date:</strong>
                                        <p class="mb-0 text-muted">{{ $withdrawal_request->approval_date ?? null }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Payout Date:</strong>
                                        <p class="mb-0 text-muted">{{ $withdrawal_request->payout_date ?? null }}</p>
                                    </div>
                                    @if ($withdrawal_request->payment_status === 'paid')
                                        <div class="col-md-6">
                                            <strong>Transaction ID:</strong>
                                            <p class="mb-0 text-muted">{{ $withdrawal_request->transaction_id ?? null }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>
                                                Screenshot
                                            </strong>
                                            <p class="mb-0 text-muted">
                                                @if ($withdrawal_request->screenshot)
                                                    <a href="{{ asset($withdrawal_request->screenshot) }}" target="_blank"
                                                        rel="noopener noreferrer">View Screenshot</a>
                                                @else
                                                    N/A
                                                @endif
                                            </p>
                                        </div>
                                    @endif
                                @endif
                                @if ($withdrawal_request->status === 'pending')
                                    <a href="#" class="btn btn-sm btn-success mt-2 col-6" data-bs-toggle="modal"
                                        data-bs-target="#approveModal" data-id="{{ $withdrawal_request->id }}">
                                        Approve
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger mt-2 col-6" data-bs-toggle="modal"
                                        data-bs-target="#rejectModal" data-id="{{ $withdrawal_request->id }}">
                                        Reject
                                    </a>
                                @elseif($withdrawal_request->payment_status === 'pending')
                                    <a href="#" class="btn btn-sm btn-primary mt-2 col-12" data-bs-toggle="modal"
                                        data-bs-target="#payModal" data-id="{{ $withdrawal_request->id }}">
                                        Pay Now
                                    </a>
                                @endif
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
        $(document).on('click', '[data-bs-target="#approveModal"]', function() {
            let id = $(this).data('id');
            $('#awithdrawal_request_id').val(id);
        });

        $(document).on('click', '[data-bs-target="#rejectModal"]', function() {
            let id = $(this).data('id');
            $('#rwithdrawal_request_id').val(id);
        });
        
        $(document).on('click', '[data-bs-target="#payModal"]', function() {
            let id = $(this).data('id');
            $('#pwithdrawal_request_id').val(id);
        });
    </script>
@endsection
