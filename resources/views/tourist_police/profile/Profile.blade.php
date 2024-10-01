

@extends('tourist_police.layouts.index')
@section('dashboard')


<div class="page-content">

    <div class="row profile-body">
      <!-- left wrapper start -->
      <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
        <div class="card rounded">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-2">
              {{-- <div>
                @dd($identity->name)
                <img class="wd-100 rounded-circle" src="{{(!empty($TourismOffice->personal_photo)) ? url('upload/hotels_image/' .$hotel_owner->image) : url('backend/assets_/images/others/no_image.jpg')}}" alt="profile">
                <span class="ms-3 fw-bolder text-uppercase card-title"></span>
              </div>  --}}
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
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Full Name:</label>
              <p class="text-muted">{{$identity->full_name}}</p>
            </div>
            <div class="mt-3">
                <label class="tx-11 fw-bolder mb-0 text-uppercase">Identity Number:</label>
                <p class="text-muted">{{$identity->identity_number}}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Identity Type:</label>
              <p class="text-muted">{{$identity->identity_type}}</p>
          </div>
            <div class="mt-3">
                <label class="tx-11 fw-bolder mb-0 text-uppercase">Sex:</label>
                <p class="text-muted">{{$identity->sex}}</p>
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
      </div>
      <!-- left wrapper end -->
      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
            <div class="card">
            <div class="card-body">

                <h6 class="card-title">Update Profile</h6>

                {{-- <form class="forms-sample" method="POST" action="{{route('profile_h.edit_nav')}}" enctype="multipart/form-data">
                    @csrf 
                    <div class="mb-3">
                        <label for="exampleInputUsername1" class="form-label">Username</label>
                        <input type="text" name="name" class="form-control" id="exampleInputUsername1" autocomplete="off" value="{{$user->name}}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="{{$user->email}}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Governorate</label>
                        <input type="text" name="governorate" class="form-control" id="exampleInputEmail1" placeholder="Governorate" value="{{$hotel_owner->governorate}}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">City</label>
                        <input type="text" name="city" class="form-control" id="exampleInputEmail1" placeholder="City" value="{{$hotel_owner->city}}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Street Address</label>
                        <input type="text" name="street_address" class="form-control" id="exampleInputEmail1" placeholder="street_address" value="{{$hotel_owner->street_address}}">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Image</label>
                    <input class="form-control" type="file" name="image" id="image" >
                    </div>
                    <div class="mb-3">
                    <img class="wd-100 rounded-circle" id="showimage" src="{{(!empty($hotel_owner->image)) ? url('upload/hotels_image/' .$hotel_owner->image) : url('backend/assets_/images/others/no_image.jpg')}}" alt="profile">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Save Change</button>
                    <button class="btn btn-secondary">Cancel</button>
                </form> --}}
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                  @csrf
              </form>
          
              <form method="post" action="{{ route('profile_to.update') }}" class="mt-3 space-y-6">
                  @csrf
                  @method('patch')

                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">{{__('Name')}}</label>
                    <input  name="name" class="form-control" id="exampleInputEmail1" type="text" >
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                  </div>

                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">{{__('Email')}}</label>
                    <input  name="email" class="form-control" id="exampleInputEmail1" type="text" >
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                      @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                          <div>
                              <p class="text-sm mt-2 text-gray-800">
                                  {{ __('Your email address is unverified.') }}
          
                                  <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                      {{ __('Click here to re-send the verification email.') }}
                                  </button>
                              </p>
          
                              @if (session('status') === 'verification-link-sent')
                                  <p class="mt-2 font-medium text-sm text-green-600">
                                      {{ __('A new verification link has been sent to your email address.') }}
                                  </p>
                              @endif
                          </div>
                      @endif
                  </div>

                  {{-- <div>
                      <x-input-label for="name" :value="__('Name')" />
                      <x-text-input id="name" name="name" class="form-control" id="exampleInputEmail1" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                      <x-input-error class="mt-2" :messages="$errors->get('name')" />
                  </div>
          
                  <div>
                      <x-input-label for="email" :value="__('Email')" />
                      <x-text-input id="email" name="email" class="form-control" id="exampleInputEmail1" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                      <x-input-error class="mt-2" :messages="$errors->get('email')" />
          
                      
                  </div> --}}
          
                  <div class="flex items-center gap-4">
                    <button type="submit" class="btn btn-primary me-2">Save Change</button>
          
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
      <!-- middle wrapper end -->
      <!-- right wrapper start -->
      
      <!-- right wrapper end -->
    </div>

        </div>

        <script >
          $(document).redy(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showimage').attr('src',e.target.result);
                }
                  reader.readAsDataURL(e.target.files['0']);
            });
          });
        </script>
        
@endsection