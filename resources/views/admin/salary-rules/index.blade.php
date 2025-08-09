@extends('admin.layouts.master')
@section('title', 'Salary Rule List')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline mt-3">
                        <div class="card-header">
                            <h3 class="card-title mt-1"><b>{{ __('List of Salary Rules') }}</b></h3>
                            <div class="card-tools d-flex">
                                <a href="{{ route('admin.salary-rules.add') }}" class="btn btn-primary btn-sm mx-1">
                                    <i class="fas fa-plus"></i> {{ __('Add Salary Rule') }}
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="tableContent">
                                <table class="table table-striped table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>{{ __('#') }}</th>
                                            <th>{{ __('Direct Investment') }}</th>
                                            <th>{{ __('Salary') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($salary_rules as $salary_rule)
                                            <tr>
                                                <td class="text-center">{{ $salary_rule->id }}</td>

                                                <td>
                                                    {{ $salary_rule->direct_investment }}

                                                </td>
                                                <td>
                                                    {{ $salary_rule->salary }}
                                                </td>


                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('admin.salary-rules.edit', $salary_rule->id) }}"
                                                            class="btn btn-info btn-sm mx-1">
                                                            <i class="fas fa-pencil-alt"></i> {{ __('Edit') }}
                                                        </a>

                                                        <form id="deleteform" class="d-inline-block"
                                                            action="{{ route('admin.salary-rules.delete', $salary_rule->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                id="delete">
                                                                <i class="fas fa-trash"></i>{{ __('Delete') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No salary rules found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
