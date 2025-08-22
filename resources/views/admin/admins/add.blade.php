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
                                               <label for="user_name">
    {{ __('User Name') }} <span class="text-danger">*</span>
</label>

<div class="input-group">
    <span class="input-group-text">
        <i class="fas fa-user"></i> 
    </span>
    <input type="text" name="user_name" id="user_name" placeholder="Enter Name"
        class="form-control" value="{{ old('user_name') }}" required>
</div>

@if ($errors->has('user_name'))
    <p class="text-danger">{{ $errors->first('user_name') }}</p>
@endif

                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="phone_no">Phone No</label>
                                                    <div class="input-group">
                                                        
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-phone"></i></span>
                                                       

                                                        <input type="text" class="form-control" name="Phone_no"
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
                                                    <label for="email">Email <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                       
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-envelope"></i></span>
                                                       

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
                                                    <label for="password">Password <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                      
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-lock"></i></span>
                                                        

                                                        <input type="password" class="form-control" id="password"
                                                            name="password" placeholder=" password"
                                                            value="{{ old('password') }}" required>
                                                    </div>

                                                    @if ($errors->has('password'))
                                                        <p class="text-danger"> {{ $errors->first('password') }} </p>
                                                    @endif
                                                </div>
                                            </div>

                                           

                                             

                                            
                                             <div class="col-lg-6">
    <div class="form-group">
        <label for="first_name">
            {{ __('First Name') }} <span class="text-danger">*</span>
        </label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-user"></i>
            </span>
            <input type="text" name="first_name" id="first_name" placeholder="Enter First Name"
                   class="form-control" value="{{ old('first_name') }}" required>
        </div>
        @if ($errors->has('first_name'))
            <p class="text-danger">{{ $errors->first('first_name') }}</p>
        @endif
    </div>
</div>

<div class="col-lg-6">
    <div class="form-group">
        <label for="last_name">
            {{ __('Last Name') }} <span class="text-danger">*</span>
        </label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-user"></i>
            </span>
            <input type="text" name="last_name" id="last_name" placeholder="Enter Last Name"
                   class="form-control" value="{{ old('last_name') }}" required>
        </div>
        @if ($errors->has('last_name'))
            <p class="text-danger">{{ $errors->first('last_name') }}</p>
        @endif
    </div>
</div>

<div class="col-lg-12 ">
    <div class="form-group">
        <label for="icon">{{ __('Profile Image') }}</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-image"></i></span>
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

                                                    
                                            
                                              <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="phone_no">Whatsapp No</label>
                                                    <div class="input-group">
                                                       
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-phone"></i></span>
                                                        

                                                        <input type="text" class="form-control" name="whatsapp No"
                                                            id="whatsapp No" placeholder="Enter whatsapp No "
                                                            value="{{ old('whatsapp No') }}">
                                                    </div>

                                                    @if ($errors->has('whatsapp No'))
                                                        <p class="text-danger"> {{ $errors->first('whatsapp No') }} </p>
                                                    @endif
                                                </div>
                                            </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="status">
                                                        {{ __('Status') }} <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="input-group">
                                                       
                                                            <span class="input-group-text">
                                                                <i class="fas fa-toggle-on"></i>
                                                            </span>
                                                       
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
        <label for="city">City</label>
        <div class="input-group">
            
                <span class="input-group-text">
                    <i class="fas fa-city"></i>
                </span>
           
            <input type="text" class="form-control" id="city"
                   name="city" placeholder="Enter City"
                   value="{{ old('city') }}">
        </div>
        @if ($errors->has('city'))
            <p class="text-danger"> {{ $errors->first('city') }} </p>
        @endif
    </div>
</div>

<div class="col-lg-6">
    <div class="form-group">
        <label for="country">Country</label>
        <div class="input-group">
           
                <span class="input-group-text">
                    <i class="fas fa-flag"></i>
                </span>
            
            <input type="text" class="form-control" id="country"
                   name="country" placeholder="Enter Country"
                   value="{{ old('country') }}">
        </div>
        @if ($errors->has('country'))
            <p class="text-danger"> {{ $errors->first('country') }} </p>
        @endif
    </div>
</div>


                                            
                                <div class="col-lg-12 ">
                                                <div class="form-group">
                                                    <label for="address">Address </label>
                                                    <div class="input-group">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-map-marker-alt"></i>
                                                            </span>

                                                        <input type="text" class="form-control" id="address"
                                                            name="address" placeholder="Enter Address"
                                                            value="{{ old('address') }}">
                                                    </div>

                                                    @if ($errors->has('address'))
                                                        <p class="text-danger"> {{ $errors->first('address') }} </p>
                                                    @endif
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
