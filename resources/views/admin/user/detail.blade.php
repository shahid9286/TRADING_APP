@extends('admin.layouts.master')
@section('title', 'All Users')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 mt-2">
                    <div class="card card-primary">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('assets/admin/uploads/user.png') }}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">
                                {{ $user->profile->first_name . ' ' . $user->profile->last_name }}</h3>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Username</b> <a class="float-right text-primary">{{ $user->username }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Name</b> <a class="float-right btn-info btn-sm btn text-white">{{ $user->profile->first_name . ' ' . $user->profile->last_name }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Phone No</b> <a class="float-right text-primary">{{ $user->phone }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right text-primary">{{ $user->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Net Balance</b> <a class="float-right text-primary">{{ $user->net_balance }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Locked Amount</b> <a class="float-right text-primary">{{ $user->locked_amount }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Available Withdrawal</b> <a class="float-right text-primary">{{ $user->net_balance - $user->locked_amount }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mt-2">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#investments"
                                        data-toggle="tab">Investments</a></li>
                                <li class="nav-item"><a class="nav-link" href="#withdrawals"
                                        data-toggle="tab">Withdrawals</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="investments">
                                    
                                </div>

                                <div class="tab-pane" id="withdrawals">

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
                        <div class="card-body">
                            <ul class="list-group">

                                @if ($user->referral)
                                    <li class="list-group-item">
                                        <strong>Referred By:</strong> {{ $user->referral->username }}
                                    </li>
                                @endif

                                @if ($user->level1)
                                    <li class="list-group-item">
                                        <strong>Level 1:</strong> {{ $user->level1->username }}
                                    </li>
                                @endif

                                @if ($user->level2)
                                    <li class="list-group-item">
                                        <strong>Level 2:</strong> {{ $user->level2->username }}
                                    </li>
                                @endif

                                @if ($user->level3)
                                    <li class="list-group-item">
                                        <strong>Level 3:</strong> {{ $user->level3->username }}
                                    </li>
                                @endif

                                @if ($user->level4)
                                    <li class="list-group-item">
                                        <strong>Level 4:</strong> {{ $user->level4->username }}
                                    </li>
                                @endif

                                @if ($user->level5)
                                    <li class="list-group-item">
                                        <strong>Level 5:</strong> {{ $user->level5->username }}
                                    </li>
                                @endif

                                @if ($user->level6)
                                    <li class="list-group-item">
                                        <strong>Level 6:</strong> {{ $user->level6->username }}
                                    </li>
                                @endif

                                @if ($user->level7)
                                    <li class="list-group-item">
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
