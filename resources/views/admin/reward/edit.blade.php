@extends('admin.layouts.master')
@section('title', 'Edit Reward')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-edit"></i> {{ __('Edit Reward') }}</h1>
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
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Edit Reward') }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.reward.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-angle-double-left"></i> {{ __('Back') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('admin.reward.update', $reward->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            {{-- Title --}}
                            <div class="col-12 mb-3">
                                <label for="title">{{ __('Title') }} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                    </div>
                                    <input type="text" id="title" class="form-control form-control-sm" name="title"
                                        value="{{ old('title', $reward->title) }}" required>
                                </div>
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Dates --}}
                            <div class=" col-6 mb-3">
                                <label for="sdate">{{ __('Start Date') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="date" id="sdate" class="form-control form-control-sm"
                                        name="start_date" value="{{ old('start_date', $reward->start_date) }}" required>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="end_date">{{ __('End Date') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                    </div>
                                    <input type="date" id="end_date" class="form-control form-control-sm"
                                        name="end_date" value="{{ old('end_date', $reward->end_date) }}" required>
                                </div>
                            </div>

                            {{-- Reward Title / Amount / Target --}}


                            <div class="col-12">
                                <label>{{ __('Reward Details') }} <span class="text-danger">*</span></label>
                                <div id="reward-rows">
                                    @foreach ($reward->rewardDetails as $reward_detail)
                                        <div class="reward-row row mb-2">
                                            <div class="col-md-5">
                                                <input type="text" value="{{ $reward_detail->reward_title }}" name="reward_title[]"
                                                    class="form-control form-control-sm" placeholder="Reward Title"
                                                    required>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" value="{{ $reward_detail->reward_amount }}" step="0.01" name="reward_amount[]"
                                                    class="form-control form-control-sm" placeholder="Reward Amount"
                                                    required>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" value="{{ $reward_detail->target_amount }}" step="0.01" name="target_amount[]"
                                                    class="form-control form-control-sm" placeholder="Target Amount"
                                                    required>
                                            </div>
                                            <div class="col-md-1 d-flex justify-content-end">
                                                <button type="button" class="btn btn-success btn-sm add-row mr-1"><i
                                                        class="fas fa-plus"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm remove-row"><i
                                                        class="fas fa-minus"></i></button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class=" col-6 mb-3">
                                <label for="status">{{ __('Status') }} <span><span
                                            class="text-danger">*</span></span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                                    </div>
                                    <select id="status" name="status" class="form-control form-control-sm"required>
                                        <option value="active" {{ $reward->status == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="expired" {{ $reward->status == 'expired' ? 'selected' : '' }}>
                                            Expired</option>
                                        <option value="inactive" {{ $reward->status == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Image --}}
                            <div class="col-6 mb-3">
                                <label for="image">{{ __(' Image') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    </div>

                                    <input type="file" name="image" id="image"
                                        class="form-control form-control-sm up-img">
                                </div>

                                <img class="mw-400 mb-3 show-img img-demo mt-1" src="{{ asset($reward->image) }}"
                                    alt="" width="50px">

                                @if ($errors->has('image'))
                                    <p class="text-danger"> {{ $errors->first('image') }} </p>
                                @endif

                            </div>

                            {{-- Description --}}
                            <div class=" col-12 mb-3">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea id="description" class="form-control form-control-sm summernote" name="description" rows="3">{{ old('description', $reward->description) }}</textarea>
                            </div>

                            {{-- Submit --}}
                            <div class="form-group col-3">
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fas fa-save"></i> {{ __('Update Reward') }}
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.add-row', function() {
                let newRow = `<div class="reward-row row mb-2">
                <div class="col-md-5">
                    <input type="text" name="reward_title[]" class="form-control form-control-sm"
                        placeholder="Reward Title" required>
                </div>
                <div class="col-md-3">
                    <input type="number" step="0.01" name="reward_amount[]" class="form-control form-control-sm"
                        placeholder="Reward Amount" required>
                </div>
                <div class="col-md-3">
                    <input type="number" step="0.01" name="target_amount[]" class="form-control form-control-sm"
                        placeholder="Target Amount" required>
                </div>
                <div class="col-md-1 d-flex justify-content-end">
                    <button type="button" class="btn btn-success btn-sm add-row mr-1"><i class="fas fa-plus"></i></button>
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-minus"></i></button>
                </div>
            </div>`;
                $('#reward-rows').append(newRow);
            });

            $(document).on('click', '.remove-row', function() {
                if ($('#reward-rows .reward-row').length > 1) {
                    $(this).closest('.reward-row').remove();
                } else {
                    alert("At least one row is required!");
                }
            });
        });
    </script>
@endsection
