@extends('admin.layouts.master')
@section('title', 'Referral Rewards List')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-gift"></i> {{ __('Referral Rewards List') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-home"></i> {{ __('Home') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item">{{ __('Referral Rewards') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="btn-group" role="group">
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'all']) }}" 
                           class="btn btn-outline-primary {{ request('status', 'all') === 'all' ? 'active' : '' }}">
                            All Rewards
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'unpaid']) }}" 
                           class="btn btn-outline-warning {{ request('status') === 'unpaid' ? 'active' : '' }}">
                            Unpaid Rewards
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'paid']) }}" 
                           class="btn btn-outline-success {{ request('status') === 'paid' ? 'active' : '' }}">
                            Paid Rewards
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Referral Rewards List') }}</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-sm table-striped table-bordered table-dark data_table">
                        <thead>
                            <tr>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Username') }}</th>
                                <th>{{ __('Total Referral Investment') }}</th>
                                <th>{{ __('Reward Title') }}</th>
                                <th>{{ __('Reward Amount') }}</th>
                                <th>{{ __('Paid Date') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rewardLists as $reward)
                                @if((request('status') === 'paid' && $reward['paid']) || 
                                    (request('status') === 'unpaid' && !$reward['paid']) || 
                                    (request('status', 'all') === 'all'))
                                <tr>
                                    <td>
                                        @if($reward['paid'])
                                            <span class="badge badge-success">Paid</span>
                                        @else
                                            <span class="badge badge-warning">Unpaid</span>
                                        @endif
                                    </td>
                                    <td>{{ $reward['user_name'] }}</td>
                                    <td>{{ number_format($reward['total_referral_investment'], 2) }}</td>
                                    <td>{{ $reward['reward'] }}</td>
                                    <td>{{ number_format($reward['reward_amount'], 2) }}</td>
                                    <td>
                                        @if($reward['paid'] && $reward['paid_date'])
                                            {{ \Carbon\Carbon::parse($reward['paid_date'])->format('M d, Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if(!$reward['paid'])
                                            <button class="btn btn-success btn-sm payRewardBtn"
                                                data-username="{{ $reward['user_name'] }}"
                                                data-amount="{{ $reward['reward_amount'] }}"
                                                data-rewardtitle="{{ $reward['reward'] }}">
                                                <i class="fas fa-money-bill"></i> {{ __('Pay Reward') }}
                                            </button>
                                        @else
                                            <button class="btn btn-info btn-sm" disabled>
                                                <i class="fas fa-check"></i> {{ __('Already Paid') }}
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">{{ __('No rewards found.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Pay Reward Modal -->
    <div class="modal fade" id="payRewardModal" tabindex="-1" aria-labelledby="payRewardModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="payRewardForm" method="POST" action="{{ route('admin.reward.pay') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="payRewardModalLabel">{{ __('Pay Reward') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>{{ __('User:') }}</strong> <span id="modalUserName"></span></p>
                        <p><strong>{{ __('Amount:') }}</strong> $<span id="modalRewardAmount"></span></p>
                        <input type="hidden" name="user_name" id="inputUserName">
                        <input type="hidden" name="reward_amount" id="inputRewardAmount">
                        <input type="hidden" name="reward_title" id="inputRewardTitle">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Confirm Pay') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).on('click', '.payRewardBtn', function() {
            let username = $(this).data('username');
            let amount = $(this).data('amount');
            let rewardTitle = $(this).data('rewardtitle');
            
            // Fill modal values
            $('#modalUserName').text(username);
            $('#modalRewardAmount').text(amount);

            // Hidden inputs for form submit
            $('#inputUserName').val(username);
            $('#inputRewardAmount').val(amount);
            $('#inputRewardTitle').val(rewardTitle);

            // Show modal
            $('#payRewardModal').modal('show');
        });
    </script>
@endsection