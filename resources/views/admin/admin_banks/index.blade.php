@extends('admin.layouts.master')
@section('title', 'All Banks')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">{{ __('Bank List') }}</h3>
                        <div class="card-tools d-flex">
                            <a href="{{ route('admin.admin_banks.add') }}" class="btn btn-sm btn-primary">
    <i class="fas fa-plus"></i> {{ __('Add New Bank') }}
</a>

                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-sm table-striped table-bordered data_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Account No</th>
                                    <th>Status</th>
                                    <th>Order No</th>
                                    <th>Notes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($banks as $id => $bank)
                                    <tr>
                                        <td>{{ ++$id }}</td>
                                        <td>{{ $bank->name }}</td>
                                        <td>{{ $bank->account_no }}</td>
                                        <td>
                                            @if ($bank->status == 'active')
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $bank->order_no }}</td>
                                        <td>{{ $bank->notes ?? '-' }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.admin_banks.edit', $bank->id) }}" 
                                                   class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.admin_banks.delete', $bank->id) }}" 
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
                                        <td colspan="7" class="text-center">No banks found.</td>
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
