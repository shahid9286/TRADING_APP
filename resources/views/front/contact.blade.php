@extends('front.layouts.master')
@section('title', 'Contact Us')

@section('content')

    <!-- main-slider-end -->
    <section class="page-header">
        {{-- <div class="page-header__bg">
            <img src="{{ asset('assets/core/BreadCrumb.png') }}" alt="">
        </div> --}}
        <!-- /.page-header__bg -->
        {{-- <div class="container">
            <h2 class="page-header__title bw-split-in-left">Contact Us</h2>
            <ul class="careox-breadcrumb list-unstyled">
                <li><a href="{{ route('front.index') }}">Home</a></li>
                <li><span>Contact Us</span></li>
            </ul><!-- /.thm-breadcrumb list-unstyled -->
        </div><!-- /.container --> --}}
    </section><!-- /.page-header -->

<section class="contact-section py-5" style="background-color: #f9fbfe;">
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-lg-8 col-md-10 mx-auto">
                
                {{-- Notification --}}
                @if(session('notification'))
                    <div class="alert alert-{{ session('notification.alert') }} alert-dismissible fade show" role="alert">
                        {{ session('notification.message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        
                        <h4 class="mb-4 fw-bold text-primary text-center">Get in Touch</h4>
                        <p class="text-center text-muted fs-5">
                            Have a question or want to support our mission? Reach out — we’re here to help and always happy to connect.
                        </p>

                        <form id="contactform" method="POST" action="{{ route('front.contact.store') }}" novalidate>
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       placeholder="Your full name" 
                                       value="{{ old('name') }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       placeholder="you@example.com" 
                                       value="{{ old('email') }}" 
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone_no" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" 
                                       class="form-control @error('phone_no') is-invalid @enderror" 
                                       id="phone_no" 
                                       name="phone_no" 
                                       placeholder="+1 234 567 8900" 
                                       value="{{ old('phone_no') }}" 
                                       required>
                                @error('phone_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('subject') is-invalid @enderror" 
                                       id="subject" 
                                       name="subject" 
                                       placeholder="Subject" 
                                       value="{{ old('subject') }}" 
                                       required>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="enquiry_message" class="form-label">Message <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('enquiry_message') is-invalid @enderror" 
                                          id="enquiry_message" 
                                          name="enquiry_message" 
                                          rows="5" 
                                          placeholder="Write your message here..." 
                                          required>{{ old('enquiry_message') }}</textarea>
                                @error('enquiry_message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                <button type="submit" class="trk-btn trk-btn--border trk-btn--primary mt-4 d-block">contact us
                  now</button>
                        </form>

                    </div>
                </div>

            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>
@endsection
