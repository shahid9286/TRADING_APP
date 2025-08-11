@extends('admin.layouts.master')
@section('title', 'User Banks')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mt-2">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('User Bank List') }}</h3>
                            <div class="card-tools d-flex">
                                <a href="{{ route('admin.user-banks.add') }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus"></i> {{ __('Add New User Bank') }}
                                </a>

                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-sm table-striped table-bordered data_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Users</th>
                                        <th>Bank Name</th>
                                        <th>Account No</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($user_banks as $id => $user_bank)
                                        <tr>
                                            <td>{{ ++$id }}</td>
                                            <td>{{ $user_bank->user->name }}</td>
                                            <td>{{ $user_bank->bank_name }}</td>
                                            <td>{{ $user_bank->account_no }}</td>

                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.user-banks.edit', $user_bank->id) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.user-banks.delete', $user_bank->id) }}"
                                                        method="post" class="d-inline-block">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No user banks found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
