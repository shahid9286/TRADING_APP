<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

@include('front.partials.head')

<body>

    @include('front.partials.header')

    @yield('content')

    @include('front.partials.footer')

    <a href="#" class="scrollToTop scrollToTop--home1"><i class="fa-solid fa-arrow-up-from-bracket"></i></a>

    @include('front.partials.scripts')
    
</body>

</html>
