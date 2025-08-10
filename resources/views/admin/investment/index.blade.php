@extends('admin.layouts.master')
@section('title', 'Investment List')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-gift"></i> {{ __('Investments List') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-home"></i> {{ __('Home') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item">{{ __('Investments') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Investment List') }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.investment.add') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> {{ __('Add Investment') }}
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Amount') }}</th>
                                {{-- <th>{{ __('Investor') }}</th> --}}
                                {{-- <th>{{ __('Status') }}</th> --}}
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($investments as $investment)
                                <tr>
                                    <td>{{ $investment->id }}</td>
                                                                        <td>
                                        @if ($investment->screenshot)
                                            <img src="{{ $investment->screenshot }}" alt="Investment"
                                                width="50" height="50">
                                        @endif
                                    </td>

                                    <td>{{ $investment->amount }}</td>
                                    {{-- <td>{{ $investment->reward_title }}</td>
                                    <td>
                                        @if ($investment->status === 'active')
                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                        @elseif($reward->status === 'expired')
                                            <span class="badge badge-danger">{{ __('Expired') }}</span>
                                        @else
                                            <span class="badge badge-secondary">{{ __('Inactive') }}</span>
                                        @endif
                                    </td> --}}
                                    <td>
                                        <a href="{{ route('admin.investment.edit', $investment->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                                <form id="deleteform" class="d-inline-block"
                                                    action="{{ route('admin.investment.delete', $investment->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                                        <i class="fas fa-trash"></i>{{ __('') }}
                                                    </button>
                                                </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13" class="text-center">{{ __('No investment found.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
