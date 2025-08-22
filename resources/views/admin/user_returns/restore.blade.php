@extends('admin.layouts.master')
@section('title', 'Restore User Return')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Restore User Return') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                    class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">{{ __('Restore User Return') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-striped table-bordered table-dark data_table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('#') }}</th>
                                            <th>{{ __('User') }}</th>
                                            <th>{{ __('Investment') }}</th>
                                            <th>{{ __('Entry Date ') }}</th>
                                            <th>{{ __('Amount') }}</th>

                                            <th>{{ __('Action') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($returns as $index => $return)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $return->user->name ?? 'N/A' }}</td>
                                                <td>
                                                    {{ $return->investment->id ?? 'N/A' }}
                                                    - {{ $return->investment->amount ?? '' }}
                                                </td>
                                                <td>{{ $return->entry_date ?? 'N/A' }}</td>
                                                <td>{{ number_format($return->amount, 2) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.user_returns.restore', $return->id) }}"
                                                        class="btn btn-info btn-sm"><i class="fas fa-undo"></i>
                                                        {{ __('') }}</a>


                                                    <form id="deleteform" class="d-inline-block"
                                                        action="{{ route('admin.user_returns.force.delete', $return->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                                            <i class="fas fa-trash"></i>{{ __('') }}
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
        </div>
        <!-- /.row -->

    </section>
@endsection
