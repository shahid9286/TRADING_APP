<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | MHOW.org</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/core/fav.png') }}" type="image/png">
    @includeif('admin.partials.styles')
</head>

<body @php
    use Illuminate\Support\Facades\Session; @endphp {{ Session::has('notification') ? 'data-notification' : '' }}
    @if (Session::has('notification')) data-notification-message='{{ json_encode(Session::get('notification')) }} @endif'
    class=" hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        @include('admin.partials.top-navbar')
        @include('admin.partials.side-navbar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        @include('admin.partials.footer')
    </div>
    <!-- ./wrapper -->
    @includeif('admin.partials.scripts')
    {{-- @include('sweetalert::alert') --}}
</body>

</html>
