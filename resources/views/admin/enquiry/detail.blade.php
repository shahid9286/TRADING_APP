@extends('admin.layouts.master')
@section('title', 'Enquiry')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Enquiry') }} </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                    class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">{{ __('Enquiry') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Print styles */
        @media print {
            .enquiry-card {
                border-top: 3px solid #000;
                /* Add a top border */
                border-bottom: 3px solid #000;
                /* Add a bottom border */
                padding-top: 10px;
                padding-bottom: 10px;
            }
        }
        label.error {
    color: #dc3545; /* Bootstrap's red color for danger messages */
    font-size: 0.9em; /* Optional: adjust font size */
    margin-top: 5px; /* Optional: space between input and error message */
}
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary card-outline enquiry-card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title mt-1">{{ __('Enquiry Details') }}</h3>
                        </div>
                        <div class="card-body">
                            <!-- Name -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label font-weight-bold">{{ __('Name:') }}</label>
                                <div class="col-sm-9">
                                    <p class="form-control-plaintext">{{ $enquiry->name }}</p>
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label font-weight-bold">{{ __('Email:') }}</label>
                                <div class="col-sm-9">
                                    <p class="form-control-plaintext">{{ $enquiry->email }}</p>
                                </div>
                            </div>
                            <!-- Phone Number -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label font-weight-bold">{{ __('Phone No:') }}</label>
                                <div class="col-sm-9">
                                    <p class="form-control-plaintext">{{ $enquiry->phone_no }}</p>
                                </div>
                            </div>
                            <!-- Subject -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label font-weight-bold">{{ __('Subject:') }}</label>
                                <div class="col-sm-9">
                                    <p class="form-control-plaintext">
                                        {{ $enquiry->subject == '' ? 'N/A' : $enquiry->subject }}</p>
                                </div>
                            </div>
                            <!-- Status -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label font-weight-bold">{{ __('Status:') }}</label>
                                <div class="col-sm-9">
                                    @if ($enquiry->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($enquiry->status == 'follow-up')
                                        <span class="badge bg-info">Follow Up</span>
                                    @elseif($enquiry->status == 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @endif
                                </div>
                            </div>
                            <!-- Enquiry Message -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-3 col-form-label font-weight-bold">{{ __('Message:') }}</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="4" readonly>{{ $enquiry->enquiry_message }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-warning">
                        <div class="card-header text-white">
                            <h3 class="card-title mt-1">{{ __('Enquiry') }}</h3>
                        </div>
                        <div class="card-body">

                            <form id="commentForm" action="{{ route('admin.enquiry.comment.store', $enquiry->id) }}"
                                method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="comment" class="col-sm-12 control-label">{{ __('Comment') }}</label>
                                    <div class="col-sm-12">
                                        <textarea id="comment" class="form-control" name="comment" rows="3" placeholder="{{ __('Enter Comment') }}">{{ old('comment') }}</textarea>
                                        @error('comment')
                                            <p class="text-danger"> {{ $message }} </p>
                                        @enderror
                                        <!-- Error message will be displayed here by jQuery Validation -->
                                    </div>
                                </div>

                                <div class="form-group row justify-content-end">
                                    <button type="submit"
                                        class="col-sm-2 mr-sm-2 btn btn-primary btn-sm">{{ __('Save') }}</button>
                                </div>
                            </form>

                            <div class="d-flex">
                                <div class="flex-grow-1 border-top my-4"></div>
                            </div>
                            <section class="content">
                                <div class="container-fluid">
                                    <div class="row">


                                        <div class="col-md-12">
                                            <div class="timeline">
                                                @php
                                                    $lastDate = null;
                                                @endphp

                                                @foreach ($enquiry->enquiryComments->sortBy('created_at') as $comment)
                                                    @php
                                                        $commentDate = $comment->created_at->format('d M. Y');
                                                    @endphp

                                                    <!-- Display the date label if it's different from the last displayed date -->
                                                    @if ($lastDate !== $commentDate)
                                                        <div class="time-label">
                                                            <span class="bg-success">{{ $commentDate }}</span>
                                                        </div>
                                                        @php
                                                            $lastDate = $commentDate;
                                                        @endphp
                                                    @endif

                                                    <div>
                                                        <i class="fas fa-envelope bg-blue"></i>
                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fas fa-clock"></i>
                                                                {{ $comment->created_at->format('h:i A') }}</span>
                                                            <h3 class="timeline-header">
                                                                <span class="text-info">{{ $comment->user->name ?? 'Unknown User' }}</span>
                                                                
                                                            </h3>
                                                            <div class="timeline-body">
                                                                {{ $comment->comment }}
                                                            </div>
                                                            <div class="d-flex">
                                                              <div class="flex-grow-1 border-top"></div>
                                                          </div>
                                                            <div class="timeline-footer">
                                                                <a class="btn btn-danger btn-sm"
                                                                    href="{{ route('admin.enquiry.comment.delete', $comment->id) }}"><i class="fas fa-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <div>
                                                    <i class="fas fa-clock bg-gray"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.timeline -->

                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#commentForm').validate({
                rules: {
                    comment: {
                        required: true,
                        maxlength: 500
                    }
                },
                messages: {
                    comment: {
                        required: "Please enter a comment.",
                        maxlength: "The comment must not exceed 500 characters."
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "comment") {
                        error.insertAfter(element); // Place error directly after the textarea
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });
    </script>
@endsection
