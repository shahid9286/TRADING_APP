@extends('admin.layouts.master')
@section('content')
<div class="container">
    <h2>Email Attachments</h2>
    <a href="{{ route('email-attachments.create') }}" class="btn btn-primary mb-3">Add New Attachment</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-dark data_table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Template</th>
                <th>File Name</th>
                <th>File Type</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attachments as $attachment)
                <tr>
                    <td>{{ $attachment->id }}</td>
                    <td>{{ $attachment->template->title ?? 'N/A' }}</td>
                    <td>{{ $attachment->file_name }}</td>
                    <td>{{ $attachment->file_type }}</td>
                    <td>{{ $attachment->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('email-attachments.edit', $attachment->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
