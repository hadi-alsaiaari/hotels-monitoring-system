
@extends("{$x}.layouts.index")
@section('dashboard')
{{-- @dd($wanted_peoples) --}}
<div class="page-content">
    <div class="container">
          <div class="col-12">
              <div class="">
                <div class="card">
                  <div class="card-body">
                    <h6 class="card-title">Wanted People</h6>
                    <p class="card-description-left"></p>
                    <a style="position: absolute;right: 25px;" href="{{route("{$x}_trash.index")}}" class="btn btn-danger btn-icon-text"><i data-feather="trash"></i> <h6 style="color: white"><b>Trash</b></h6></a>
                    <br/><br/><br/>
                    <div class="row">
                      <div class="col-sm-5">
                      </div>
                    </div>
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-bordered">
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>Identity</th>
                              <th>Potential People</th>
                              <th>status</th>
                              <th>Option</th>
                          </tr>
                      </thead>
                      <tbody>
                        {{-- @dd($wanted_peoples) --}}
                        @foreach($wanted_peoples as $n => $w_p)
                       
                        <tr>
                            <td class="sorting_1">{{$w_p->first_name." ".$w_p->second_name." ".$w_p->third_name." ".$w_p->last_name}}</td>
                            <td>{{$w_p->identity_number}}</td>
                            <td>{{$w_p->guests_count}}</td>
                            <td>@if ($w_p->is_detection == 1)
                              <span class="label text-success d-flex"><div class="dot-label bg-success ml-1"></div><b>Detection</b></span>
                            @else
                            <span class="label text-danger d-flex"><div class="dot-label bg-success ml-1"></div>Not Detection</span>
                            @endif</td>
                            <td style="display:flex;">
                                {{-- <form action="{{route('wanted_people.show')}}" method="post" >
                                    @csrf
                                    <input type="text" name="wanted_people_id" value="{{$w_p->id}}" hidden>
                                    <button class="btn btn-warning me-1 link-icon"  type="submit">
                                      <i data-feather="eye" ></i>
                                    </button>
                                </form> --}}
                                @can('wanted-people.delete')
                                  <form action="{{route("{$x}_wanted_people.destroy",$w_p->id )}}" method="post" onsubmit="return submitForm(this);">
                                    @csrf
                                    <input type="text" name="wanted_people_id" value="{{$w_p->id}}" hidden>
                                    <button class="btn btn-danger me-1 link-icon"  type="submit">
                                      <i data-feather="trash" ></i>
                                    </button>
                                  </form>
                              @endcan
                              @can('wanted-people.view')
                                <a href="{{route("{$x}_wanted_people.show",$w_p->id )}}" class="btn btn-warning me-1 link-icon btn-xs"><i data-feather="eye" ></i></a>
                              @endcan
                                {{-- <a href="{{route('wanted_people.destroy',$w_p->id )}}" class="btn btn-danger me-1 link-icon btn-xs"><i data-feather="trash"></i></a> --}}
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