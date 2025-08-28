@extends('admin.layouts.master')
@section('title', 'Investment List')
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
                                        <!-- Transaction ID -->
                                        <div class="col-md-3">
                                            <label>Search Transaction ID</label>
                                            <input type="text" class="form-control" name="transaction_id"
                                                id="transaction_id" placeholder="Enter Transaction Id">
                                        </div>

                                        <!-- Date Range Picker -->
                                        <div class="col-md-3 mb-3">
                                            <label for="date_range" class="form-label">Date Range</label>
                                            <input type="text" class="form-control" name="date_range" id="date_range"
                                                placeholder="Select Date Range">
                                        </div>

                                        <!-- Amount -->
                                        <div class="col-md-3 mb-3">
                                            <label for="amount" class="form-label">Amount</label>
                                            <input type="text" class="form-control" name="amount" id="amount"
                                                placeholder="Enter Amount">
                                        </div>

                                        <!-- Status -->
                                        <div class="col-md-3 mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-control select2" name="is_active" id="is_active">
                                                <option value="">Select Status</option>
                                                <option value="active">Active</option>
                                                <option value="expired">Expired</option>
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
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Investment List') }}</h3>
                </div>
                <div class="card-body table-responsive tableContent">
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
                                        @if ($investment->status === 'inactive')
                                            <span class="badge badge-warning">{{ __('Inactive') }}</span>
                                        @elseif($investment->status === 'expired')
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
                                                    <form action="{{ route('admin.investment.approved', $investment->id) }}"
                                                        method="post" class="approve-form">
                                                        @csrf
                                                        <button type="submit"
                                                            class="dropdown-item approve-btn">Approve</button>
                                                    </form>
                                                    <form
                                                        action="{{ route('admin.user.makeblockedUser', $investment->id) }}"
                                                        method="post">
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

                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).on("click", ".approve-btn", function(e) {
            e.preventDefault();
            let form = $(this).closest("form");

            Swal.fire({
                title: "Are you sure?",
                text: "You are about to approve this investment! You won't be able to get it back.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, approve it!",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
    <script>
        $(document).on("click", "#approve", function(e) {
            e.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true,
            }).then((result) => {
                if (result.value) {
                    $(this).parent("#deleteform").submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire("Cancelled", "Your file is safe :)", "error");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#date_range').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    format: 'YYYY-MM-DD',
                    cancelLabel: 'Clear'
                }
            });

            $('#date_range').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                    'YYYY-MM-DD'));
            });

            $('#date_range').on('cancel.daterangepicker', function() {
                $(this).val('');
            });

            $('#searchForm').on('submit', function(e) {
                e.preventDefault();

                $('#searchBtn').html('<i class="fa fa-spinner fa-spin"></i> Searching...');
                $('#searchBtn').prop('disabled', true);

                let formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.investment.search') }}",
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
                $('#date_range').val('');
                $('#searchForm').submit();
            });
        });
    </script>
@endsection
