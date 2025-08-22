@extends('front.layouts.master')
@section('title', 'Edit Profile')

@section('content')
<section class="account padding-top padding-bottom sec-bg-color2">
  <div class="container py-4">
    <div class="row g-4">

      <!-- LEFT: LIST (User Info Preview) -->
      @include('front.partials._user-profile-sidebar')

      <!-- RIGHT: FORM (Edit Profile) -->
      <div class="col-md-8">
        <div class="account__content account__content--style1 border p-3 rounded">
          <form action="{{ route('front.ProfileUpdate') }}" method="POST" enctype="multipart/form-data" class="account__form needs-validation" novalidate>
            @csrf

            <div class="row g-3">
              <!-- First Name -->
              <div class="col-md-6">
                <label for="first-name" class="form-label">First name <span class="text-danger">*</span></label>
                <input type="text" 
                       name="first_name" 
                       id="first-name" 
                       value="{{ old('first_name', $profile->first_name ?? '') }}" 
                       class="form-control @error('first_name') is-invalid @enderror" 
                       placeholder="Ex. John">
                @error('first_name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Last Name -->
              <div class="col-md-6">
                <label for="last-name" class="form-label">Last name <span class="text-danger">*</span></label>
                <input type="text" 
                       name="last_name" 
                       id="last-name" 
                       value="{{ old('last_name', $profile->last_name ?? '') }}" 
                       class="form-control @error('last_name') is-invalid @enderror" 
                       placeholder="Ex. Doe">
                @error('last_name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Profile Image -->
              <div class="col-md-6">
                <label for="profile_image" class="form-label">Profile Image</label>
                <input type="file" 
                       name="profile_image" 
                       id="profile_image" value="{{ $profile->profile_image ?? '' }}"
                       class="form-control @error('profile_image') is-invalid @enderror">
                @error('profile_image')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- WhatsApp Number -->
              <div class="col-md-6">
                <label for="whatsapp_no" class="form-label">WhatsApp No</label>
                <input type="text" 
                       name="whatsapp_no" 
                       id="whatsapp_no" 
                       value="{{ old('whatsapp_no', $profile->whatsapp_no ?? '') }}" 
                       class="form-control @error('whatsapp_no') is-invalid @enderror" 
                       placeholder="+92 300 1234567">
                @error('whatsapp_no')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Country -->
              <div class="col-md-6">
                <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                <input type="text" 
                       name="country" 
                       id="country" 
                       value="{{ old('country', $profile->country ?? '') }}" 
                       class="form-control @error('country') is-invalid @enderror" 
                       placeholder="Enter Country">
                @error('country')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- City -->
              <div class="col-md-6">
                <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                <input type="text" 
                       name="city" 
                       id="city" 
                       value="{{ old('city', $profile->city ?? '') }}" 
                       class="form-control @error('city') is-invalid @enderror" 
                       placeholder="Enter City">
                @error('city')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <!-- Address -->
              <div class="col-md-12">
                <label for="address" class="form-label">Address</label>
                <input type="text" 
                       name="address" 
                       id="address" 
                       value="{{ old('address', $profile->address ?? '') }}" 
                       class="form-control @error('address') is-invalid @enderror" 
                       placeholder="Enter Address">
                @error('address')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <!-- Submit -->
            <button type="submit" 
                    class="trk-btn trk-btn--border trk-btn--primary mt-3 d-block">
              Update Profile
            </button>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection
