<!-- Mirrored from thetork.com/demos/html/bitrader/index-2-dark.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 04 Aug 2023 07:56:20 GMT -->

<head>
    <title>@yield('title') | Safe Capital</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('front.partials.styles')
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
