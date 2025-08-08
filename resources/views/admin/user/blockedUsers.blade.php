@extends('admin.layouts.master')
@section('title', 'Blocked Users')

@section('content')

    <div class="content-header">
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12 mt-2">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title mt-1">{{ __('Blocked User List') }}</h3>
                                <div class="card-tools d-flex">
                                    <a href="{{ route('admin.user.add') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> {{ __('Add New User ') }}
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-striped table-bordered data_table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Image</th>
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
                                                    <img class="w-80"
                                                        src="{{ asset('admin/user/profile/' . $user->icon) }}"
                                                        alt="">
                                                </td>
                                                <td>
                                                    <a href="#">{{ $user->name }} </a>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone_no }}</td>
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
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success">Action</button>
                                                        <button type="button"
                                                            class="btn btn-success dropdown-toggle dropdown-hover dropdown-icon"
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
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.user.edit', $user->id) }}">Edit
                                                                User</a>
                                                        </div>
                                                    </div>
                                                    <form id="deleteform" class="deleteform d-inline-block"
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
                                                    </form>
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
    </div>
    @endsection
