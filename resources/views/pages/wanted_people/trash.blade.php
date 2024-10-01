
@extends("{$x}.layouts.index")
@section('dashboard')
{{-- @dd($wanted_peoples) --}}
<div class="page-content">
  <nav class="page-breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route("{$x}_wanted_people_all.index")}}">Wanted People</a></li>
			<li class="breadcrumb-item active" aria-current="page">Trash</li>
		</ol>
	</nav>
    <div class="container">
          <div class="col-12">
              <div class="">
                <div class="card">
                  <div class="card-body">
                    <h6 class="card-title">Trash</h6>
                    <p class="card-description-left"></p>
                    <div class="row">
                      <div class="col-sm-5">
                      </div>
                    </div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered">
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
                                Detection
                            @else
                                Not Detection
                            @endif</td>
                            <td style="display:flex;">
                              @can('wanted-people.restore')
                                <form action="{{route("{$x}_trash.restore")}}" method="post" >
                                    @csrf
                                    <input type="text" name="wanted_people_id" value="{{$w_p->id}}" hidden>
                                    <button class="btn btn-warning me-1 link-icon"  type="submit">
                                      <i data-feather="upload" ></i>
                                    </button>
                                </form>
                              @endcan  
                              @can('wanted-people.force-delete')
                                <form action="{{route("{$x}_trash.forceDelete",$w_p->id )}}" method="post" onsubmit="return submitForm(this);">
                                  @csrf
                                  <input type="text" name="wanted_people_id" value="{{$w_p->id}}" hidden>
                                  <button class="btn btn-danger me-1 link-icon"  type="submit">
                                    <i data-feather="trash" ></i>
                                  </button>
                                </form>
                              @endcan
                                {{-- <a href="{{route('wanted_people.show',$w_p->id )}}" class="btn btn-warning me-1 link-icon btn-xs"><i data-feather="eye" ></i></a> --}}
                                {{-- <a href="{{route('wanted_people_trash.forceDelete',$w_p->id )}}" class="btn btn-danger me-1 link-icon btn-xs"><i data-feather="trash"></i></a> --}}
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