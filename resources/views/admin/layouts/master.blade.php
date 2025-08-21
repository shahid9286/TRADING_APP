<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | MHOW.org</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset($setting->fav_icon) }}" type="image/png">
    @includeif('admin.partials.styles')
</head>

<body @php
    use Illuminate\Support\Facades\Session; @endphp {{ Session::has('notification') ? 'data-notification' : '' }}
    @if (Session::has('notification')) data-notification-message='{{ json_encode(Session::get('notification')) }}' @endif
    class=" hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        @include('admin.partials.top-navbar')
        @include('admin.partials.side-navbar')
        <div class="content-wrapper">
            @yield('content')
            @include('admin.partials.modals')
        </div>
        @include('admin.partials.footer')
    </div>
    @includeif('admin.partials.scripts')
</body>

</html>
