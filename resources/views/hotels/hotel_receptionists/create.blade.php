@extends('hotels.layouts.index')
@section('dashboard')
<div class="page-content">
    <div class="col-md-14 stretch-card" >
        <div class="card">
          <div class="card-body">
            <h6 class="card-title">Add Receptionist</h6>
            <p class="mb-2"><span style="color: red">*Obligatoire</span></p>
              <form action="{{route('store_R')}}" method="POST" enctype="multipart/form-data">
                @csrf 
                <div class="row">
                  <div class="col-sm-3">
                    <div class="mb-3">
                      <label class="form-label">First Name <span style="color: red">*</span></label>
                      <input type="text" name="first_name" class="form-control" placeholder="Enter fname" required>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                  </div>
                  <div class="col-sm-3">
                    <div class="mb-3">
                      <label class="form-label">Second Name <span style="color: red">*</span></label>
                      <input type="text" name="second_name" class="form-control" placeholder="Enter scname" required>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('second_name')" />
                  </div>
                  <div class="col-sm-3">
                    <div class="mb-3">
                      <label class="form-label">Third Name <span style="color: red">*</span></label>
                      <input type="text" name="third_name" class="form-control" placeholder="Enter thname" required>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('third_name')" />
                  </div>
                  <div class="col-sm-3">
                    <div class="mb-3">
                      <label class="form-label">Last Name <span style="color: red">*</span></label>
                      <input type="text" name="last_name" class="form-control" placeholder="Enter lname" required>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                  </div>
                  <div class="col-sm-4">
                    <label class="form-label">Country <span style="color: red">*</span></label>
                    <select name="country" class="js-example-basic-single form-select" data-width="50%">
                      <option value="YE">Yemen</option>
                      <option value="KSA">New York</option>
                      <option value="FL">Florida</option>
                      <option value="KN">Kansas</option>
                      <option value="HW">Hawaii</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('country')" />
                  </div>
                  <div class="col-sm-4">
                    <div class="mb-3">
                      <label class="form-label">Place of Birth <span style="color: red">*</span></label>
                      <input type="text" name="place_of_birth" class="form-control" placeholder="Enter Place of Birth" required>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('place_of_birth')" />
                  </div><!-- Col -->
                  <div class="col-sm-4">
                    <div class="mb-3">
                      <label class="form-label">Date of Birth <span style="color: red">*</span></label>
                      <input type="date" name="date_of_birth" class="form-control" required>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
                  </div>
                  <div class="col-sm-4">
                    <div class="mb-3">
                      <label class="form-label">Sex <span style="color: red">*</span></label>
                      <select name="sex" id="sex" class="form-control" aria-invalid="false" >
                        <option selected="" disabled="" required>Select sex</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('sex')" />
                  </div>
                  </div>
                  <hr>
                  <div class="col-sm-4">
                    <div class="mb-3">
                      <label class="form-label">Identity Number <span style="color: red">*</span></label>
                      <input type="text" max="100" name="identity_number" class="form-control" placeholder="Enter Identity Number" required>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('identity_number')" />
                  </div>
                  <div class="col-sm-4">
                    <div class="mb-3">
                      <label class="form-label">Identity Type <span style="color: red">*</span></label>
                      <input type="text" max="100" name="identity_type" class="form-control" placeholder="Enter Identity Type" required>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('identity_type')" />
                  </div>
                  <div class="col-sm-4">
                    <div class="mb-3">
                      <label class="form-label">Issuing Authority <span style="color: red">*</span></label>
                      <input type="text" max="100" name="issuing_authority" class="form-control" placeholder="Enter Issuing Authority" required>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('issuing_authority')" />
                  </div>
                  <div class="col-sm-4">
                    <div class="mb-3">
                      <label class="form-label">Date of Issue <span style="color: red">*</span></label>
                      <input type="date" name="date_of_issue" class="form-control" required>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('date_of_issue')" />
                  </div>
                  <div class="col-sm-4">
                    <div class="mb-3">
                      <label class="form-label">Date of Expiry <span style="color: red">*</span></label>
                      <input type="date" name="date_of_expiry" class="form-control" required>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('date_of_expiry')" />
                  </div>
                  <hr>
                  <div class="col-sm-4">
                    <div class="mb-3">
                      <label class="form-label">Username <span style="color: red">*</span></label>
                      <input type="text" max="100" name="name" class="form-control" placeholder="Enter Username" required>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                  </div>
                  <div class="col-sm-4">
                    <div class="mb-3">
                      <label class="form-label">Email <span style="color: red">*</span></label>
                      <input type="email" max="100" name="email" class="form-control" placeholder="Enter Email" required>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
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

@endsection