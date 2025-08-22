@extends('admin.layouts.master')
@section('title', 'Edit Email Template')

@section('content')
    <section class="content">
        <div class="container-fluid ">
           <div class="row">
                <div class="col-lg-8">
                    <div class="card card-primary card-outline mt-3">
                        <div class="card-header ">
                            <h3 class="card-title"><b>{{ __('Edit Email Template') }}</b></h3>
                            <div class="card-tools d-flex">
                                <a href="{{ route('admin.email-templates.index') }}" class="btn btn-sm btn-primary mx-1">
                                    <i class="bi bi-envelope-paper"></i> {{ __('Email Templates List') }}
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.email-templates.update', $template->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                {{-- Title --}}
                                <div class="form-group">
                                    <label for="title">{{ __('Template Title') }} <span class="text-danger">*</span></label>
                                    <input type="text" id="title" name="title" class="form-control"
                                        value="{{ old('title', $template->title) }}" required>
                                </div>

                                {{-- Subject --}}
                                <div class="form-group">
                                    <label for="subject">{{ __('Email Subject') }} <span class="text-danger">*</span></label>
                                    <input type="text" id="subject" name="subject" class="form-control"
                                        value="{{ old('subject', $template->subject) }}" required>
                                </div>

                                {{-- Body --}}
                                <div class="form-group">
                                    <label for="body">{{ __('Email Body') }} <span class="text-danger">*</span></label>
                                    <textarea id="body" name="body" rows="6" class="form-control"
                                        placeholder="Use placeholders like @{{name}}, @{{amount}}, etc.">{{ old('body', $template->body) }}</textarea>
                                </div>

                                {{-- Status --}}
                                <div class="form-group">
                                    <label for="status">{{ __('Status') }}</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="draft" {{ old('status', $template->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="active" {{ old('status', $template->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success">{{ __('Update Email Template') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-success card-outline mt-3">
                        <div class="card-header">
                            <h3 class="card-title mt-1"><b>{{ __('Notes') }}</b></h3>
                        </div>
                        @verbatim
                        <div class="card-body">
                            <p>You can use the following placeholders in the body of your email template:</p>
                            <ul>
                                <li><code>{{ donor_name }}</code> – Donor's Name</li>
                                <li><code>{{ donor_email }}</code> – Donor's Email</li>
                                <li><code>{{ donor_phone }}</code> – Donor's Phone No</li>
                                <li><code>{{ donor_city }}</code> – Donor's City</li>
                                <li><code>{{ donor_whatsapp }}</code> – Donor's Whatsapp</li>
                            </ul>
                            <p>These will be automatically replaced with actual donor information when the email is sent.</p>
                        </div>
                        @endverbatim

                    </div>
                </div>
           </div>
        </div>
    </section>
@endsection
