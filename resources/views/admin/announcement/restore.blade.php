@extends('admin.layouts.master')
@section('title', 'Restore Announcement')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline mt-3">
                        <div class="card-header">
                            <h3 class="card-title mt-1"><b>{{ __('Restore Announcement') }}</b></h3>

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
                                                    <a href="{{ route('admin.announcement.restore', $announcement->id) }}"
                                                        class="btn btn-info btn-sm"><i class="fas fa-undo"></i>
                                                        {{ __('Restore') }}</a>


                                                    <form id="deleteform" class="d-inline-block"
                                                        action="{{ route('admin.announcement.force.delete', $announcement->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm" id="delete">
                                                            <i class="fas fa-trash"></i>{{ __('Delete') }}
                                                        </button>
                                                    </form>

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
