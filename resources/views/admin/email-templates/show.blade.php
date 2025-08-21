@extends('admin.layouts.master')
@section('title', 'Email Template Details')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline mt-3">
                        <div class="card-header">
                            <h3 class="card-title mt-1"><b>{{ __('Email Template Details') }}</b></h3>
                            <div class="card-tools d-flex">
                                <a href="{{ route('admin.email-templates.index') }}" class="btn btn-primary btn-sm mx-1">
                                    <i class="bi bi-envelope-paper"></i> {{ __('Email Templates List') }}
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            {{-- Title --}}
                            <div class="form-group">
                                <label>{{ __('Template Title') }}:</label>
                                <div class="border p-2 rounded bg-light">
                                    <p class="form-control-plaintext">{{ $template->title }}</p>
                                </div>
                            </div>

                            {{-- Subject --}}
                            <div class="form-group">
                                <label>{{ __('Email Subject') }}:</label>
                                <div class="border p-2 rounded bg-light">
                                    <p class="form-control-plaintext">{{ $template->subject }}</p>
                                </div>
                            </div>

                            {{-- Body --}}
                            <div class="form-group">
                                <label>{{ __('Email Body') }}:</label>
                                <div class="border p-2 rounded bg-light">
                                    {!! $template->body !!}
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="form-group">
                                <label>{{ __('Status') }}:</label>
                                <p class="form-control-plaintext text-capitalize">
                                    <span class="badge badge-{{ $template->status == 'active' ? 'success' : 'secondary' }}">
                                        {{ $template->status }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <a href="{{ route('admin.email-templates.edit', $template->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body pt-0">


        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-success card-outline ">
                        <div class="card-header">
                            <h3 class="card-title mt-1"><b>{{ __('Add New Attachment') }}</b></h3>
                        </div>

                        <form action="{{ route('admin.email-templates.upload.attachment') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="template_id" value="{{ $template->id }}">

                            <div class="card-body">
                                <div class="row">
                                    {{-- Attachment Title --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="file_name">{{ __('Attachment Title') }}</label>
                                            <input type="text" class="form-control" id="file_name" name="file_name"
                                                placeholder="Enter attachment title" required>
                                            @if ($errors->has('file_name'))
                                                <small class="text-danger">{{ $errors->first('file_name') }}</small>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Upload File --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="file_path">{{ __('Upload File') }}</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input up-img" name="file_path"
                                                        id="file_path">
                                                <label class="custom-file-label" for="file_path">Choose file</label>
                                                @if ($errors->has('file_path'))
                                                    <small class="text-danger">{{ $errors->first('file_path') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Save Button --}}
                                    <div class="col-md-2 d-flex align-items-end">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-sm p-2 px-3">
                                                <i class="fas fa-save"></i> {{ __('Save Attachment') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>



        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline mt-3">
                        <div class="card-header">
                            <h3 class="card-title mt-1"><b>{{ __('List of Attachments') }}</b></h3>
                            <div class="card-tools d-flex">
                                <a href="{{ route('admin.email-templates.index') }}" class="btn btn-primary btn-sm mx-1">
                                    <i class="bi bi-envelope-paper"></i> {{ __('Email Templates List') }}
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm mt-2">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width: 50px;">#</th>
                                            <th>Title</th>
                                            <th style="white-space: nowrap; width: 10% ;">View File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($template->attachments as $attachment)
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $attachment->file_name }}</td>
                                                <td class="text-center">
                                                    <a href="{{ asset($attachment->file_path) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <a href="{{ route('admin.email-templates.edit', $template->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
