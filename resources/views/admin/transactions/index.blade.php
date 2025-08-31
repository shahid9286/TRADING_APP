@extends('admin.layouts.master')
@section('title', 'Transactions')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mt-2 card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><b>{{ __('Search Transactions') }}</b></h3>
                        </div>
                        <div class="card-body py-2">
                            <div class="col-lg-12">
                                @php
                                    $types = [
                                        'investment',
                                        'daily_profit',
                                        'referral_commission',
                                        'monthly_commission',
                                        'salary',
                                        'reward',
                                        'withdrawal',
                                        'admin_fee',
                                        'direct-plus',
                                        'direct-minus',
                                    ];
                                @endphp
                                <form id="searchForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="username" class="form-label">User <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control select2" name="username" id="username">
                                                <option value="">Select User</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->username }}">{{ $user->username }}</option>
                                                @endforeach
                                            </select>
                                            <small id="usernameError" class="text-danger d-none">Please select a
                                                user</small>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="type" class="form-label">Transaction Type</label>
                                            <select class="form-control" name="type" id="type">
                                                <option value="">Select Transaction Type</option>
                                                @foreach ($types as $type)
                                                    <option value="{{ $type }}">
                                                        {{ ucwords(str_replace('_', ' ', $type)) }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="date_range" class="form-label">Date Range</label>
                                            <input type="text" class="form-control" name="date_range" id="date_range"
                                                placeholder="Select Date Range">
                                        </div>

                                        <div class="col-md-12 text-right">
                                            <a id="searchBtn" class="btn btn-primary btn-sm">Search</a>
                                        </div>
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
                    <h3 class="card-title">{{ __('Transactions List') }}</h3>
                </div>
                <div class="card-body table-responsive tableContent">
                    <table class="table table-dark table-bordered table-striped table-dark data_table">
                        <thead>
                            <tr>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Old Balance') }}</th>
                                <th>{{ __('Current Balance') }}</th>
                                <th>{{ __('Date') }}</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
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
        });
    </script>
    <script>
        $(document).ready(function() {

            // Date range picker
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

            // Search Button Click
            $('#searchBtn').on('click', function() {
                let username = $('#username').val();

                // Runtime validation
                if (!username) {
                    $('#usernameError').removeClass('d-none');
                    return;
                } else {
                    $('#usernameError').addClass('d-none');
                }

                fetchTransactions();
            });

            function fetchTransactions() {
                $.ajax({
                    url: "{{ route('admin.transaction.search') }}",
                    method: "POST",
                    data: $('#searchForm').serialize(),
                    beforeSend: function() {
                        $('#tbody').html(
                            '<tr><td colspan="6" class="text-center">Loading...</td></tr>');
                    },
                    success: function(res) {
                        let rows = '';
                        if (res.transactions.length > 0) {
                            res.transactions.forEach(function(tx) {
                                rows += `
                            <tr>
                                <td>${tx.description ?? ''}</td>
                                <td>${tx.type ?? ''}</td>
                                <td>${tx.amount ?? ''}</td>
                                <td>${tx.balance_before ?? ''}</td>
                                <td>${tx.balance_after ?? ''}</td>
                                <td>${tx.created_at ? moment(tx.created_at).format('DD MMM YYYY HH:mm') : ''}</td>
                            </tr>
                        `;
                            });
                        } else {
                            rows =
                                `<tr><td colspan="6" class="text-center">No Transactions Found</td></tr>`;
                        }
                        $('#tbody').html(rows);
                    }
                });
            }
        });
    </script>

@endsection
