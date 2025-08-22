@extends('front.layouts.master')
@section('title', 'User Levels')
@section('css')
    <style>
        .table th,
        .table td {
            background-color: transparent !important;
            text-align: center;
        }
    </style>

@endsection
@section('content')

    <section class="pt-4">
        <div class="container">

            <table class="table">
                <thead>
                    <tr>
                        <th class="fs-5">Level</th>
                        <th class="fs-5">Total Users</th>
                        <th class="fs-5">Total Investments</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($levels as $level => $data)
                        <tr>
                            <td>{{ $level }}</td>
                            <td>{{ $data['users'] }}</td>
                            <td>{{ number_format($data['investments'], 2) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th>Total:</th>
                        <th>{{ $totalUsersAll }}</th>
                        <th>{{ number_format($totalInvestmentsAll, 2) }}</th>
                    </tr>
                </tbody>
            </table>

        </div>
    </section>
@endsection
