@extends("{$x}.layouts.index")
@section('dashboard')

<div class="page-content">
    <div class="col-md-14 stretch-card" >
        <div class="card">
          <div class="card-body">
            <h6 class="card-title">Add Wanted People</h6>
              <form action="{{route("{$x}_wanted_people.store")}}" method="POST" enctype="multipart/form-data">
                @csrf 
                <div class="row">
                  <div class="col-sm-3">
                    <div class="mb-3">
                      <label class="form-label">First Name</label>
                      <input type="text" name="wanted_people[first_name]" class="form-control" placeholder="Enter fname" required>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('wanted_people[first_name]')" />
                  </div>
                  <div class="col-sm-3">
                    <div class="mb-3">
                      <label class="form-label">Second Name</label>
                      <input type="text" name="wanted_people[second_name]" class="form-control" placeholder="Enter scname" required>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('wanted_people[second_name]')" />
                  </div>
                  <div class="col-sm-3">
                    <div class="mb-3">
                      <label class="form-label">Third Name</label>
                      <input type="text" name="wanted_people[third_name]" class="form-control" placeholder="Enter thname" required>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('wanted_people[third_name]')" />
                  </div>
                  <div class="col-sm-3">
                    <div class="mb-3">
                      <label class="form-label">Last Name</label>
                      <input type="text" name="wanted_people[last_name]" class="form-control" placeholder="Enter lname" required>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('wanted_people[last_name]')" />
                  </div>
                  <div class="col-sm-3">
                    <div class="mb-3">
                      <label class="form-label">Identity Number</label>
                      <input type="text" max="100" name="wanted_people[identity_number]" class="form-control" placeholder="Enter Identity Number" required>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('wanted_people[identity_number]')" />
                  </div>
                </div><!-- Row -->
                <button type="submit" class="btn btn-primary submit">Create</button>
                {{-- <a href="{{route('finsh_add_rooms', $hotelinfo->id)}}" class="btn btn-warning me-1 link-icon" >
                  Finished 
                </a> --}}
              </form>
          </div>
        </div>
      </div>

</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script>
  // function noti(){
  //   var notic = document.getElementById('notic');
  //   var valunotic = notic.value;
  //   vn = document.getElementById("out2");
  //   vn.innerHTML = value;
  // }
//   
</script>

@endsection