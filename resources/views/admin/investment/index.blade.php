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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Search Transaction ID</label>
                                                <select class="form-control select2" name="transaction_id">
                                                    <option value="">Select Transaction ID</option>
                                                    @foreach ($investments as $investment)
                                                        <option value="{{ $investment->transaction_id }}">
                                                            {{ $investment->transaction_id }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Date Range Picker -->
                                        <div class="col-md-4 mb-3">
                                            <label for="date_range" class="form-label">Date Range</label>
                                            <input type="text" class="form-control" name="date_range" id="date_range"
                                                placeholder="Select Date Range">
                                        </div>

                                        <!-- Amount -->
                                        <div class="col-md-4 mb-3">
                                            <label for="amount" class="form-label">Amount</label>
                                            <select class="form-control select2" name="amount">
                                                <option value="">Search Amount</option>
                                                @foreach ($investments as $investment)
                                                    <option value="{{ $investment->amount }}">{{ $investment->amount }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Status -->
                                        <div class="col-lg-3 mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-control select2" name="status">
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
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Start/Expiry Date & Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($investments as $investment)
                                <tr>
                                    <td>{{ $investment->id }}</td>
                                    <td>{{ $investment->amount }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($investment->start_date)->format('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($investment->expiry_date)->format('d M Y') }}

                                        @if ($investment->is_active === 'active')
                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('Expired') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-warning btn-sm">
                                            <i class="fas fa-eye"></i> {{ __('Details') }}
                                        </a>
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
    <!-- ✅ DateRangePicker scripts -->
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>
        $(document).ready(function() {
            // ✅ Initialize Date Range Picker
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

            // ✅ AJAX search
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

            // ✅ Refresh
            $('#refreshBtn').on('click', function() {
                $('#searchForm')[0].reset();
                $('#date_range').val('');
                $('#searchForm').submit();
            });
        });
    </script>
@endsection
