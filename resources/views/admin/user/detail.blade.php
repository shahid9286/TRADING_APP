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
                                {{ $user->profile->first_name . ' ' . $user->profile->last_name }}
                            </h3>
                            <p class="text-center text-muted mb-4">@ {{ $user->username }}</p>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-telephone text-primary me-2"></i> Phone No</span>
                                    <span class="badge bg-primary rounded-pill">{{ $user->phone }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-envelope text-info me-2"></i> Email</span>
                                    <span class="text-info fw-semibold">{{ $user->email }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-wallet2 text-success me-2"></i> Net Balance</span>
                                    <span
                                        class="badge bg-success rounded-pill">{{ number_format($user->net_balance, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-lock text-danger me-2"></i> Locked Amount</span>
                                    <span
                                        class="badge bg-danger rounded-pill">{{ number_format($user->locked_amount, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="bi bi-cash-stack text-warning me-2"></i> Available Withdrawal</span>
                                    <span class="badge bg-warning text-dark rounded-pill">
                                        {{ number_format($user->net_balance - $user->locked_amount, 2) }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mt-2">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#details"
                                        data-toggle="tab">Details</a></li>
                                <li class="nav-item"><a class="nav-link" href="#investments"
                                        data-toggle="tab">Investments</a></li>
                                <li class="nav-item"><a class="nav-link" href="#withdrawals"
                                        data-toggle="tab">Withdrawals</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="details">
                                    <table class="table table-sm align-middle">
                                        <tr>
                                            <th>Total Investments</th>
                                            <td><span class="badge bg-primary">2</span></td>
                                        </tr>
                                        <tr>
                                            <th>Direct Referrals</th>
                                            <td><span class="badge bg-success">2</span></td>
                                        </tr>
                                        <tr>
                                            <th>Team Invest</th>
                                            <td><span class="badge bg-info text-dark">2</span></td>
                                        </tr>
                                        <tr>
                                            <th>Deposit Wallet Balance</th>
                                            <td><span class="badge bg-warning text-dark">2</span></td>
                                        </tr>
                                        <tr>
                                            <th>Profit Wallet Balance</th>
                                            <td><span class="badge bg-success">2</span></td>
                                        </tr>
                                        <tr>
                                            <th>Referral Earning</th>
                                            <td><span class="badge bg-secondary">2</span></td>
                                        </tr>
                                        <tr>
                                            <th>Total Deposit</th>
                                            <td><span class="badge bg-primary">2</span></td>
                                        </tr>
                                        <tr>
                                            <th>Total Invest</th>
                                            <td><span class="badge bg-dark">2</span></td>
                                        </tr>
                                        <tr>
                                            <th>Total Withdrawal</th>
                                            <td><span class="badge bg-danger">2</span></td>
                                        </tr>
                                    </table>

                                </div>
                                <div class="tab-pane" id="investments">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr class="bg-secondary">
                                                <th>{{ __('#') }}</th>
                                                <th>{{ __('Amount') }}</th>
                                                <th>{{ __('Start/Expiry & Active Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($user->investments as $investment)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{ $investment->amount }}
                                                        @if ($investment->status === 'approved')
                                                            <span class="badge badge-success">{{ __('Approved') }}</span>
                                                        @elseif($investment->status === 'rejected')
                                                            <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                                        @else
                                                            <span class="badge badge-warning">{{ __('Pending') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($investment->start_date)->format('d M Y') }}
                                                        -
                                                        {{ \Carbon\Carbon::parse($investment->expiry_date)->format('d M Y') }}

                                                        @if ($investment->is_active === 'active')
                                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ __('Expired') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#investmentDetail"
                                                            data-amount="{{ $investment->amount }}"
                                                            data-start_date="{{ \Carbon\Carbon::parse($investment->start_date)->format('d M Y') }}"
                                                            data-expiry_date="{{ \Carbon\Carbon::parse($investment->expiry_date)->format('d M Y') }}"
                                                            data-status="{{ $investment->status }}"
                                                            data-transaction_id="{{ $investment->transaction_id }}"
                                                            data-screenshot="{{ asset($investment->screenshot) }}"
                                                            data-active_status="{{ $investment->is_active }}"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i> {{ __('Details') }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">{{ __('No investment found.') }}
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane" id="withdrawals">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr class="bg-warning">
                                                <th>{{ __('#') }}</th>
                                                <th>{{ __('User') }}</th>
                                                <th>{{ __('Request Date') }}</th>
                                                <th>{{ __('Requested Amount') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($user->withdrawalRequests as $withdrawal_request)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>


                                                    <td>{{ $withdrawal_request->user->username ?? 'N/A' }}</td>

                                                    <td>{{ $withdrawal_request->request_date->format('d M, Y') }}</td>

                                                    <td>{{ number_format($withdrawal_request->requested_amount, 2) }}</td>

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

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted">No withdrawal
                                                        requests
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
                <div class="col-md-4 mt-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Parent Tree</h3>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group">

                                @if ($user->referral)
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Referred By:</strong> {{ $user->referral->username }}
                                    </li>
                                @endif

                                @if ($user->level1)
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Level 1:</strong> {{ $user->level1->username }}
                                    </li>
                                @endif

                                @if ($user->level2)
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Level 2:</strong> {{ $user->level2->username }}
                                    </li>
                                @endif

                                @if ($user->level3)
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Level 3:</strong> {{ $user->level3->username }}
                                    </li>
                                @endif

                                @if ($user->level4)
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Level 4:</strong> {{ $user->level4->username }}
                                    </li>
                                @endif

                                @if ($user->level5)
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Level 5:</strong> {{ $user->level5->username }}
                                    </li>
                                @endif

                                @if ($user->level6)
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Level 6:</strong> {{ $user->level6->username }}
                                    </li>
                                @endif

                                @if ($user->level7)
                                    <li class="list-group-item d-flex justify-content-between">
                                        <strong>Level 7:</strong> {{ $user->level7->username }}
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection