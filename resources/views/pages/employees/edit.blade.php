@extends("{$x}.layouts.index")
@section('dashboard')
<div class="page-content">
  {{-- @dd($user_role); --}}
    <div class=" d-md-block col-md-4 col-xl-12 left-wrapper">
          <div class="card rounded">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-10" >
                  <h6 class="card-title">Employee</h6>
                </div>
                <div class="col-sm-5">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
                    <p class="text-muted">{{$user->identity->full_name}}</p>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Identity:</label>
                    <p class="text-muted">{{$user->identity->identity_number}}</p>
                  </div>
                </div>
                <div class="col-sm-2 mb-3">
                  <div class="mt-3">
                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Job:</label>
                    <p class="text-muted">{{$user_role}}</p>
                  </div>
                </div>
            </div>
            </div>
          </div>
        </div>
        <div class="col-md-14 mt-3 stretch-card" >
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Edit with Jops</h6>
                  <form action="{{route("{$x}_employees_update.update",$user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf 
    
                    {{-- <div class="col-sm-12">
                      <div class="mb-3">
                        <label class="form-label">jobsName</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter jobsName" value="{{$user_role}}" required>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                    </div> --}}
    
                    <div class="row mb-3">
                      <div class="col-sm-2 mt-3">
                        <div class="mb-3">
                          <label class="form-label">jobsName</label>
                          <select name="role_id" class="js-example-basic-single form-select" data-width="50%">
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      
                    </div><!-- Row -->
                    <button type="submit" class="btn btn-primary submit">Update</button>
                    <a href="{{route("{$x}_roles_all.index")}}" class="btn btn-danger me-1 link-icon" >
                      Cancel 
                    </a>
                  </form>
              </div>
            </div>
          </div>
      </div>

      @endsection