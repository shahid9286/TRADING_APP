@extends('front.layouts.master')
@section('title', 'Contact Us')

@section('content')

    <!-- main-slider-end -->
    <section class="page-header">
        <div class="page-header__bg">
            <img src="{{ asset('assets/core/BreadCrumb.png') }}" alt="">
        </div>
        <!-- /.page-header__bg -->
        <div class="container">
            <h2 class="page-header__title bw-split-in-left">Contact Us</h2>
            <ul class="careox-breadcrumb list-unstyled">
                <li><a href="{{ route('front.index') }}">Home</a></li>
                <li><span>Contact Us</span></li>
            </ul><!-- /.thm-breadcrumb list-unstyled -->
        </div><!-- /.container -->
    </section><!-- /.page-header -->

    <section class="contact-one contact-one--page service-two" style="background-color: #F9FBFE !important;">
        <div class="contact-one__shape" style="background-image: url(assets/images/contact/2.png);"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                </div>
                <div class="col-lg-7">

                    {{-- Success message --}}
@if(session('notification'))
  <div class="alert alert-{{ session('notification.alert') }} alert-dismissible fade show" role="alert">
    {{ session('notification.message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

                    <form id="contactform" method="POST" action="{{ route('front.contact.store') }}"
                          class="contact-one__form contact-form-validated form-one wow fadeInUp animated"
                          data-wow-duration="1500ms" novalidate>
                        @csrf

                        <h1 class="mt-4 text-black"> Let's Get in Touch with Us</h1>
                        <p class="contact_social text-black">
                            Have a question or want to support our mission? Reach out — we’re here to help and always happy to connect.
                        </p>

                        <div class="form-one__group">

                            <div class="col-12 mb-2">
                                <label for="name" class="form-label text-black">Name</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="name"
                                    name="name"
                                    placeholder="Full Name"
                                    value="{{ old('name') }}"
                                    required
                                >
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12 mb-2">
                                <label for="email" class="form-label text-black">Email</label>
                                <input
                                    class="form-control"
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="Email here"
                                    value="{{ old('email') }}"
                                    required
                                >
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mb-2">
  <label for="phone_no" class="form-label text-black">Phone Number</label>
  <input
      class="form-control"
      type="tel"
      id="phone_no"
      name="phone_no"
      placeholder="Phone Number"
      value="{{ old('phone_no') }}"
      required
  >
  @error('phone_no')
      <small class="text-danger">{{ $message }}</small>
  @enderror
</div>


                            <div class="col-12 mb-2">
                                <label for="subject" class="form-label text-black">Subject</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="subject"
                                    name="subject"
                                    placeholder="Subject here"
                                    value="{{ old('subject') }}"
                                    required
                                >
                                @error('subject')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12 mb-2">
                                <label for="enquiry_message" class="form-label text-black">Message</label>
                                <textarea
                                    cols="30"
                                    rows="5"
                                    class="form-control"
                                    id="enquiry_message"
                                    name="enquiry_message"
                                    placeholder="Enter Your Message"
                                    required
                                >{{ old('enquiry_message') }}</textarea>
                                @error('enquiry_message')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="trk-btn trk-btn--border trk-btn--primary mb-2 d-block">
                                Contact Us Now
                            </button>

                        </div><!-- /.form-one__group -->
                    </form>

                </div><!-- /.col-xl-7 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section>

@endsection
