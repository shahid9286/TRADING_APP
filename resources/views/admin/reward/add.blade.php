@extends('admin.layouts.master')
@section('title', 'Add Reward')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-gift"></i> {{ __('Add Reward') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-home"></i> {{ __('Home') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item">{{ __('Rewards') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">{{ __('Add Reward') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.reward.index') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.reward.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="row ">

                            {{-- Title --}}
                            <div class="col-12 mb-3">
                                <label for="title">{{ __('Title') }} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                    </div>
                                    <input type="text" id="title" class="form-control form-control-sm" name="title" value="{{ old('title') }}" placeholder="{{ __('Enter Reward Title') }}" required>
                                </div>
                                @error('title') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>

                            {{-- Dates --}}
                                <div class=" col-6 mb-3">
                                    <label for="sdate">{{ __('Start Date') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" id="sdate" class="form-control form-control-sm" name="start_date" value="{{ old('start_date') }}" required>
                                    </div>
                                    @error('start_date') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class=" col-6 mb-3">
                                    <label for="end_date">{{ __('End Date') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                        </div>
                                        <input type="date" id="end_date" class="form-control form-control-sm" name="end_date" value="{{ old('end_date') }}" required>
                                    </div>
                                    @error('end_date') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                            {{-- Reward Title / Amount / Target --}}
                                <div class=" col-4 mb-3">
                                    <label for="reward_title">{{ __('Reward Title') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-award"></i></span>
                                        </div>
                                        <input type="text" id="reward_title" class="form-control form-control-sm" name="reward_title" value="{{ old('reward_title') }}" placeholder="{{ __('Enter Reward Name') }}">
                                    </div>
                                    @error('reward_title') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class=" col-4 mb-3">
                                    <label for="reward_amount">{{ __('Reward Amount') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input type="number" step="0.01" id="reward_amount" class="form-control form-control-sm" name="reward_amount" value="{{ old('reward_amount') }}" placeholder="{{ __('Enter Reward Amount') }}">
                                    </div>
                                    @error('reward_amount') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class=" col-4 mb-3">
                                    <label for="target_amount">{{ __('Target Amount') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-bullseye"></i></span>
                                        </div>
                                        <input type="number" step="0.01" id="target_amount" class="form-control form-control-sm" name="target_amount" value="{{ old('target_amount') }}" placeholder="{{ __('Enter Target Amount') }}">
                                    </div>
                                    @error('target_amount') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>

                            {{-- Status --}}
                            <div class="col-6 mb-3">
                                <label for="status">{{ __('Status') }} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                    </div>
                                    <select id="status" name="status" class="form-control form-control-sm"required>
                                        <option value="" disabled {{ old('status') ? '' : 'selected' }}>Select Status</option>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                                @error('status') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>

                            {{-- Image --}}
                                    <div class="col-6 mb-3">
                                        <label for="image">
                                            {{ __('Image') }}
                                        </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    </div>
                                            <input type="file" class="form-control form-control-sm form-control form-control-sm-sm up-img" name="image"
                                                id="image">
                                        </div>
                                        <img class="mw-400 mt-1 show-img img-demo"
                                            src="{{ asset('assets/uploads/core/img-demo.jpg') }}" alt=""
                                            width="50px">
                                        @if ($errors->has('image'))
                                            <p class="text-danger">{{ $errors->first('image') }}</p>
                                        @endif
                                    </div>


                            {{-- Description --}}
                            <div class="form-group col-12 mb-3">
                                <label for="description">{{ __('Description') }}</label>
                                    <textarea id="description" class="form-control form-control-sm summernote" name="description" rows="3" placeholder="{{ __('Enter Description') }}">{{ old('description') }}</textarea>
                                @error('description') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>

                            {{-- Submit --}}
                            <div class="form-group col-3">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-paper-plane"></i> {{ __('Add Reward') }}
                                </button>
                            </div>

                        </form>
                    </div> <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
