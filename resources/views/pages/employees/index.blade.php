@extends("{$x}.layouts.index")
@section('dashboard')
<div class="page-content">
{{-- @dd($user) --}}
    <div class="container">
          <div class="col-12">
              <div class="">
                <div class="card">
                  <div class="card-body">
                    <h6 class="card-title">All Employyes</h6>
                    <p class="card-description"></p>
                <div class="table-responsive">
                  <table id="example" class="table table-hover table-bordered">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Identity</th>
                              <th>Job</th>
                              <th>Option</th>
                          </tr>
                      </thead>
                      <tbody>
                        
                        @if ($user)

                        @foreach($user as $n => $employee)
                        <tr>
                            <td class="sorting_1">{{$n+1}}</td>
                            <td >{{$employee->identity->full_name}}</td>
                            <td>{{$employee->identity->identity_number}}</td>
                            <td>{{!empty($employee->role->name) ? $employee->role->name : 'nothing'}}</td>
                            <td>
                              @can('employees.update')
                                <a href="{{route("{$x}_edit_employees",$employee->id)}}" class="btn btn-warning me-1 link-icon btn-xs"><i data-feather="edit" ></i></a>
                              @endcan
                              @can('employees.delete')
                                <a href="{{route("{$x}_employees.destroy",$employee->id)}}" class="btn btn-danger me-1 link-icon btn-xs"><i data-feather="trash"></i></a>
                              @endcan
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
@endsection