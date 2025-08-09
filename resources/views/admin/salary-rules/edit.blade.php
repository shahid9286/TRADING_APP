@extends('admin.layouts.master')
@section('title', 'Edit Salary Rules')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <form class="form-horizontal" action="{{ route('admin.salary-rules.update', $salary_rule->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline mt-2">
                            <div class="card-header">
                                <h3 class="card-title mt-1"> <b> {{ __('Edit Salary Rules') }} </b> </h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body py-3">

                                <div class="row">


                                    <!-- Direct Investment -->
                                    <div class="col-md-6">
                                        <label for="direct_investment">{{ __('Direct Investment') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="number" step="0.01" min="0" id="direct_investment"
                                            class="form-control form-control-sm" name="direct_investment"
                                            value="{{ old('direct_investment', $salary_rule->direct_investment) }}"
                                            placeholder="{{ __('Enter Direct Investment Amount') }}">
                                        @if ($errors->has('direct_investment', $salary_rule->direct_investment))
                                            <p class="text-danger">
                                                {{ $errors->first('direct_investment', $salary_rule->direct_investment) }}
                                            </p>
                                        @endif
                                    </div>

                                    <!-- Salary -->
                                    <div class="col-md-6">
                                        <label for="salary">{{ __('Salary') }} <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" min="0" id="salary" name="salary"
                                            class="form-control form-control-sm"
                                            placeholder="{{ __('Enter Salary Amount') }}"
                                            value="{{ old('salary', $salary_rule->salary) }}">
                                        @if ($errors->has('salary', $salary_rule->salary))
                                            <p class="text-danger">{{ $errors->first('salary', $salary_rule->salary) }}</p>
                                        @endif
                                    </div>

                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                    <div class=" col-12">
                        <button type="submit"
                            class="btn btn-sm mb-1 btn-primary float-right">{{ __('Update Salary Rules') }}</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.row -->

    </section>
@endsection
