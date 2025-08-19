@extends('admin.layouts.master')
@section('title', 'Approved Users')

@section('content')

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12 mt-2">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('Approved User List') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-sm table-striped table-bordered data_table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $id => $user)
                                        <tr>
                                            <td>
                                                {{ ++$id }}
                                            </td>
                                            <td>
                                                <a href="#">{{ $user->profile->first_name . ' ' . $user->profile->last_name }}
                                                </a>
                                                <span class="badge bg-info">{{ $user->user_type }}</span>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
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
                                                        <div class="dropdown-menu" role="menu" style="">
                                                            <form
                                                                action="{{ route('admin.user.makeapprovedUser', $user->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item">Approve
                                                                    User</button>
                                                            </form>
                                                            <form
                                                                action="{{ route('admin.user.makependingUser', $user->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item">Pending
                                                                    User</button>
                                                            </form>
                                                            <form
                                                                action="{{ route('admin.user.makeblockedUser', $user->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item">Block
                                                                    User</button>
                                                            </form>
                                                            {{-- <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.user.edit', $user->id) }}">Edit
                                                                User</a> --}}
                                                        </div>
                                                    </div>
                                                    <a href="{{ route('admin.user.detail', $user->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i> Detail</a>
                                                    {{-- <form id="deleteform" class="deleteform d-inline-block"
                                                        action="{{ route('admin.user.delete', $user->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm deletebtn"
                                                            id="delete">
                                                            <span class="btn-label">
                                                                <i class="fas fa-trash"></i>
                                                            </span>
                                                            Delete
                                                        </button>
                                                    </form> --}}
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
        <!-- /.row -->
    </section>
@endsection
