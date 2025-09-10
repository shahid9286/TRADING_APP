@extends('admin.layouts.master')
@section('title', 'All Users')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mt-2">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('User List') }}</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-striped table-bordered table-dark data_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Total Balance</th>
                                        <th>Current Month Salary</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $id => $user)
                                        <tr>
                                            <td>{{ ++$id }}</td>
                                            <td>
                                                <a
                                                    href="#">{{ ($user->profile->first_name ?? '') . ' ' . ($user->profile->last_name ?? '') }}</a>
                                                <span class="badge bg-info">{{ $user->user_type }}</span>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->net_balance }}</td>
                                            <td>{{ $user->current_month_salary }}</td>
                                            <td>
                                                @if ($user->status == 'approved')
                                                    <span class="badge badge-success">Approved</span>
                                                @elseif ($user->status == 'pending')
                                                    <span class="badge badge-info">Pending</span>
                                                @elseif ($user->status == 'blocked')
                                                    <span class="badge badge-danger">Blocked</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->user_type !== 'superAdmin')
                                                    <div class="btn-group">
                                                        <button type="button"
                                                            class="btn btn-success btn-sm">Action</button>
                                                        <button type="button"
                                                            class="btn btn-success btn-sm dropdown-toggle dropdown-hover dropdown-icon"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu">
                                                            <!-- Approve / Block / Pending -->
                                                            <form
                                                                action="{{ route('admin.user.makeapprovedUser', $user->id) }}"
                                                                method="post">@csrf
                                                                <button type="submit" class="dropdown-item">Approve
                                                                    User</button>
                                                            </form>
                                                            <form
                                                                action="{{ route('admin.user.makependingUser', $user->id) }}"
                                                                method="post">@csrf
                                                                <button type="submit" class="dropdown-item">Pending
                                                                    User</button>
                                                            </form>
                                                            <form
                                                                action="{{ route('admin.user.makeblockedUser', $user->id) }}"
                                                                method="post">@csrf
                                                                <button type="submit" class="dropdown-item">Block
                                                                    User</button>
                                                            </form>
                                                            <div class="dropdown-divider"></div>

                                                            <!-- Change Password -->
                                                            <a href="javascript:void(0);"
                                                                class="dropdown-item change-password-btn"
                                                                data-user-id="{{ $user->id }}">
                                                                Change Password
                                                            </a>

                                                            <!-- Change Referral Name -->
                                                            <a href="javascript:void(0);"
                                                                class="dropdown-item change-referral-btn"
                                                                data-user-id="{{ $user->id }}"
                                                                data-username="{{ $user->username }}">
                                                                Change Referral Name
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <a href="{{ route('admin.user.detail', $user->id) }}"
                                                        class="btn btn-sm btn-info"><i class="bi bi-eye"></i> Detail</a>
                                                @else
                                                    <span class="badge bg-warning">No operations to perform!</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Change Password Modal -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Password</h5>
                        <button type="button" class="close text-white"
                            data-bs-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <form id="changePasswordForm">
                        @csrf
                        <input type="hidden" id="changePasswordUserId">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <div class="input-group">
                                    <input type="password" id="new_password" class="form-control"
                                        placeholder="Enter new password" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <small id="password-error" class="text-danger d-none"></small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="passwordSubmitBtn" class="btn btn-success">
                                Change
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Change Referral Modal -->
        <div class="modal fade" id="changeReferralModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Referral Name</h5>
                        <button type="button" class="close text-white"
                            data-bs-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <form id="changeReferralForm">
                        @csrf
                        <input type="hidden" id="changeReferralUserId">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="referral_name">Referral Name</label>
                                <input type="text" id="referral_name" class="form-control" required>
                                <small id="referral-error" class="text-danger d-none"></small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="referralSubmitBtn" class="btn btn-success">
                                Change
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('js')

    <script>
        $(function() {

            $('.change-password-btn').click(function() {
                $('#changePasswordUserId').val($(this).data('user-id'));
                $('#new_password').val('');
                $('#password-error').addClass('d-none').text('');
                $('#changePasswordModal').modal('show');
            });

            $(document).on('click', '.toggle-password', function() {
                let input = $('#new_password');
                let type = input.attr('type') === 'password' ? 'text' : 'password';
                input.attr('type', type);
                $(this).find('i').toggleClass('fa-eye fa-eye-slash');
            });

            $('#changePasswordForm').submit(function(e) {
                e.preventDefault();
                let btn = $('#passwordSubmitBtn');
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');

                $.post("{{ url('admin/change-password') }}/" + $('#changePasswordUserId').val(), {
                    _token: "{{ csrf_token() }}",
                    password: $('#new_password').val()
                }).done(function(res) {
                    $('#changePasswordModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message ?? 'Password updated!'
                    });
                }).fail(function(xhr) {
                    let err = xhr.responseJSON?.message ?? 'Something went wrong';
                    $('#password-error').removeClass('d-none').text(err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: err
                    });
                }).always(() => {
                    btn.prop('disabled', false).html('Change');
                });
            });

            // === Referral modal ===
            $('.change-referral-btn').click(function() {
                $('#changeReferralUserId').val($(this).data('user-id'));
                $('#referral_name').val($(this).data('username'));
                $('#referral-error').addClass('d-none').text('');
                $('#changeReferralModal').modal('show');
            });

            $('#changeReferralForm').submit(function(e) {
                e.preventDefault();
                let btn = $('#referralSubmitBtn');
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');

                $.post("{{ url('admin/change-referral') }}/" + $('#changeReferralUserId').val(), {
                    _token: "{{ csrf_token() }}",
                    referral_name: $('#referral_name').val()
                }).done(function(res) {
                    $('#changeReferralModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message ?? 'Referral updated!'
                    });
                }).fail(function(xhr) {
                    let err = xhr.responseJSON?.message ?? 'Something went wrong';
                    $('#referral-error').removeClass('d-none').text(err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: err
                    });
                }).always(() => {
                    btn.prop('disabled', false).html('Change');
                });
            });
        });
    </script>
@endsection
