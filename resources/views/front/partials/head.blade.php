<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <title>@yield('title') | Safe Capital</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="SafeCapital Pro offers secure investment opportunities, monthly profits, referral commissions, and salary-based rewards for trusted investors.">
    <meta name="keywords"
        content="SafeCapital Pro, investments, secure investments, monthly profits, referral commissions, salary rewards, finance, investment company">
    <meta name="author" content="SafeCapital Pro">

    <meta property="og:title" content="SafeCapital Pro - Secure Investment Platform">
    <meta property="og:description"
        content="Join SafeCapital Pro for secure investments, monthly profits, and referral rewards.">
    <meta property="og:image" content="{{ asset('assets/static/logo.png') }}">
    <meta property="og:url" content="https://safecapitalpro.com">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="SafeCapital Pro - Secure Investment Platform">
    <meta name="twitter:description"
        content="Join SafeCapital Pro for secure investments, monthly profits, and referral rewards.">
    <meta name="twitter:image" content="{{ asset('assets/static/logo.png') }}">

     <meta name="robots" content="index, follow">



    @include('front.partials.styles')
    <style>
        /* p {
                            margin: 0 !important;
                        } */

        .announcement-link:hover {
            color: #ffffff;
        }

        .custom-marquee {
            background: #032830;
            border: 1px solid #087990;
            color: #6EDFF6;
            padding: 10px 20px;
            font-weight: 500;
            font-size: 16px;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .custom-marquee a {
            text-decoration: underline;
            color: #00e1ff;
        }

        marquee span {
            margin-right: 40px;
        }
    </style>
    <style>
        #customTable {
            background-color: #1e1e1e;
            color: #ddd;
            border: none;
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
        }

        #customTable thead {
            background-color: #2a2a2a;
            color: #f1f1f1;
        }

        #customTable tbody tr {
            background-color: #252525;
            border-bottom: 1px solid #333;
        }

        #customTable tbody tr:hover {
            background-color: #333;
        }

        .dataTables_wrapper {
            color: #ddd;
        }

        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            background-color: #2a2a2a;
            color: #ddd;
            border: 1px solid #444;
            border-radius: 4px;
            padding: 4px 8px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background-color: #2a2a2a !important;
            color: #ddd !important;
            border: none;
            margin: 0 2px;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #444 !important;
            color: #fff !important;
        }

        table.dataTable.no-footer {
            border-bottom: none;
        }
    </style>
    @yield('css')

</head>
