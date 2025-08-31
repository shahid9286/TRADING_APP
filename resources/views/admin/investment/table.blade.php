<table class="table table-dark table-bordered table-striped table-dark data_table">
    <thead>
        <tr>
            <th>{{ __('ID') }}</th>
            <th>{{ __('User') }}</th>
            <th>{{ __('Amount') }}</th>
            <th>{{ __('Start/Expiry Date') }}</th>
            <th>Status</th>
            <th>Activity</th>
            <th>{{ __('Action') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($investments as $investment)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $investment->user->username }}</td>
                <td>{{ $investment->amount }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($investment->start_date)->format('d M Y') }} -
                    {{ \Carbon\Carbon::parse($investment->expiry_date)->format('d M Y') }}

                </td>
                <td>
                    @if ($investment->status === 'pending')
                        <span class="badge badge-warning">{{ __('Pending') }}</span>
                    @elseif($investment->status === 'rejected')
                        <span class="badge badge-danger">{{ __('Rejected') }}</span>
                    @else
                        <span class="badge badge-success">Approved</span>
                    @endif
                </td>
                <td>
                    @if ($investment->is_active === 'inactive')
                        <span class="badge badge-warning">{{ __('Inactive') }}</span>
                    @elseif($investment->is_active === 'expired')
                        <span class="badge badge-danger">{{ __('Expired') }}</span>
                    @else
                        <span class="badge badge-success">Active</span>
                    @endif
                </td>
                <td>
                    <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                        data-bs-target="#investmentDetail" data-amount="{{ $investment->amount }}"
                        data-start_date="{{ \Carbon\Carbon::parse($investment->start_date)->format('d M Y') }}"
                        data-expiry_date="{{ \Carbon\Carbon::parse($investment->expiry_date)->format('d M Y') }}"
                        data-status="{{ $investment->status }}"
                        data-transaction_id="{{ $investment->transaction_id }}"
                        data-screenshot="{{ asset($investment->screenshot) }}"
                        data-active_status="{{ $investment->is_active }}">
                        <i class="fas fa-eye"></i> {{ __('Details') }}
                    </a>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm">Action</button>
                        <button type="button"
                            class="btn btn-success btn-sm dropdown-toggle dropdown-hover dropdown-icon"
                            data-toggle="dropdown" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu" style="">
                            @if ($investment->status === 'pending')
                                <form action="{{ route('admin.investment.approved', $investment->id) }}" method="post"
                                    class="approve-form">
                                    @csrf
                                    <button type="submit" class="dropdown-item approve-btn">Approve</button>
                                </form>
                                <form action="{{ route('admin.investment.reject', $investment->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Reject</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">{{ __('No investment found.') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
