@extends('branchManager.layouts.master')
@section('title', 'Edit Profile')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 mt-2">

                    <!-- Profile Image -->

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-lock mr-1"></i> {{ __('Change Password') }}
                            </h3>
                        </div>

                        <!-- /.box-header -->
                        <div class="card-body">
                           <label class="control-label">{{ __('Current Password') }} <span class="text-danger">*</span></label>
<div class="input-group input-group-sm">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-lock"></i></span>
    </div>
    <input type="password" class="form-control form-control-sm" name="old_password"
        placeholder="{{ __('Your Current Password') }}">
</div>
@if ($errors->has('old_password'))
    <p class="text-danger"> {{ $errors->first('old_password') }} </p>
@endif

<label class="control-label"> {{ __('New Password') }}<span class="text-danger">*</span></label>
<div class="input-group input-group-sm">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-shield-alt"></i></span>
    </div>
    <input type="password" class="form-control form-control-sm" name="password"
        placeholder="{{ __('New Password') }}">
</div>
@if ($errors->has('password'))
    <p class="text-danger"> {{ $errors->first('password') }} </p>
@endif

<label class="control-label">{{ __('Confirm Password') }}<span class="text-danger">*</span></label>
<div class="input-group input-group-sm">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-check"></i></span>
    </div>
    <input type="password" class="form-control form-control-sm" name="password_confirmation"
        placeholder="{{ __('Confirm Password') }}">
</div>
@if ($errors->has('password_confirmation'))
    <p class="text-danger"> {{ $errors->first('password_confirmation') }} </p>

  @endif
 <button type="submit"
  class="btn btn-primary mt-2 form-control">{{ __('Update') }}</button>
    </form>
 </div>

                        <!-- /.box-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-8 mt-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">{{ __('Update Admin Profile') }} </h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="card-body">
                                    <form class="form-horizontal" action="{{ route('branchManager.profile.update') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
<div class="form-group row">
    <!-- Label Left -->
    <label for="image" class="col-sm-2 col-form-label col-form-label-sm">
        Image <span class="text-danger">*</span>
    </label>

    <!-- Input Right -->
    <div class="col-sm-10">
        <!-- Preview (Hidden Initially) -->
        <div id="previewContainer" style="display: none;">
            <img id="previewImage" src="#" alt="Preview" class="img-thumbnail" style="width: 150px;">
        </div>
        <!-- Input with icon -->
        <div class="input-group input-group-sm mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-image"></i>
                </span>
            </div>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>

        

        <!-- Error Display -->
        @if ($errors->has('image'))
            <small class="text-danger">{{ $errors->first('image') }}</small>
        @endif
    </div>
</div>

<!-- Script for Preview -->
<script>
    document.getElementById('image').addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('previewImage').src = e.target.result;
                document.getElementById('previewContainer').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>



                                       <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label col-form-label-sm">
        {{ __('Email') }} <span class="text-danger">*</span>
    </label>
    <div class="col-sm-10">
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            <input type="email" class="form-control form-control-sm" name="email"
                value="{{ $user->email }}" placeholder="{{ __('Email') }}" readonly>
        </div>
        @if ($errors->has('email'))
            <p class="text-danger"> {{ $errors->first('email') }} </p>
        @endif
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label col-form-label-sm" for="name">
        {{ __('Name') }} <span class="text-danger">*</span>
    </label>
    <div class="col-sm-10">
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" class="form-control form-control-sm" name="name"
                value="{{ $user->name }}" placeholder="{{ __('Full Name') }}">
        </div>
        @if ($errors->has('name'))
            <p class="text-danger"> {{ $errors->first('name') }} </p>
        @endif
    </div>
</div>


                                        <div class="form-group row">
    <label class="col-sm-2 col-form-label col-form-label-sm" for="phone_no">
        {{ __('Phone No') }}
    </label>
    <div class="col-sm-10">
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-phone"></i>
                </span>
            </div>
            <input type="text" class="form-control form-control-sm" name="phone_no"
                value="{{ $user->phone_no }}" placeholder="{{ __('Phone No') }}">
        </div>
        @if ($errors->has('phone_no'))
            <p class="text-danger"> {{ $errors->first('phone_no') }} </p>
        @endif
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label col-form-label-sm" for="whatsapp_no">
        {{ __('WhatsApp No') }}
    </label>
    <div class="col-sm-10">
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
            </div>
            <input type="text" class="form-control form-control-sm" name="whatsapp_no"
                value="{{ $user->whatsapp_no }}" placeholder="{{ __('Whatsapp No') }}">
        </div>
        @if ($errors->has('whatsapp_no'))
            <p class="text-danger"> {{ $errors->first('whatsapp_no') }} </p>
        @endif
    </div>
</div>


                        <div class="form-group row">
    <label class="col-sm-2 col-form-label col-form-label-sm" for="address">
        {{ __('Address') }}
    </label>
    <div class="col-sm-10">
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
            </div>
            <input type="text" class="form-control form-control-sm" name="address"
                value="{{ $user->address }}" placeholder="{{ __('Address') }}">
        </div>
        @if ($errors->has('address'))
            <p class="text-danger"> {{ $errors->first('address') }} </p>
        @endif
    </div>
</div>


                                         <div class="form-group row">
    <label class="col-sm-2 col-form-label"></label>
    <div class="col-sm-10">
        <button type="submit" class="btn btn-sm btn-primary">
            {{ __('Update Profile') }}
        </button>
    </div>
</div>

                                    </form>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- / -->
    </section>

@endsection
