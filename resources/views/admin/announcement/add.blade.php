@extends('admin.layouts.master')
@section('title', 'Add Announcement')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <form class="form-horizontal" action="{{ route('admin.announcement.store') }}" method="post">
                    @csrf
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline mt-2">
                            <div class="card-header">
                                <h3 class="card-title mt-1"> <b> {{ __('Add Announcement') }} </b> </h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body py-3">

                                <div class="row">


                                    <!-- Announcement Title -->
                                    <div class=" col-md-6">
                                        <label for="title">{{ __('Title') }} <span class="text-danger">*</span></label>
                                        <input type="text" id="title" class="form-control form-control-sm"
                                            name="title" value="{{ old('title') }}"
                                            placeholder="{{ __('Enter Announcement Title') }}" required>
                                        @if ($errors->has('title'))
                                            <p class="text-danger">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>

                                    <!-- Link Text -->
                                    <div class="col-md-6">
                                        <label for="link_text">{{ __('Link Text') }}</label>
                                        <input type="text" id="link_text" name="link_text"
                                            class="form-control form-control-sm" placeholder="{{ __('Enter Link Text') }}"
                                            value="{{ old('link_text') }}">
                                        @if ($errors->has('link_text'))
                                            <p class="text-danger">{{ $errors->first('link_text') }}</p>
                                        @endif
                                    </div>

                                    <!-- Link URL -->
                                    <div class="col-md-6 mt-2">
                                        <label for="link_url">{{ __('Link URL') }}</label>
                                        <input type="url" id="link_url" name="link_url"
                                            class="form-control form-control-sm" placeholder="{{ __('Enter Link URL') }}"
                                            value="{{ old('link_url') }}">
                                        @if ($errors->has('link_url'))
                                            <p class="text-danger">{{ $errors->first('link_url') }}</p>
                                        @endif
                                    </div>

                                    <!--Order Number -->
                                    <div class="col-md-3 mt-2">
                                        <label for="order_no">{{ __('Order No') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="number" id="order_no" name="order_no"
                                            class="form-control form-control-sm" placeholder="{{ __('Enter Order No') }}"
                                            value="{{ old('order_no') }}" required>
                                        @if ($errors->has('order_no'))
                                            <p class="text-danger">{{ $errors->first('order_no') }}</p>
                                        @endif
                                    </div>

                                    <!-- Status -->
                                    <div class=" col-md-3 mt-2">
                                        <label for="status">{{ __('Status') }} <span
                                                class="text-danger">*</span></label>
                                        <select id="status" name="status" class="form-control form-control-sm" required>
                                            <option value="">{{ __('-- Select Status --') }}</option>
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <p class="text-danger">{{ $errors->first('status') }}</p>
                                        @endif
                                    </div>


                                    <!-- Message -->
                                    <div class="col-md-12 mt-2">
                                        <label for="message">Message <span class="text-danger">*</span></label>
                                        <textarea id="message" class="summernote form-control form-control-sm" name="message"
                                            placeholder="{{ __('Enter Announcement Message') }}" required>{{ old('message') }}</textarea>

                                        @if ($errors->has('message'))
                                            <p class="text-danger">{{ $errors->first('message') }}</p>
                                        @endif
                                    </div>

                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                    <div class=" col-12">
                        <button type="submit"
                            class="btn btn-sm mb-1 btn-primary float-right">{{ __('Add Announcement') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row -->

    </section>
@endsection
