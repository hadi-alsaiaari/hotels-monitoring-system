@extends("{$x}.layouts.index")
@section('dashboard')
<div class="page-content">
{{-- @dd($potential_peoples) --}}
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route("{$x}_wanted_people_all.index")}}">Wanted People</a></li>
        <li class="breadcrumb-item active" aria-current="page">Show</li>
    </ol>
</nav>
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
                                <img class="wd-100 rounded-circle"
                                    src="url('backend/assets_/images/others/no_image.png')"
                                    alt="profile">
                                {{-- <span class="ms-3 fw-bolder text-uppercase card-title">{{ $w_p->first_name }}</span> --}}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mt-3">
                                <label class="tx-11 fw-bolder mb-0 text-uppercase">First Name:</label>
                                <p class="text-muted">{{ $wanted_people->first_name }}</p>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="mt-3">
                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Second Name:</label>
                                <p class="text-muted">{{ $wanted_people->second_name }}</p>
                            </div>
                        </div>
                        <div class="col-sm-2 mb-3">
                            <div class="mt-3">
                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Third Name::</label>
                                <p class="text-muted">{{ $wanted_people->third_name }}</p>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="mt-3">
                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Last Name::</label>
                                <p class="text-muted">{{ $wanted_people->last_name }}</p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mt-3">
                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Identity:</label>
                                <p class="text-muted">{{ $wanted_people->identity_number }}</p>
                            </div>
                        </div>
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
                        <h6 class="card-title">All Potential Peoples</h6>
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered">
                          <thead class="table-white">
                              <tr>
                                  {{-- <th>ID</th> --}}
                                  <th>Name</th>
                                  <th>Hotel Name</th>
                                  <th>Room Number</th>
                                  <th>Accommodation Number</th>
                                  <th>Detection At</th>
                                  <th>Option</th>
                              </tr>
                          </thead>
                              <tbody>  
                                @if (!empty($potential_peoples))
                                  
                                @foreach($potential_peoples as $n => $p_p)
                                <tr>
                                    {{-- <td class="sorting_1">{{$n}}</td> --}}
                                    <td>{{$p_p['full_name']}}</td>
                                    <td>{{$p_p['hotel_name']}}</td>
                                    <td>{{$p_p['room_number']}}</td>
                                    <td>{{$p_p['accommodation_number']}}</td>
                                    <td>{{$p_p['detection_at']}}</td>
                                    <td style="display:flex;">
                                        @can('wanted-people.sure-detection')
                                            <form action="{{route("{$x}_potential_people.sure")}}" method="post" >
                                                @csrf
                                                
                                                <input type="number" name="wanted_people_id" value="{{$wanted_people->id}}" hidden>
                                                <input type="number" name="accommodation_details_id" value="{{$p_p['id']}}" hidden>
                                                <button class="btn btn-success me-1 link-icon"  type="submit">
                                                <i data-feather="check-square" ></i>
                                                </button>
                                            </form>
                                        @endcan
                                        @can('wanted-people.delete-potential-people')    
                                            <form action="{{route("{$x}_potential_people.delete")}}" method="post" onsubmit="return submitForm(this);">
                                            @csrf
                                            @method('DELETE')
                                            <input type="number" name="wanted_people_id" value="{{$wanted_people->id}}" hidden>
                                            <input type="number" name="accommodation_details_id" value="{{$p_p['id']}}" hidden>
                                            <button class="btn btn-danger me-1 link-icon"  type="submit">
                                                <i data-feather="trash" ></i>
                                            </button>
                                            </form>
                                        @endcan    
                                        {{-- <a href="{{route('potential_people.sure',$p_p['id'])}}" class="btn btn-warning me-1 link-icon btn-xs"><i data-feather="check-square" ></i></a> --}}
                                        {{-- <a href="{{route('wanted_people_trash.forceDelete',$w_p->id )}}" class="btn btn-danger me-1 link-icon btn-xs"><i data-feather="trash"></i></a> --}}
                                  </td>
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
    </div>
</div>

<script>
    function submitForm(form) {
      
      swal.fire({
      title: "Are you sure?",
      text: "",
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
