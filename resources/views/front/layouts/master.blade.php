<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('front.partials.head')

<body>

    @include('front.partials.header')
    @auth


        @php
            $pendingInvestments = \App\Models\Investment::where('status', 'pending')
                ->where('user_id', auth()->id())
                ->count();
        @endphp

        <section class="cta padding-top bg-color">
            <div class="container">

                @if ($announcements->count() > 0)
                    <marquee behavior="scroll" direction="left" scrollamount="5" class="custom-marquee">
                        @foreach ($announcements as $announcement)
                            <span><b class="text-warning">{{ $announcement->title }}: </b>
                                {!! $announcement->message !!}
                                @if (isset($announcement->link_url, $announcement->link_text))
                                    (  <a target="_blank" href="{{ $announcement->link_url }}"
                                        class="announcement-link text-white">{{ $announcement->link_text }}</a> )
                                @endif
                            </span>
                        @endforeach
                    </marquee>
                @endif


                @if ($pendingInvestments > 0)
                    <div class="cta__wrapper mb-2">
                        <div class="cta__newsletter justify-content-center">
                            <div class="cta__newsletter-inner aos-init aos-animate p-3 m-0 w-100">
                                <div class="cta__subscribe text-white">
                                    Your {{ $pendingInvestments }} pending investment(s) are awaiting approval. <a
                                        href="{{ route('front.deposit.history') }}"
                                        class="text-white text-decoration-underline">Click here</a> to see.
                                </div>
                            </div>
                        </div>
                    </div>
                @endif



            </div>
        </section>
    @endauth

    @yield('content')

    @include('front.partials.footer')

    <a href="#" class="scrollToTop scrollToTop--home1"><i class="fa-solid fa-arrow-up-from-bracket"></i></a>

    @include('front.partials.scripts')

</body>

</html>
