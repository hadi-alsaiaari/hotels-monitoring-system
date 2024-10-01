@extends('hotels.layouts.index')
@section('dashboard')
<div class="page-content">

    <div class="row profile-body">
      <!-- left wrapper start -->
      {{-- <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
        <div class="card rounded">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <div>
                <img class="wd-100 rounded-circle" src="{{(!empty($hotel_owner->image)) ? url('upload/hotels_image/' .$hotel_owner->image) : url('backend/assets_/images/others/no_image.jpg')}}" alt="profile">
                <span class="h4 ms-3 text-white">{{$user->name}}</span>
              </div> 
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">User Name:</label>
              <p class="text-muted">{{$user->name}}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
              <p class="text-muted">{{$user->email}}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Governorate:</label>
              <p class="text-muted">{{$hotel_owner->governorate}}</p>
            </div>
            <div class="mt-3">
                <label class="tx-11 fw-bolder mb-0 text-uppercase">City:</label>
                <p class="text-muted">{{$hotel_owner->city}}</p>
            </div>
            <div class="mt-3">
                <label class="tx-11 fw-bolder mb-0 text-uppercase">Street Address:</label>
                <p class="text-muted">{{$hotel_owner->street_address}}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Status:</label>
              <p class="text-muted">{{$user->status}}</p>
            </div>
            <div class="mt-3 d-flex social-links">
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="github"></i>
              </a>
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="twitter"></i>
              </a>
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="instagram"></i>
              </a>
            </div>
          </div>
        </div>
      </div> --}}
      <!-- left wrapper end -->
      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-12 middle-wrapper">
        <div class="row">
            <div class="card">
            <div class="card-body">

                <h6 class="card-title">Update Password</h6>
      {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form> --}}

    <form method="post" action="{{ route('profile_h.update') }}" class=" space-y-6">
        @csrf
        @method('patch')

        <div class="mb-3">
          <label for="name" class="form-label">{{__('Name')}}</label>
          <input type="text" name="name" class="form-control" :value="old('name', $user->name)" required autofocus autocomplete="name">
          <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        {{-- <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div> --}}
        <div class="mb-3">
          <label for="name" class="form-label">{{__('Email')}}</label>
          <input type="email" name="email" class="form-control" :value="old('email', $user->email)" required autocomplete="username">
          <x-input-error class="mt-2" :messages="$errors->get('email')" />
            
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="btn btn-primary me-2">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
  </div>
</div>
</div>
</div>

      <div class="col-md-8 col-xl-12 middle-wrapper mt-3">
        <div class="row">
            <div class="card">
            <div class="card-body">

                <h6 class="card-title">Update Password</h6>

                <form method="post" action="{{ route('user-password.update') }}" class="mt-3 space-y-6">
                    @csrf
                    @method('put')
 
                    <div class="mb-3">
                        <label for="update_password_password" class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control" id="update_password_password" placeholder="Current Password" autocomplete="current-password">
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label for="update_password_password" class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control" id="update_password_password" placeholder="New Password"  autocomplete="new-password">
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                      <label for="update_password_password_confirmation" class="form-label">Confirm Password</label>
                      <input type="password" name="password_confirmation" class="form-control" id="update_password_password" placeholder="New Password"  autocomplete="new-password">
                      <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                  </div>
            
                    <div class="">
                        <x-primary-button class="btn btn-primary me-2">{{ __('Save Change') }}</x-primary-button>
            
                        @if (session('status') === 'password-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600"
                            >{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </form>

            </div>
            </div>
        </div>
      </div>
      <!-- middle wrapper end -->
      <!-- right wrapper start -->
      
      <!-- right wrapper end -->
    </div>

        </div>
@endsection