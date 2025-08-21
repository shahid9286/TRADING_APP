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
              <p class="mb-0">
                We are a cutting-edge trading platform dedicated to empowering individuals worldwide to take control of their financial future. Our mission is to provide easy access to diverse markets with advanced tools, seamless execution, and transparent services.
              </p>
              <a href="about.html" class="trk-btn trk-btn--border trk-btn--primary">Explore More</a>
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
                  <h6>Our mission is to empower individuals worldwide to trade smarter and earn more through our innovative trading platform combined with affiliate marketing</h6>
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
                          <h6>Trade multiple markets with advanced tools and insights</h6>
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
                          <h6>Comprehensive analytics to track your trades and earnings</h6>
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
                <h6>
                  Our vision is to become the leading platform in trading and affiliate marketing, empowering users
                  worldwide with cutting-edge technology, reliable service, and outstanding support to achieve
                  financial freedom.
                </h6>
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
