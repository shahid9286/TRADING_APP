@extends('admin.layouts.master')
@section('title', 'Restore Reward')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Restore Reward') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                    class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">{{ __('Restore Reward') }}</li>
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
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Reward Title') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($rewards as $reward)
                                            <tr>
                                                <td>{{ $reward->id }}</td>
                                                <td>{{ $reward->title }}</td>
                                                <td>{{ $reward->reward_title }}</td>
                                                <td>
                                                    @if ($reward->status === 'active')
                                                        <span class="badge badge-success">{{ __('Active') }}</span>
                                                    @elseif($reward->status === 'expired')
                                                        <span class="badge badge-danger">{{ __('Expired') }}</span>
                                                    @else
                                                        <span class="badge badge-secondary">{{ __('Inactive') }}</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('admin.reward.restore', $reward->id) }}"
                                                        class="btn btn-info btn-sm"><i class="fas fa-undo"></i>
                                                        {{ __('') }}</a>


                                                    <form id="deleteform" class="d-inline-block"
                                                        action="{{ route('admin.reward.force.delete', $reward->id) }}"
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
