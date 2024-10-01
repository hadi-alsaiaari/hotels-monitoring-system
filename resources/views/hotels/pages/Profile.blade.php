@extends('hotels.layouts.index')
@section('dashboard')


    <div class="page-content">

        <div class="row profile-body">
            <!-- left wrapper start -->
            <div class=" d-md-block col-md-4 col-xl-12 left-wrapper">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                            </div>
                            <div class="col-sm-7">
                                <div class="align-items-center justify-content-between mb-2">
                                    
                                    <span class="ms-3 fw-bolder text-uppercase card-title"></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Full Name:</label>
                                    <p class="text-muted">{{ $hotel_user->identity->full_name }}</p>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Country:</label>
                                    <p class="text-muted">{{ $hotel_user->identity->country }}</p>
                                </div>
                            </div>
                            <div class="col-sm-2 mb-3">
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Place of Birth:</label>
                                    <p class="text-muted">{{ $hotel_user->identity->place_of_birth }}</p>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Date of Birth:</label>
                                    <p class="text-muted">{{ $hotel_user->identity->date_of_birth }}</p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Sex:</label>
                                    <p class="text-muted">{{ $hotel_user->identity->sex }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="col-sm-3 mb-3">
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Identity Number:</label>
                                    <p class="text-muted">{{ $hotel_user->identity->identity_number }}</p>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Identity Type:</label>
                                    <p class="text-muted">{{ $hotel_user->identity->identity_type }}</p>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Issuing Authority:</label>
                                    <p class="text-muted">{{ $hotel_user->identity->issuing_authority }}</p>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Date of Issue:</label>
                                    <p class="text-muted">{{ $hotel_user->identity->date_of_issue }}</p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Date of Expiry:</label>
                                    <p class="text-muted">{{ $hotel_user->identity->date_of_expiry }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="col-sm-3">
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                                    <p class="text-muted">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Governorate:</label>
                                    <p class="text-muted">{{ $hotel_user->governorate }}</p>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">City:</label>
                                    <p class="text-muted">{{ $hotel_user->city }}</p>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Street Address:</label>
                                    <p class="text-muted">{{ $hotel_user->street_address }}</p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Status:</label>
                                    <p class="text-muted">{{ $user->status }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-10 col-xl-11 middle-wrapper m-4">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Update Profile</h6>
                            <form class="forms-sample" method="POST" action="{{ route('profile_h.edit_nav') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Governorate</label>
                                    <input type="text" name="governorate" class="form-control" id="exampleInputEmail1"
                                        placeholder="Governorate" value="{{ $hotel_user->governorate }}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">City</label>
                                    <input type="text" name="city" class="form-control" id="exampleInputEmail1"
                                        placeholder="City" value="{{ $hotel_user->city }}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Street Address</label>
                                    <input type="text" name="street_address" class="form-control"
                                        id="exampleInputEmail1" placeholder="street_address"
                                        value="{{ $hotel_user->street_address }}">
                                </div>
                                

                                <button type="submit" class="btn btn-primary me-2">Save Change</button>
                                <button class="btn btn-danger">Cancel</button>
                            </form>
                            @if (!empty($hotel_user->phone_numbers))
                                    <hr>
                                    <div class="row">
                                        <label for="exampleInputEmail1" class="form-label">Phone Number</label><br>
                                        @foreach ($hotel_user->phone_numbers as $number => $phone)
                                        <div class="col-sm-11">
                                            <input type="text" name="phone_number[$number]" 
                                                placeholder="Phone Number" class="form-control"
                                                value="{{ $phone->phone_number }}">
                                        </div>
                                        <div class="col-sm-1 mb-2">
                                            <a href="{{ route('destroy_phone_number', $phone->id) }}"
                                                class="btn btn-danger btn-icon"
                                                style=""><i data-feather="trash"></i></a>
                                        </div>
                                        @endforeach
                                        @if ($number <= 3)
                                            <form action="{{ route('add_phone_number') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-sm-8">
                                                    <input type="text" name="phone_number" class="form-control" placeholder="Enter Phone Number">
                                                </div>
                                                <div class="col-sm-1">
                                                <button type="submit" class="btn btn-warning btn-icon"><i data-feather="plus"></i></button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->

            <!-- right wrapper end -->
        </div>

    </div>

    <script>
        // $(document).redy(function(){
        //   $('#image').change(function(e){
        //       var reader = new FileReader();
        //       reader.onload = function(e){
        //           $('#showimage').attr('src',e.target.result);
        //       }
        //         reader.readAsDataURL(e.target.files['0']);
        //   });
        // });
    </script>

@endsection
