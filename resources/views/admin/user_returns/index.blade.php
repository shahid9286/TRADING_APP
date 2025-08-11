@extends('admin.layouts.master')
@section('title', 'User Returns')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-dollar-sign"></i> {{ __('User Returns') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-home"></i> {{ __('Home') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item">{{ __('User Returns') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title mt-1">{{ __('All User Returns') }}</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.user_returns.add') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> {{ __('Add New') }}
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Investment</th>
                            <th>Amount</th>
                            <th>Entry Date</th>
                            <th>Type</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user_returns as $key => $ur)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $ur->user->name ?? 'N/A' }}</td>
                                <td>{{ $ur->investment->amount ?? 'N/A' }}</td>
                                <td>${{ number_format($ur->amount, 2) }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($ur->entry_date)->format('d M Y') }}
                </td>
                                <td><span class="badge badge-info">{{ $ur->type }}</span></td>
                                <td>
                                    <a href="{{ route('admin.user_returns.edit', $ur->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                <form id="deleteform" class="d-inline-block"
                                                    action="{{ route('admin.user_returns.delete', $ur->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                                        <i class="fas fa-trash"></i>{{ __('') }}
                                                    </button>
                                                </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($user_returns->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center">{{ __('No records found') }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
