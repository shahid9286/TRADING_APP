@extends('front.layouts.master')
@section('title', 'User Login')

@section('content')

<!-- ================== About Us Section ================== -->
<section class="about about--style1">
  <div class="container">
    <div class="mt-5"></div>
    <div class="about__wrapper">
      <div class="row gx-5 gy-4 gy-sm-0 align-items-center">

        <!-- Left Side: Image -->
        <div class="col-lg-6">
          <div class="about__thumb-image">
            <img src="{{ asset('assets/static/pic.jpg') }}" alt="Image Description" style="width:100%; height:auto;">
          </div>
        </div>

        <!-- Right Side: Paragraph -->
        <div class="col-lg-6">
          <div class="about__content" data-aos="fade-left" data-aos-duration="800">
            <div class="about__content-inner">
              <h2>about <span>us</span></h2>
              <p class="mb-3">At Safe Capital Pro, we believe in creating smarter and safer investment opportunities for individuals and businesses. Our platform is designed to provide transparent, reliable, and growth-driven investment solutions that help our clients achieve their financial goals with confidence. </p>
              <p class="mb-0">With a team of experienced professionals, we focus on offering innovative financial strategies, including direct investments, referral programs, and long-term wealth-building plans. Our priority is to ensure maximum returns while maintaining the highest level of security and trust. </p>
              <a href="{{ route('front.login.user')}}" class="trk-btn trk-btn--border trk-btn--primary">Sign Up Now</a>
            </div>
          </div>
        </div>

      </div> <!-- end row -->
    </div> <!-- end about__wrapper -->
  </div> <!-- end container -->
</section>
<!-- ================== End About Us Section ================== -->


<!-- ================== Missions Section ================== -->
<section class="feature feature--style1 padding-bottom padding-top bg-color">
  <div class="container">
    <div class="feature__wrapper">
      <div class="row g-5 align-items-center justify-content-between">

        <!-- Missions Text -->
        <div class="col-md-6 col-lg-5">
          <div class="feature__content" data-aos="fade-right" data-aos-duration="800">
            <div class="feature__content-inner">
              <div class="section-header">
                <h2 class="mb-15 mt-minus-5"> <span>our </span>missions</h2>
                <p class="mb-0">
                  <h6>At Safe Capital Pro, our mission is to make secure and smart investments accessible to everyone. We aim to empower individuals and businesses with reliable financial solutions, ensuring growth, transparency, and trust at every step.</h6>
                </p>
              </div>

              <!-- Missions Nav -->
              <div class="feature__nav">
                <div class="nav nav--feature flex-column nav-pills" id="feat-pills-tab" role="tablist" aria-orientation="vertical">

                  <!-- Tab 1 -->
                  <div class="nav-link active" id="feat-pills-one-tab" data-bs-toggle="pill"
                    data-bs-target="#feat-pills-one" role="tab" aria-controls="feat-pills-one" aria-selected="true">
                    <div class="feature__item">
                      <div class="feature__item-inner">
                        <div class="feature__item-content">
                          <h6>Building Financial Security for All</h6>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Tab 2 -->
                  <div class="nav-link" id="feat-pills-four-tab" data-bs-toggle="pill"
                    data-bs-target="#feat-pills-four" role="tab" aria-controls="feat-pills-four"
                    aria-selected="false">
                    <div class="feature__item">
                      <div class="feature__item-inner">
                        <div class="feature__item-content">
                          <h6>Innovating Investment Solutions with Integrity</h6>
                        </div>
                      </div>
                    </div>
                  </div>

                </div> <!-- end nav -->
              </div> <!-- end feature__nav -->

            </div>
          </div>
        </div>

        <!-- Missions Image -->
        <div class="col-md-6 col-lg-6">
          <div class="feature__thumb pt-5 pt-md-0" data-aos="fade-left" data-aos-duration="800">
            <div class="feature__thumb-inner">
              <div class="tab-content" id="feat-pills-tabContent">

                <!-- Tab Content 1 -->
                <div class="tab-pane fade show active" id="feat-pills-one" role="tabpanel"
                  aria-labelledby="feat-pills-one-tab" tabindex="0">
                  <div class="feature__image">
                    <img src="{{ asset('assets/static/1.jpg') }}" alt="Image Description" style="width:100%; height:auto;">
                  </div>
                </div>

                <!-- Tab Content 2 -->
                <div class="tab-pane fade" id="feat-pills-two" role="tabpanel" aria-labelledby="feat-pills-two-tab"
                  tabindex="0">
                  <!-- Empty for now -->
                </div>

              </div> <!-- end tab-content -->
            </div>
          </div>
        </div>

      </div> <!-- end row -->
    </div> <!-- end feature__wrapper -->
  </div> <!-- end container -->
</section>
<!-- ================== End Missions Section ================== -->


<!-- ================== Vision Section ================== -->
<section class="about about--style1">
  <div class="container">
    <div class="about__wrapper">
      <div class="row gx-5 gy-4 gy-sm-0 align-items-center">

        <!-- Left Side: Image -->
        <div class="col-lg-6">
          <div class="about__thumb-image">
            <img src="{{ asset('assets/static/mission.jpg') }}" alt="Image Description" style="width:100%; height:auto;">
          </div>
        </div>

        <!-- Right Side: Paragraph -->
        <div class="col-lg-6">
          <div class="about__content" data-aos="fade-left" data-aos-duration="800">
            <div class="about__content-inner">
              <h2><span>our</span> vissions</h2>
              <p class="mb-0">
                <h6> Our vision at Safe Capital Pro is to become a trusted leader in the investment industry by offering innovative and secure financial opportunities. We strive to create a platform where individuals and businesses can confidently grow their wealth through transparent and ethical investment practices. </h6>
              </p>
              <p class="mb-0">
                <h6> We aim to redefine financial success by combining advanced technology, market expertise, and client-focused strategies. Safe Capital Pro envisions a future where every investor, regardless of experience, can achieve sustainable growth and long-term financial stability.</h6>
              </p>
            </div>
          </div>
        </div>

      </div> <!-- end row -->
    </div> <!-- end about__wrapper -->
  </div> <!-- end container -->
</section>
<!-- ================== End Vision Section ================== -->

@endsection
