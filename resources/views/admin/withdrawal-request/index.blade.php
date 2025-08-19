@extends('admin.layouts.master')
@section('title', 'Withdrawal Request List')

@section('content')
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
                                                <td>{{ $withdrawal_request->user->name ?? 'N/A' }}</td>

                                                {{-- Request Date --}}
                                                <td>{{ $withdrawal_request->request_date }}</td>

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
                                                    <div class="d-flex justify-content-center">
                                                       

                                                        @if($withdrawal_request->status === 'pending')
                                                  <form id="deleteform" class="d-inline-block"
                                        action="{{ route('admin.withdrawal-request.delete', $withdrawal_request->id) }}"
                                      method="post">
                                                 @csrf
                                                     <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                                   <i class="fas fa-trash"></i>{{ __('Delete') }}
                                                   </button>
                                                 </form>
                                                 @else
    <button class="btn btn-secondary btn-sm" disabled>
        <i class="fas fa-ban"></i> Cannot Delete
    </button>
@endif

                                                    </div>
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
