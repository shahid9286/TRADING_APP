@extends('admin.layouts.master')
@section('title', 'Add User')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mt-2">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('Add New User') }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.user.index') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <form class="" action="{{ route('admin.user.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Name <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-user"></i></span>
                                                        </div>

                                                        <input type="text" class="form-control" name="name"
                                                            id="name" placeholder="Enter Name"
                                                            value="{{ old('name') }}" required>
                                                    </div>

                                                    @if ($errors->has('name'))
                                                        <p class="text-danger"> {{ $errors->first('name') }} </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="email">Email <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-envelope"></i></span>
                                                        </div>

                                                        <input type="text" class="form-control" name="email"
                                                            name="email" placeholder="Enter Email"
                                                            value="{{ old('email') }}" required>
                                                    </div>

                                                    @if ($errors->has('email'))
                                                        <p class="text-danger"> {{ $errors->first('email') }} </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="phone_no">Phone No</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-phone"></i></span>
                                                        </div>

                                                        <input type="text" class="form-control" name="phone_no"
                                                            id="phone_no" placeholder="Enter Phone No"
                                                            value="{{ old('phone_no') }}">
                                                    </div>

                                                    @if ($errors->has('phone_no'))
                                                        <p class="text-danger"> {{ $errors->first('phone_no') }} </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="whatsapp_no">WhatsApp No</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                                        </div>

                                                        <input type="text" class="form-control" name="whatsapp_no"
                                                            placeholder="Enter WhatsApp No"
                                                            value="{{ old('whatsapp_no') }}">
                                                    </div>

                                                    @if ($errors->has('whatsapp_no'))
                                                        <p class="text-danger"> {{ $errors->first('whatsapp_no') }} </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="password">Password <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-lock"></i></span>
                                                        </div>

                                                        <input type="password" class="form-control" id="password"
                                                            name="password" placeholder="Enter password"
                                                            value="{{ old('password') }}" required>
                                                    </div>

                                                    @if ($errors->has('password'))
                                                        <p class="text-danger"> {{ $errors->first('password') }} </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="status">
                                                        {{ __('Status') }} <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-toggle-on"></i>
                                                            </span>
                                                        </div>
                                                        <select class="form-control" name="status" id="status">
                                                            <option value="approved">{{ __('Approved') }}</option>
                                                            <option value="pending">{{ __('Pending') }}</option>
                                                            <option value="blocked">{{ __('Blocked') }}</option>
                                                        </select>
                                                    </div>
                                                    @if ($errors->has('status'))
                                                        <p class="text-danger"> {{ $errors->first('status') }} </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="user_type">User Type<span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-user-shield"></i> {{-- You can change this icon as needed --}}
                                                            </span>
                                                        </div>
                                                        <select class="form-control" name="user_type" required>
                                                            <option value="-1" disabled selected>
                                                                {{ __('Select User Type') }}
                                                            </option>
                                                            @if (auth()->user()->user_type == 'superAdmin')
                                                                <option value="superAdmin">{{ __('Super Admin') }}
                                                                </option>
                                                            @endif
                                                            <option value="admin">{{ __('Admin') }}</option>
                                                            <option value="user">{{ __('User') }}</option>
                                                            {{-- Add more roles if needed --}}
                                                        </select>
                                                    </div>
                                                    @if ($errors->has('user_type'))
                                                        <p class="text-danger"> {{ $errors->first('user_type') }} </p>
                                                    @endif
                                                </div>
                                            </div>



                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address">Address </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-map-marker-alt"></i>
                                                            </span>
                                                        </div>

                                                        <input type="text" class="form-control" id="address"
                                                            name="address" placeholder="Enter Address"
                                                            value="{{ old('address') }}">
                                                    </div>

                                                    @if ($errors->has('address'))
                                                        <p class="text-danger"> {{ $errors->first('address') }} </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <label for="icon">{{ __('Upload Image') }}</label>
                                        <div class="input-group input-group">
                                            <span class="input-group-text p-1 px-2"><i class="fas fa-image"></i></span>
                                            <input type="file" name="image" id="image"
                                                class="form-control form-control up-img">
                                        </div>


                                        <img class="mw-400 mt-1 mb-2 show-img img-demo"
                                            src="{{ asset('assets/uploads/core/img-demo.jpg') }}" 
                                            alt="">
                                                        @if ($errors->has('image'))
                                                            <p class="text-danger"> {{ $errors->first('image') }} </p>
                                                        @endif
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                        <div class="row ">
                                            <div class="col">
                                                <div class="form-group row">
                                                    <div class="col-sm-12 ">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-primary ms-4 ">{{ __('Add New User') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </section>
@endsection
