@extends("{$x}.layouts.index")
@section('dashboard')
{{-- @dd($hotel) --}}
<div class="page-content">
	<nav class="page-breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route("{$x}_all_hotels")}}">Hotel</a></li>
			<li class="breadcrumb-item active" aria-current="page">Detailes</li>
		</ol>
	</nav>
    
    <div class="row profile-body">
      <!-- left wrapper start -->

      <div class="col-md-8 col-xl-4 middle-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="card rounded">
              <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                  <div class="d-flex align-items-center">
                    <img class="img-xs rounded-circle" src="{{(!empty($hotel->hotel_owner->personal_photo)) ? url('storage/' .$hotel->hotel_owner->personal_photo) : url('backend/assets_/images/others/no_image.jpg')}}" alt="">													
                    <div class="ms-2">
                      <p>{{$hotel->hotel_owner->identity->first_name}}</p>
                      <p class="tx-11 text-muted"></p>
                    </div>
                  </div>
                  <div class="dropdown">
                    <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg pb-3px" data-feather="user"></i><span> Hote owner</span>
                    </a>
                    {{-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="meh" class="icon-sm me-2"></i> <span class="">Unfollow</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="corner-right-up" class="icon-sm me-2"></i> <span class="">Go to post</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="share-2" class="icon-sm me-2"></i> <span class="">Share</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="copy" class="icon-sm me-2"></i> <span class="">Copy link</span></a>
                    </div> --}}
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Full name:</label>
                  <p class="text-muted">{{$hotel->hotel_owner->identity->full_name}}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Sex:</label>
                  <p class="text-muted">{{$hotel->hotel_owner->identity->sex}}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Country:</label>
                  <p class="text-muted">{{$hotel->hotel_owner->identity->country}}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Governorate:</label>
                  <p class="text-muted">{{$hotel->hotel_owner->governorate}}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">City:</label>
                  <p class="text-muted">{{$hotel->hotel_owner->city}}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Street address:</label>
                  <p class="text-muted">{{$hotel->hotel_owner->street_address}}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">place of birth:</label>
                  <p class="text-muted">{{$hotel->hotel_owner->identity->place_of_birth}}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Identity number:</label>
                  <p class="text-muted">{{$hotel->hotel_owner->identity->identity_number}}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Issuing authority:</label>
                  <p class="text-muted">{{$hotel->hotel_owner->identity->issuing_authority}}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Identity type:</label>
                  <p class="text-muted">{{$hotel->hotel_owner->identity->identity_type}}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Date of issue:</label>
                  <p class="text-muted">{{$hotel->hotel_owner->identity->date_of_issue}}</p>
                </div>
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Date of expiry::</label>
                  <p class="text-muted">{{$hotel->hotel_owner->identity->date_of_expiry}}</p>
                </div>
              </div>
              <div class="card-footer">
                {{-- <div class="mt-3 d-flex social-links">
                  <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
                  </a>
                  <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                  </a>
                  <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                  </a>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="card rounded">
              <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                  <div class="d-flex align-items-center">
                    <img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
                    <div class="ms-2">
                      <p>{{$hotel->trade_name}}</p>
                      <p class="tx-11 text-muted"></p>
                    </div>
                  </div>
                  <div class="dropdown">
                    <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg pb-3px" data-feather="home"></i><span> Hote info</span>
                    </a>
                    {{-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="meh" class="icon-sm me-2"></i> <span class="">Unfollow</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="corner-right-up" class="icon-sm me-2"></i> <span class="">Go to post</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="share-2" class="icon-sm me-2"></i> <span class="">Share</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="copy" class="icon-sm me-2"></i> <span class="">Copy link</span></a>
                    </div> --}}
                  </div>
                </div>
              </div>
              <div class="card-body mt-0">
                <div class="mt-4">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Trade name:</label>
                  <p class="text-muted">{{$hotel->trade_name}}</p>
                </div>
                <div class="mt-4">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Situation:</label>
                  <p class="text-muted">{{$hotel->situation}}</p>
                </div>
                <div class="mt-4">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Name of owner building:</label>
                  <p class="text-muted">{{$hotel->name_owner_building}}</p>
                </div>
                <div class="mt-4">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Website:</label>
                  <p class="text-muted">{{$hotel->website}}</p>
                </div>
                <div class="mt-4">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Location:</label>
                  <p class="text-muted">{{$hotel->location}}</p>
                </div>
                <div class="mt-4">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Class:</label>
                  <p class="text-muted">{{$hotel->class}}</p>
                </div>
                <div class="mt-5">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Operator management:</label>
                  <p class="text-muted">{{$hotel->operator_management}}</p>
                </div>
                <div class="mt-5">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Number of Employee:</label>
                  <p class="text-muted">{{$hotel->number_of_employees}}</p>
                </div>
                <div class="mt-5">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Number of Employee:</label>
                  <p class="text-muted">{{$hotel->yemeni_employee}}</p>
                </div>
              </div>
              <div class="card-footer"></div>
            </div>
          </div>
        </div>
      </div>
      @auth('tourism_office')
      <div class="col-md-14 stretch-card mt-2">
        <div class="container">
          <div class="col-md-12">
              <div class="">
                <div class="card">
                  <div class="card-body">
                    <h6 class="card-title">All Rooms</h6>
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-bordered">
                      <thead class="table-white">
                          <tr>
                              <th>Number room</th>
                              <th>Category</th>
                              <th>Type</th>
                              <th>Floor</th>
                              <th>Price</th>
                              {{-- <th>Option</th> --}}
                          </tr>
                      </thead>
                          <tbody>  
                            
                            @foreach($hotel->rooms as $n => $room)
                            <tr>
                                <td class="sorting_1">{{$room->number}}</td>
                                <td>{{$room->category}}</td>
                                <td>{{$room->type}}</td>
                                <td>{{$room->floor}}</td>
                                <td>{{$room->price}}</td>
                                {{-- <td>
                                    <form action="{{route('delete_rooms',$room->id )}}" method="post">
                                        @csrf
                                        @method('DELETE') 
                                        <input type="text" name="hotel_id" value="{{$hotel->id}}" hidden>
                                        <button class="btn btn-danger me-1 link-icon"  type="submit">
                                            Delete
                                        </button>
                                    </form>
                              </td> --}}
                            </tr>
                            @endforeach
                    </tbody>
                  </table>
                </div>
                  </div>
                </div>
              </div>
          </div>
    
        </div>
      </div>
      <div class="col-md-14 stretch-card mt-2 mb-4">
        <div class="container">
          <div class="col-md-12">
              <div class="">
                <div class="card">
                  <div class="card-body">
                    <h6 class="card-title">All Documents</h6>
                    <div class="input-group flatpickr" id="flatpickr-date">
                      {{-- @dd($hotel->documents) --}}
                      {{-- <a href="/storage/{{$hotel->documents->last()->file}}" download class="form-control"  id="exampleInputUsername1" accept="application/pdf">
                        <img src="{{url('backend/assets_/images/others/2899-download-pdf.png')}}" width="42" height="62" alt="">
                        <label for="">Bill</label>
                      </a> --}}
                      <a href="/storage/{{$hotel->commercial_record}}" download class="form-control"  id="exampleInputUsername1" accept="application/pdf">
                        <img src="{{url('backend/assets_/images/others/2899-download-pdf.png')}}" width="42" height="62" alt="">
                        <label for="">Commercial Record</label>
                      </a>
                      <a href="/storage/{{$hotel->building_property}}" download class="form-control"  id="exampleInputUsername1" accept="application/pdf">
                        <img src="{{url('backend/assets_/images/others/2899-download-pdf.png')}}" width="42" height="62" alt="">
                        <label for="">Building Property</label>
                      </a>
                      <a href="/storage/{{$hotel->personal_card}}" download class="form-control"  id="exampleInputUsername1" accept="application/pdf">
                        <img src="{{url('backend/assets_/images/others/2899-download-pdf.png')}}" width="42" height="62" alt="">
                        <label for="">Personal  Card</label>
                      </a>
                      <a href="/storage/{{$hotel->hotel_owner->personal_photo}}" download class="form-control"  id="exampleInputUsername1" accept="application/pdf">
                        <img src="{{'/storage/'.$hotel->hotel_owner->personal_photo}}" width="42" height="62" alt="">
                        <label for="">Personal Photo</label>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
          </div>
    
        </div>
      </div>
      @endauth
        </div>
@endsection