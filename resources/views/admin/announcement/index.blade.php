@extends('admin.layouts.master')
@section('title', 'Announcement List')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline mt-3">
                        <div class="card-header">
                            <h3 class="card-title mt-1"><b>{{ __('List of Announcements') }}</b></h3>
                            <div class="card-tools d-flex">
                                <a href="{{ route('admin.announcement.add') }}" class="btn btn-primary btn-sm mx-1">
                                    <i class="fas fa-plus"></i> {{ __('Add Announcement') }}
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="tableContent">
                                <table class="table table-striped table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>{{ __('#') }}</th>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Link Text') }}</th>
                                            <th>{{ __('Order No') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($announcements as $announcement)
                                            <tr>
                                                <td class="text-center">{{ $announcement->id }}</td>

                                                <td>
                                                    {{ $announcement->title }}

                                                </td>
                                                <td>
                                                    {{ $announcement->link_text }}
                                                </td>

                                                <td>{{ $announcement->order_no }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $announcement->status == 'active' ? 'success' : 'danger' }}">
                                                        @if ($announcement->status == 'active')
                                                            <i class="fas fa-check-circle"></i>
                                                        @else
                                                            <i class="fas fa-times-circle"></i>
                                                        @endif
                                                        {{ ucfirst($announcement->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('admin.announcement.edit', $announcement->id) }}"
                                                            class="btn btn-info btn-sm mx-1">
                                                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                                        </a>

                                                        <form id="deleteform" class="d-inline-block"
                                                            action="{{ route('admin.announcement.delete', $announcement->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                id="delete">
                                                                <i class="fas fa-trash"></i>{{ __('Delete') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No announcements found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
