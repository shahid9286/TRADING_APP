@extends('admin.layouts.master')
@section('title', 'Settings')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Settings') }} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                    class="fas fa-home"></i>{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item">{{ __('Settings') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">{{ __('Settings') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">{{ __('Logo') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <img class="mb-3 show-img img-demo"
                                            src="
                                    @if ($setting->logo) {{ asset($setting->logo) }}
                                    @else
                                    {{ asset('assets/admin/img/611ea931af956.jpg') }} @endif"
                                            alt="" width="250px">
                                        <div class="custom-file">
                                            <label class="custom-file-label" for="logo">Choose New Image</label>
                                            <input type="file" class="custom-file-input up-img" name="logo"
                                                id="logo">
                                        </div>
                                        <p class="text-info" style="font-size: 0.9rem;">
                                            {{ __('Upload 680x320 (Pixel) Size image for best quality.Only jpg, jpeg, png image is allowed.') }}
                                        </p>
                                        @if ($errors->has('logo'))
                                            <p class="text-danger"> {{ $errors->first('logo') }} </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">{{ __('Footer Logo') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <img class="mb-3 show-img img-demo"
                                            src="
                                    @if ($setting->footer_logo) {{ asset($setting->footer_logo) }}
                                    @else
                                    {{ asset('assets/admin/img/img-demo.jpg') }} @endif"
                                            alt="" width="250px">
                                        <div class="custom-file">
                                            <label class="custom-file-label" for="footer_logo">Choose New Image</label>
                                            <input type="file" class="custom-file-input up-img" name="footer_logo"
                                                id="footer_logo">
                                        </div>
                                        <p class="text-info" style="font-size: 0.9rem;">
                                            {{ __('Upload 680x320 (Pixel) Size image for best quality.Only jpg, jpeg, png image is allowed.') }}
                                        </p>
                                        @if ($errors->has('footer_logo'))
                                            <p class="text-danger"> {{ $errors->first('footer_logo') }} </p>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">{{ __('Favicon') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <img class="mb-3 show-img img-demo"
                                            src="
                                    @if ($setting->fav_icon) {{ asset($setting->fav_icon) }}
                                    @else
                                    {{ asset('assets/site/img/img-demo.jpg') }} @endif"
                                            alt="" width="100px">
                                        <div class="custom-file">
                                            <label class="custom-file-label"
                                                for="fav_icon">{{ __('Choose New Image') }}</label>
                                            <input type="file" class="custom-file-input up-img" name="fav_icon"
                                                id="fav_icon">
                                        </div>
                                        <p class="text-info" style="font-size: 0.9rem;">
                                            {{ __('Upload 325x325 (Pixel) Size image or Squre size image for best quality.Only jpg, jpeg, png image is allowed.') }}
                                        </p>
                                        @if ($errors->has('fav_icon'))
                                            <p class="text-danger"> {{ $errors->first('fav_icon') }} </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">{{ __('Breadcrumb') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <img class="mb-3 show-img img-demo"
                                            src="
                                    @if ($setting->logo) {{ asset($setting->home_beadcrum_img) }}
                                    @else
                                    {{ asset('assets/site/img/611ea931af956.jpg') }} @endif"
                                            alt="" width="450px">
                                        <div class="custom-file">
                                            <label class="custom-file-label" for="logo">Choose New Image</label>
                                            <input type="file" class="custom-file-input up-img" name="home_beadcrum_img"
                                                id="breadcrumb_img">
                                        </div>
                                        <p class="text-info" style="font-size: 0.9rem;">
                                            {{ __('Upload 2202x886 (Pixel) Size image for best quality.Only jpg, jpeg, png image is allowed.') }}
                                        </p>
                                        @if ($errors->has('home_beadcrum_img'))
                                            <p class="text-danger"> {{ $errors->first('home_beadcrum_img') }} </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label font-weight-bold">{{ __('Phone') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="phone_no"
                                            placeholder="{{ __('Phone') }}" value="{{ $setting->phone_no }}">
                                        @error('phone_no')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="phone_no_2"
                                            placeholder="{{ __('Phone 2') }}" value="{{ $setting->phone_no_2 }}">
                                        @error('phone_no_2')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Social Links Section -->
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label font-weight-bold">{{ __('WhatsApp') }} </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="whatsapp_no"
                                            placeholder="{{ __('WhatsApp') }}" value="{{ $setting->whatsapp_no }}">
                                        @error('whatsapp_no')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>


                                {{-- <div class="form-group row">
                                <label class="col-md-2 col-form-label font-weight-bold">{{ __('Social Links') }}</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control mb-2" name="fb_link"
                                        placeholder="Facebook Link" value="{{ $setting->fb_link }}">
                                    <input type="text" class="form-control mb-2" name="insta_link"
                                        placeholder="Instagram Link" value="{{ $setting->insta_link }}">
                                    <input type="text" class="form-control mb-2" name="yt_link"
                                        placeholder="YouTube Link" value="{{ $setting->yt_link }}">
                                    <input type="text" class="form-control mb-2" name="tiktok_link"
                                        placeholder="TikTok Link" value="{{ $setting->tiktok_link }}">
                                    <input type="text" class="form-control mb-2" name="whatsapp_link"
                                        placeholder="WhatsApp Link" value="{{ $setting->whatsapp_link }}">
                                    <input type="text" class="form-control" name="pinterest_link"
                                        placeholder="Pinterest Link" value="{{ $setting->pinterest_link }}">
                                    @error('social_links')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div> --}}

                                <!-- Social Links Section -->
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label font-weight-bold">{{ __('Facebook Link') }}
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="fb_link"
                                            placeholder="{{ __('Facebook Link') }}" value="{{ $setting->fb_link }}">
                                        @error('fb_link')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Social Links Section -->
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label font-weight-bold">{{ __('Insta Link') }}
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="insta_link"
                                            placeholder="{{ __('Insta Link') }}" value="{{ $setting->insta_link }}">
                                        @error('insta_link')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Social Links Section -->
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label font-weight-bold">{{ __('YouTube Link') }}
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="yt_link"
                                            placeholder="{{ __('YouTube Link') }}" value="{{ $setting->yt_link }}">
                                        @error('yt_link')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Social Links Section -->
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label font-weight-bold">{{ __('TikTok Link') }}
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="tiktok_link"
                                            placeholder="{{ __('TikTok Link') }}" value="{{ $setting->tiktok_link }}">
                                        @error('tiktok_link')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Social Links Section -->
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label font-weight-bold">{{ __('WhatsApp Link') }}
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="whatsapp_link"
                                            placeholder="{{ __('WhatsApp Link') }}"
                                            value="{{ $setting->whatsapp_link }}">
                                        @error('whatsapp_link')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Social Links Section -->
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label font-weight-bold">{{ __('Pinterest Link') }}
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="pinterest_link"
                                            placeholder="{{ __('Pinterest Link') }}"
                                            value="{{ $setting->pinterest_link }}">
                                        @error('pinterest_link')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">{{ __('Email') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="email"
                                            placeholder="{{ __('Email') }}" value="{{ $setting->email }}">
                                        @if ($errors->has('email'))
                                            <p class="text-danger"> {{ $errors->first('email') }} </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">{{ __('Admin Email') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="admin_email"
                                            placeholder="{{ __('Admin Email') }}" value="{{ $setting->admin_email }}">
                                        @if ($errors->has('email'))
                                            <p class="text-danger"> {{ $errors->first('eadmin_mail') }} </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label">{{ __('Address') }}<span
                                            class="text-danger">*</span></label>

                                    <div class="col-sm-10">
                                        <textarea name="address" class="form-control" rows="5" placeholder="{{ __('Address') }}">{{ $setting->address }}</textarea>
                                        @if ($errors->has('address'))
                                            <p class="text-danger"> {{ $errors->first('address') }} </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                    </div>
                                </div>
                            </form>
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
