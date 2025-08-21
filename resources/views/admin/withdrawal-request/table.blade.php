<table class="table table-striped table-bordered table-sm">
    <thead>
        <tr>
            <th>#</th>
            <th>Screenshot</th>
            <th>User</th>
            <th>Request Date</th>
            <th>Requested Amount</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($withdrawal_requests as $withdrawal_request)
            <tr>
                <td>{{ $withdrawal_request->id }}</td>
                <td>
                    @if ($withdrawal_request->screenshot)
                        <img src="{{ asset('assets/admin/uploads/withdrawal_request/' . $withdrawal_request->screenshot) }}"
                             alt="Screenshot" width="50">
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ $withdrawal_request->user->username ?? 'N/A' }}</td>
                <td>{{ $withdrawal_request->request_date->format('d M, Y') }}</td>
                <td>{{ number_format($withdrawal_request->requested_amount, 2) }}</td>
                <td>
                    <span class="badge bg-{{ $withdrawal_request->status == 'approved'
                        ? 'success'
                        : ($withdrawal_request->status == 'pending'
                            ? 'warning'
                            : 'danger') }}">
                        {{ ucfirst($withdrawal_request->status) }}
                    </span>
                </td>
                <td>
                    @if ($withdrawal_request->status === 'pending')
                        <form action="{{ route('admin.withdrawal-request.delete', $withdrawal_request->id) }}"
                              method="post" class="d-inline-block">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Delete
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
                <td colspan="7" class="text-center text-muted">No withdrawal requests found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
