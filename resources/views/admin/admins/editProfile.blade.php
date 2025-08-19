@extends('admin.layouts.master')
@section('title', 'Edit Profile')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Change Password Section -->
            <div class="col-md-4 mt-2">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Change Password') }} </h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.password.update') }}" method="POST">
                            @csrf
                            <label class="control-label">{{ __('Current Password') }} <span class="text-danger">*</span></label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" name="old_password" placeholder="{{ __('Your Current Password') }}">
                            </div>
                            @error('old_password') <p class="text-danger">{{ $message }}</p> @enderror

                            <label class="control-label">{{ __('New Password') }} <span class="text-danger">*</span></label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" class="form-control" name="password" placeholder="{{ __('New Password') }}">
                            </div>
                            @error('password') <p class="text-danger">{{ $message }}</p> @enderror

                            <label class="control-label">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-check-double"></i></span>
                                </div>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}">
                            </div>
                            @error('password_confirmation') <p class="text-danger">{{ $message }}</p> @enderror

                            <button type="submit" class="btn btn-primary form-control">{{ __('Update') }}</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Profile Update Section -->
            <div class="col-md-8 mt-2">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Update Admin Profile') }}</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Image Upload --}}
                            <div class="form-group row">
                                <label for="image" class="col-sm-2 control-label">{{ __('Image') }}</label>
                                <div class="col-sm-10">
                                    @if ($user->icon)
                                        <img class="w-100 mb-3 img-demo show-img" src="{{ asset('admin/user/profile/' . $user->icon) }}" alt="">
                                    @endif
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="icon" id="image">
                                            <label class="custom-file-label" for="image">{{ __('Choose New Image') }}</label>
                                        </div>
                                    </div>
                                    <p class="help-block text-info">
                                        {{ __('Upload 70X70 (Pixel) Size image for best quality. Only jpg, jpeg, png image is allowed.') }}
                                    </p>
                                    @error('icon') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            {{-- Email (readonly) --}}
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 control-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" readonly>
                                    </div>
                                    @error('email') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            {{-- Name --}}
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 control-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="{{ __('Full Name') }}">
                                    </div>
                                    @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            {{-- Phone No --}}
                            <div class="form-group row">
                                <label for="phone_no" class="col-sm-2 control-label">{{ __('Phone No') }}</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="phone_no" value="{{ $user->phone_no }}" placeholder="{{ __('Phone No') }}">
                                    </div>
                                    @error('phone_no') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            {{-- WhatsApp No --}}
                            <div class="form-group row">
                                <label for="whatsapp_no" class="col-sm-2 control-label">{{ __('WhatsApp No') }}</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="whatsapp_no" value="{{ $user->whatsapp_no }}" placeholder="{{ __('WhatsApp No') }}">
                                    </div>
                                    @error('whatsapp_no') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            {{-- Address --}}
                            <div class="form-group row">
                                <label for="address" class="col-sm-2 control-label">{{ __('Address') }}</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="address" value="{{ $user->address }}" placeholder="{{ __('Address') }}">
                                    </div>
                                    @error('address') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">{{ __('Update profile') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- /.col-md-8 -->
        </div> <!-- /.row -->
    </div><!-- /.container -->
</section>

@endsection
