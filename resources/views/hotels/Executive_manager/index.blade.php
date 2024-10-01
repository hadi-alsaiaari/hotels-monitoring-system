
@extends('hotels.layouts.index')
@section('dashboard')
<div class="page-content">
  <div class=" d-md-block col-md-4 col-xl-12 left-wrapper">
        <div class="card rounded">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-10" >
                <h6 class="card-title">EXECUTIVE MANAGER</h6>
              </div>
              <div class="col-sm-1">
                @if (empty($hotel_executive_manager))
                
                  <a href="{{route('create_EM')}}" class="btn btn-primary me-1 link-icon btn-xs" ><span><h5>Create</h5></span></a>
                @else
                <form action="{{route('create_EM')}}" onsubmit="return submitForm(this)";>
                  <button type="submit" class="btn btn-warning me-1 link-icon btn-xs"><span><h5>Change</h5></span></button>
                </form>
                  {{-- <a href="{{route('create_EM')}}" class="btn btn-warning me-1 link-icon btn-xs"><span><h5>Change</h5></span></a> --}}
                @endif
              </div>
              @if (!empty($hotel_executive_manager))
              <div class="col-sm-5">
              </div>
              <div class="col-sm-7">
                  <div class="align-items-center justify-content-between mb-2">
                      <img class="wd-100 rounded-circle"
                          src="{{ !empty($hotel_executive_manager->image) ? url('upload/hotels_image/' . $hotel_executive_manager->image) : url('backend/assets_/images/others/no_image.png') }}"
                          alt="profile">
                      <span class="ms-3 fw-bolder text-uppercase card-title">{{ $hotel_executive_manager->identity->first_name }}</span>
                  </div>
              </div>
              <div class="col-sm-3">
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Full Name:</label>
                  <p class="text-muted">{{$hotel_executive_manager->identity->full_name}}</p>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Country:</label>
                  <p class="text-muted">{{$hotel_executive_manager->identity->country}}</p>
                </div>
              </div>
              <div class="col-sm-2 mb-3">
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Place of Birth:</label>
                  <p class="text-muted">{{$hotel_executive_manager->identity->place_of_birth}}</p>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Date of Birth:</label>
                  <p class="text-muted">{{$hotel_executive_manager->identity->date_of_birth}}</p>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Sex:</label>
                  <p class="text-muted">{{$hotel_executive_manager->identity->sex}}</p>
                </div>
              </div>
              <hr>
              <div class="col-sm-3 mb-3">
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Identity Number:</label>
                  <p class="text-muted">{{$hotel_executive_manager->identity->identity_number}}</p>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Identity Type:</label>
                  <p class="text-muted">{{$hotel_executive_manager->identity->identity_type}}</p>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Issuing Authority:</label>
                  <p class="text-muted">{{$hotel_executive_manager->identity->issuing_authority}}</p>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Date of Issue:</label>
                  <p class="text-muted">{{$hotel_executive_manager->identity->date_of_issue}}</p>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="mt-3">
                  <label class="tx-11 fw-bolder mb-0 text-uppercase">Date of Expiry:</label>
                  <p class="text-muted">{{$hotel_executive_manager->identity->date_of_expiry}}</p>
                </div>
              </div>
              @endif
          </div>
          </div>
        </div>
      </div>
    {{-- <div class="container">
          <div class="col-12">
              <div class="">
                <div class="card">
                  <div class="card-body">
                    <h6 class="card-title">EXECUTIVE MANAGER</h6>
                    <p class="card-description">All Executive Manager </p>
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-bordered">
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>Identity Number</th>
                              <th>sex</th>
                              <th>Education Level</th>
                              <th>Work License Number</th>
                              <th>Option</th>
                          </tr>
                      </thead>
                      <tbody>
                        
                        @foreach($hotel_executive_managers as $n => $hotel_em)
                        <tr>
                            <td class="sorting_1">{{$hotel_em->identity->full_name}}</td>
                            <td>{{$hotel_em->identity->identity_number}}</td>
                            <td>{{$hotel_em->identity->sex}}</td>
                            <td>{{$hotel_em->education_level}}</td>
                            <td>{{$hotel_em->work_license_number}}</td>
                            <td>
                              <a href="" class="btn btn-warning me-1 link-icon btn-xs"><i data-feather="eye" ></i></a>
                              <a href="{{route('delete_R',$hotel_em->id )}}" class="btn btn-danger me-1 link-icon btn-xs"><i data-feather="trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                </div>
                  </div>
                </div>
              </div>
          </div>
    </div> --}}
    </div>
    <script>

      function submitForm(form) {
      
      swal.fire({
      title: "Are you sure?",
      text: "When the Executive Manager changes, he will delete the current Executive Manager ",
      icon: "warning",
      buttons: true,
      dangerMode: true,
      showCancelButton: true,
      })
        .then(function (result) {
          if (result.value) {
            form.submit();
                }
      
      });
      
      return false;
      
    }
      
      </script>
@endsection