@extends('admin.layouts.master')
@section('title', 'Dashboard')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Welcome back, {{ auth()->user()->username }}!</h1>
                </div>
            </div>
            <div class="row mt-2">

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="fas fa-bullhorn"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text font-weight-bold">Running Announcements</span>
                            <span
                                class="info-box-number">{{ \App\Models\Announcement::where('status', 'active')->count() }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box bg-warning">
                        <span class="info-box-icon"><i class="fas fa-gift"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text font-weight-bold">Running Offers</span>
                            <span class="info-box-number">2</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text font-weight-bold">Total Users</span>
                            <span class="info-box-number">{{ \App\Models\User::role('user')->count() }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box bg-dark">
                        <span class="info-box-icon"><i class="far fa-money-bill-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text font-weight-bold">Cash in Hand</span>
                            <span class="info-box-number">$25,000</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box bg-danger">
                        <span class="info-box-icon"><i class="fas fa-hand-holding-usd"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text font-weight-bold">Monthly Salaries to Give</span>
                            <span class="info-box-number">$18,000</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box bg-secondary">
                        <span class="info-box-icon"><i class="fas fa-question-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text font-weight-bold">Pending Enquiries</span>
                            <span
                                class="info-box-number">{{ \App\Models\Enquiry::where('status', 'pending')->count() }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ \App\Models\WithdrawalRequest::where('created_at', '>=', \Carbon\Carbon::now()->subDays(3))->count() }}
                            </h3>
                            <p>Recent Withdrawal Requests</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <a href="#" class="small-box-footer">See All <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>2</h3>
                            <p>Pending Withdrawal Requests</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <a href="#" class="small-box-footer">Review <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>10</h3>
                            <p>Recent Investments</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <a href="#" class="small-box-footer">See All <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h3>4</h3>
                            <p>Pending Investments</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <a href="#" class="small-box-footer">Review <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Recent Investments</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                                        @foreach (\App\Models\Investment::latest()->limit(15)->get() as $investment)
                                            @php
                                                [$class, $label] = $statuses[$investment->status] ?? [
                                                    'bg-secondary',
                                                    'Unknown',
                                                ];
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a
                                                        href="{{ route('admin.user.detail', $investment->user->id) }}">{{ $investment->user->username }}</a>
                                                </td>
                                                <td>{{ $investment->amount }}</td>
                                                <td>
                                                    <span class="badge {{ $class }}">{{ $label }}</span>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                        data-bs-target="#investmentDetail"
                                                        data-amount="{{ $investment->amount }}"
                                                        data-start_date="{{ \Carbon\Carbon::parse($investment->start_date)->format('d M Y') }}"
                                                        data-expiry_date="{{ \Carbon\Carbon::parse($investment->expiry_date)->format('d M Y') }}"
                                                        data-status="{{ $investment->status }}"
                                                        data-transaction_id="{{ $investment->transaction_id }}"
                                                        data-screenshot="{{ asset($investment->screenshot) }}"
                                                        data-active_status="{{ $investment->is_active }}"><i
                                                            class="bi bi-eye"></i>
                                                        Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary float-right">View All
                                Investments</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-warning">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Recent Withdrawal Requests</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                                        @foreach (\App\Models\WithdrawalRequest::latest()->limit(15)->get() as $withdrawal_request)
                                            @php
                                                [$class, $label] = $statuses[$withdrawal_request->status] ?? [
                                                    'bg-secondary',
                                                    'Unknown',
                                                ];
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a
                                                        href="{{ route('admin.user.detail', $withdrawal_request->user->id) }}">{{ $investment->user->username }}</a>
                                                </td>
                                                <td>{{ $withdrawal_request->requested_date }}</td>
                                                <td>{{ $withdrawal_request->amount }}</td>
                                                <td>
                                                    <span class="badge {{ $class }}">{{ $label }}</span>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
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
                                                        data-client_status="{{ $withdrawal_request->client_status ?? '—' }}"><i
                                                            class="bi bi-eye"></i>
                                                        Detail</a>  
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a href="javascript:void(0)" class="btn btn-sm btn-warning float-right">View All
                                Investments</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
