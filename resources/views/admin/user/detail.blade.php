@extends('admin.layouts.master')
@section('title', 'All Users')

@section('content')

    <section class="content">
        <div class="container-fluid pt-3">

            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="bi bi-cash"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Net Balance</span>
                            <span class="info-box-number">
                                ${{ $user->net_balance }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="bi bi-lock"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Locked Amount</span>
                            <span class="info-box-number">${{ $user->locked_amount }}</span>
                        </div>
                    </div>
                </div>

                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="bi bi-currency-dollar"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Invested</span>
                            <span class="info-box-number">${{ $user->userTotal->total_invested }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="bi bi-coin text-white"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Withdrawal</span>
                            <span class="info-box-number">${{ $user->userTotal->total_withdraws }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
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
                <div class="col-md-8">

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
                                        @foreach (\App\Models\Investment::where('user_id', $user->id)->latest()->limit(10)->get() as $investment)
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
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <h5 class="description-header">${{ $user->current_month_salary }}</h5>
                                <span class="description-text">Current Month Salary</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <h5 class="description-header">${{ $user->userTotal->total_salaries }}</h5>
                                <span class="description-text">Salaries Received</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <h5 class="description-header">${{ $user->userTotal->total_refferal_commision ?? '0.00' }}</h5>
                                <span class="description-text">Total Refferal Commission</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6 text-center">
                            <div class="description-block">
                                <h5 class="description-header">${{ $user->userTotal->total_rewards }}</h5>
                                <span class="description-text">Total Rewards</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Parent Tree</h3>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group">

                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Referred By:</strong> {{ $user->referral->username ?? 'No' }}
                                </li>

                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Level 1:</strong> {{ $user->level1->username ?? 'No' }}
                                </li>

                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Level 2:</strong> {{ $user->level2->username ?? 'No' }}
                                </li>

                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Level 3:</strong> {{ $user->level3->username ?? 'No' }}
                                </li>

                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Level 4:</strong> {{ $user->level4->username ?? 'No' }}
                                </li>

                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Level 5:</strong> {{ $user->level5->username ?? 'No' }}
                                </li>

                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Level 6:</strong> {{ $user->level6->username ?? 'No' }}
                                </li>

                                <li class="list-group-item d-flex justify-content-between">
                                    <strong>Level 7:</strong> {{ $user->level7->username ?? 'No' }}
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">

                    <div class="card card-warning">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Recent Transactions</h3>

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
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Old Balance</th>
                                            <th>Current Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (\App\Models\UserLedger::where('user_id', $user->id)->latest()->limit(10)->get() as $transaction)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $transaction->description }}</td>
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
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a href="javascript:void(0)" class="btn btn-sm btn-warning float-right">View All
                                Transactions</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
