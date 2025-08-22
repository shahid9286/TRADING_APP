    @extends('admin.layouts.master')
    @section('title', 'Add Email Template')

    @section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-primary card-outline mt-3">
                        <div class="card-header">
                            <h3 class="card-title mt-1"><b>{{ __('Add Email Template') }}</b></h3>
                            <div class="card-tools d-flex">
                                <a href="{{ route('admin.email-templates.index') }}" class="btn btn-primary btn-sm mx-1">
                                    <i class="bi bi-envelope-paper"></i> {{ __('Email Templates List') }}
                                </a>
                            </div>
                        </div>

                        <form class="form-horizontal" action="{{ route('admin.email-templates.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                {{-- Title --}}
                                <div class="form-group">
                                    <label for="title">{{ __('Template Title') }} <span class="text-danger">*</span></label>
                                    <input type="text" id="title" name="title" class="form-control form-control-sm"
                                        value="{{ old('title') }}" placeholder="{{ __('Enter Your Title') }}">
                                    @if ($errors->has('title'))
                                        <small class="text-danger">{{ $errors->first('title') }}</small>
                                    @endif
                                </div>

                                {{-- Subject --}}
                                <div class="form-group">
                                    <label for="subject">{{ __('Email Subject') }} <span class="text-danger">*</span></label>
                                    <input type="text" id="subject" name="subject" class="form-control form-control-sm"
                                        value="{{ old('subject') }}" placeholder="{{ __('Enter Your Subject') }}">
                                    @if ($errors->has('subject'))
                                        <small class="text-danger">{{ $errors->first('subject') }}</small>
                                    @endif
                                </div>

                                {{-- Body --}}
                                <div class="form-group">
                                    <label for="body">{{ __('Email Body') }} <span class="text-danger">*</span></label>
                                    <textarea id="body" name="body" rows="6" class="form-control form-control-sm summernote"
                                        placeholder="{{ __('enter text') }}">{{ old('body') }}
                                    </textarea>

                                    @if ($errors->has('body'))
                                        <small class="text-danger">{{ $errors->first('body') }}</small>
                                    @endif
                                </div>

                                {{-- Status --}}
                                <div class="form-group">
                                    <label for="status">{{ __('Status') }} <span class="text-danger">*</span></label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <small class="text-danger">{{ $errors->first('status') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-sm btn-primary">{{ __('Save Email Template') }}</button>
                            </div>
                        </form>
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
