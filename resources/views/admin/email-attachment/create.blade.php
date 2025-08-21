@extends('admin.layouts.master')
@section('content')
<div class="container">
    <h2>Add Email Attachment</h2>

    <form action="{{ route('email-attachments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="template_id">Email Template</label>
            <select name="template_id" class="form-control" required>
                <option value="">Select Template</option>
                @foreach($templates as $template)
                    <option value="{{ $template->id }}">{{ $template->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="file">Attachment File</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Upload</button>
    </form>
</div>
@endsection
