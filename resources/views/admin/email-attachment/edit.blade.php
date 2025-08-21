@extends('admin.layouts.master')
@section('content')
<div class="container">
    <h2>Edit Email Attachment</h2>

    <form action="{{ route('email-attachments.update', $emailAttachment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="template_id">Email Template</label>
            <select name="template_id" class="form-control" required>
                @foreach($templates as $template)
                    <option value="{{ $template->id }}" {{ $emailAttachment->template_id == $template->id ? 'selected' : '' }}>
                        {{ $template->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Current File: </label>
            <p>{{ $emailAttachment->file_name }} ({{ $emailAttachment->file_type }})</p>
        </div>

        <div class="mb-3">
            <label for="file">Replace File (optional)</label>
            <input type="file" name="file" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
