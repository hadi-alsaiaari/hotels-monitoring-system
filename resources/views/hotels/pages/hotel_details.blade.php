@extends('hotels.layouts.index')
@section('dashboard')
{{-- @dd($hotel) --}}
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
                  {{-- <div class="d-flex align-items-center">
                    <img class="wd-150 rounded-circle"src="{{ !empty($hotel_user->image) ? url('upload/hotels_image/' . $hotel_user->image) : url('backend/assets_/images/others/al-sallam.jpg') }}"alt="profile">
                    <div class="ms-2">
                      <span class="ms-3 fw-bolder text-uppercase card-title">{{$hotel->trade_name}}</span>
                      <p class="tx-11 text-muted"></p>
                    </div>
                  </div> --}}
                </div> 
              </div>
              @if (!empty($hotel))
                <label class="tx-14 fw-bolder mb-1 text-uppercase"><i data-feather="home"></i> Hotel Information </label>
                <div class="col-sm-4">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Trade Name:</label>
                    <p class="text-muted">{{$hotel->trade_name}}</p>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Situation:</label>
                    <p class="text-muted">{{$hotel->situation}}</p>
                  </div>
                </div>
                <div class="col-sm-3 mb-3">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Name of owner building:</label>
                    <p class="text-muted">{{$hotel->name_owner_building}}</p>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Website:</label>
                    <p class="text-muted">{{$hotel->website}}</p>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Location:</label>
                    <p class="text-muted">{{$hotel->location}}</p>
                  </div>
                </div>
                <div class="col-sm-3 mb-3">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Star:</label>
                    <p class="text-muted">{{$hotel->class}}</p>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Operator Management:</label>
                    <p class="text-muted">{{$hotel->operator_management}}</p>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Number Of Employees:</label>
                    <p class="text-muted">{{$hotel->number_of_employees}}</p>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Yemeni Employee:</label>
                    <p class="text-muted">{{$hotel->yemeni_employee}}</p>
                  </div>
                </div>
                @endif
                <hr class="mt-3">
              @if (!empty($hotel->hotel_executive_managers))
                    
                @foreach ($hotel->hotel_executive_managers as $h_e_m)
                <label class="tx-14 fw-bolder mb-0 text-uppercase mt-3"><i data-feather="user"></i>Executive Manager </label>
                <div class="col-sm-4">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Full Name:</label>
                    <p class="text-muted">{{$h_e_m->identity->full_name}}</p>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Country:</label>
                    <p class="text-muted">{{$h_e_m->identity->country}}</p>
                  </div>
                </div>
                <div class="col-sm-3 mb-3">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Place of Birth:</label>
                    <p class="text-muted">{{$h_e_m->identity->place_of_birth}}</p>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Date of Birth:</label>
                    <p class="text-muted">{{$h_e_m->identity->date_of_birth}}</p>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Sex:</label>
                    <p class="text-muted">{{$h_e_m->identity->sex}}</p>
                  </div>
                </div>
                <div class="col-sm-3 mb-3">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Identity Number:</label>
                    <p class="text-muted">{{$h_e_m->identity->identity_number}}</p>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Identity Type:</label>
                    <p class="text-muted">{{$h_e_m->identity->identity_type}}</p>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Issuing Authority:</label>
                    <p class="text-muted">{{$h_e_m->identity->issuing_authority}}</p>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Date of Issue:</label>
                    <p class="text-muted">{{$h_e_m->identity->date_of_issue}}</p>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Date of Expiry:</label>
                    <p class="text-muted">{{$h_e_m->identity->date_of_expiry}}</p>
                  </div>
                </div>
                @endforeach
                @endif
          </div>
          </div>
        </div>
      </div>
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
                            @if (!empty($hotel->rooms))
                              
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
                            @endif
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
        </div>
@endsection