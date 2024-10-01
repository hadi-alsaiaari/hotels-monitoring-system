@extends("{$x}.layouts.index")
@section('dashboard')
<div class="page-content">
    <div class="container">
          <div class="col-12">
              <div class="">
                <div class="card">
                  <div class="card-body">
                    <div class="container-fluid d-flex justify-content-between">
                        <div class="col-lg-3 ps-0">
                          <h6 class="card-title">All Jobs</h6>
                        </div>
        
                        <div class="col-lg-1 mb-3 pe-0">
                          
                            <a href="{{route("{$x}_roles_create.create")}}"  class="btn btn-primary me-4 link-icon btn-xs" ><span style="font-size: 13px;">Add</span></a>
        
                        </div>
                      </div>
                    <div class="row">
                      <div class="col-sm-5">
                      </div>
                    </div>
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-bordered">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Job Title</th>
                              <th>Option</th>

                          </tr>
                      </thead>
                      <tbody>
                        {{-- @dd($wanted_peoples) --}}
                        @foreach($roles as $n => $role)
                       
                        <tr>
                            <td class="sorting_1">{{$n+1}}</td>
                            <td>{{$role->name}}</td>
                            <td style="display:flex;">
                                {{-- <form action="{{route('roles_edit.edit')}}" method="post" >
                                    @csrf
                                    <input type="text" name="id" value="{{$role->id}}" hidden>
                                    <button class="btn btn-warning me-1 link-icon"  type="submit">
                                      <i data-feather="eye" ></i>
                                    </button>
                                </form> --}}
                                <form action="{{route("{$x}_roles.destroy",$role->id)}}" method="post" >
                                  @csrf
                                  @method('delete')
                                  <button class="btn btn-danger me-1 link-icon"  type="submit">
                                    <i data-feather="trash" ></i>
                                  </button>
                                </form>
                                    <a href="{{route("{$x}_roles_edit.edit",$role->id )}}" class="btn btn-warning me-1 link-icon btn-xs"><i data-feather="eye" ></i></a>
                                {{-- <a href="{{route('roles.destroy',$role->id )}}" class="btn btn-danger me-1 link-icon btn-xs"><i data-feather="trash"></i></a> --}}
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

@endsection