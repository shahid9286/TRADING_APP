@extends('front.layouts.master')
@section('title', 'Contact Us')
@section('content')
    <section class="account padding-top padding-bottom sec-bg-color2">
        <div class="container">
            <div class="account__wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="account__content account__content--style1">

                            <!-- Laravel Login Form -->
                            <h3 class="mb-2 fw-bold text-center">Get in Touch</h3>
                            <p class="text-center text-muted fs-5">
                                Have a question or want to support our mission? Reach out — we’re here to help and always
                                happy to connect.
                            </p>

                            <form id="contactform" method="POST" action="{{ route('front.contact.store') }}" novalidate>
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Your Full Name *"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="email@example.com *"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="phone_no" class="form-label">Phone Number <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('phone_no') is-invalid @enderror"
                                        id="phone_no" name="phone_no" placeholder="+1 234 567 8900 *"
                                        value="{{ old('phone_no') }}" required>
                                    @error('phone_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                        id="subject" name="subject" placeholder="Subject *" value="{{ old('subject') }}"
                                        required>
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="enquiry_message" class="form-label">Message <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control @error('enquiry_message') is-invalid @enderror" id="enquiry_message"
                                        name="enquiry_message" rows="5" placeholder="Write your message here... *" required>{{ old('enquiry_message') }}</textarea>
                                    @error('enquiry_message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="trk-btn trk-btn--border trk-btn--primary mt-4 d-block">contact
                                    us
                                    now</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#contactform').on('submit', function(e) {
                e.preventDefault();
                var notyf = new Notyf({
                    duration: 4000,
                    position: {
                        x: 'right',
                        y: 'top'
                    }
                });

                let form = $(this);
                let formData = form.serialize();

                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.invalid-feedback').remove();

                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: formData,
                    success: function(response) {
                        notyf.success('Enquiry Submitted Successfully!');
                        form[0].reset();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                let input = form.find('[name="' + key + '"]');
                                input.addClass('is-invalid');
                                input.after('<div class="invalid-feedback">' + value[
                                    0] + '</div>');
                            });
                        } else {
                            notyf.error('Something went wrong, please try again!');
                        }
                    }
                });
            });
        });
    </script>

@endsection
