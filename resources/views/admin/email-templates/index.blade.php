
@extends('admin.layouts.master')
@section('title', 'Email Templates')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline mt-3">
                        <div class="card-header">
                            <h3 class="card-title"><b>{{ __('Email Templates') }}</b></h3>
                            <a href="{{ route('admin.email-templates.add') }}" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> {{ __('Add New Email Template') }}</a>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table table-dark table-bordered table-striped data_table" style="width: 100%; table-layout: auto;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Subject</th>
                                        <th style="white-space: nowrap; width: 10% ;">Status</th>
                                        <th>Updated At</th>
                                        
                                        <th style="white-space: nowrap; width: 30% ;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($templates as $template)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $template->title }}</td>
                                            <td>{{ $template->subject }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-{{ $template->status === 'active' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($template->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $template->updated_at->format('d M Y') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.email-templates.show', $template->id) }}" class="btn btn-sm btn-warning"> <i class="fas fa-eye"></i>Details</a>

                                                <a href="{{ route('admin.email-templates.edit', $template->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i>Edit</a>

                                                <form action="{{ route('admin.email-templates.delete', $template->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this template?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i>Delete</button>
                                                </form>
                                                
                                                

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No templates found.</td>
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
