@extends('tourist_police.layouts.index')
@section('dashboard')
<div class="page-content">
  {{-- @dd($hotels) --}}
    <div class="col-md-14 stretch-card" >
        <div class="card">
          <div class="card-body">
            <h6 class="card-title">Add Residential Permit</h6>
            
              <form action="{{route('residential_permit.store')}}" method="POST">
                @csrf 
                <div class="row">
                  <div class="col-sm-6 mt-3">
                    <div class="mb-3">
                      <label class="form-label">Hotel Name</label>
                      <select name="hotel_id" class="js-example-basic-single form-select" data-width="50%">
                        @foreach ($hotels as $hotel)
                        <option value={{$hotel->id}}>{{$hotel->trade_name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                  </div>
                  <div class="col-sm-6 mt-3">
                    <div class="mb-3">
                      <label class="form-label">Number Of Days</label>
                      <input type="text" name="days_number" class="form-control" placeholder="Enter scname" required>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('second_name')" />
                  </div>
                </div>
                <hr>
                <h6 class="card-title">Permit Seekers</h6>
                <div class="col-sm-2" style=" width:30%;" >
                  <div class="mb-3" style="display: flex;">
                    <label class="form-label">Number Of Seekers </label>
                    <input type="number" id="num1" oninput="demo1()" name="number" min="1" max="6" class="form-control" placeholder="Enter fname"  required>
                  </div>
                </div>
                <div class="row" id="form1">

                </div>
                
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
  function demo(){
  var input = document.getElementById("num");
  var value = input.value;
  if(value!=null)
  {
    a = document.getElementById("out");
    a.innerHTML =`<input type='number' hidden name='number_of_notice[`+ $i +`]' value='$i-1' >`;
  }
}

  function demo1(){
    var input = document.getElementById('num1');
    var value = input.value;

    // $.ajax({
    //   url:"http://127.0.0.1:8000/t-p/residential_permit/create",
    //   method: "get",
    //   data: numberPermit,
    //   success: function(res){
    //     console.log(res);
    //   }
    // })
    b = document.getElementById("form1");
    b.innerHTML =" ";
    for ($i = 0; $i < value; $i++)
      { 

        b.innerHTML +=` <div class='row'><div class='col-sm-3'><div class='mb-3'><label class='form-label'>First Name</label><input type='text' name='permit_seekers[`+ $i +`][first_name]' class='form-control' placeholder='Enter fname' required></div><x-input-error class='mt-2' :messages='$errors->get('first_name')' /></div><div class='col-sm-3'><div class='mb-3'><label class='form-label'>Second Name</label><input type='text' name='permit_seekers[`+ $i +`][second_name]' class='form-control' placeholder='Enter scname' required></div><x-input-error class='mt-2' :messages='$errors->get('second_name')' /></div><div class='col-sm-3'><div class='mb-3'><label class='form-label'>Third Name</label><input type='text' name='permit_seekers[`+ $i +`][third_name]' class='form-control' placeholder='Enter thname' required></div><x-input-error class='mt-2' :messages='$errors->get('third_name')' /></div><div class='col-sm-3'><div class='mb-3'><label class='form-label'>Last Name</label><input type='text' name='permit_seekers[`+ $i +`][last_name]' class='form-control' placeholder='Enter lname' required></div><x-input-error class='mt-2' :messages='$errors->get('last_name')' /></div><div class='col-sm-4'><label class='form-label'>Country</label><select name='permit_seekers[`+ $i +`][country]' class='js-example-basic-single form-select' data-width='50%'><option value='YE'>Yemen</option><option value='KSA'>New York</option><option value='FL'>Florida</option><option value='KN'>Kansas</option><option value='HW'>Hawaii</option></select><x-input-error class='mt-2' :messages='$errors->get('country')' /></div><div class='col-sm-4'><div class='mb-3'><label class='form-label'>Place of Birth</label><input type='text' name='permit_seekers[`+ $i +`][place_of_birth]' class='form-control' placeholder='Enter Place of Birth' required></div><x-input-error class='mt-2' :messages='$errors->get('place_of_birth')' /></div><div class='col-sm-4'><div class='mb-3'><label class='form-label'>Date of Birth</label><input type='date' name='permit_seekers[`+ $i +`][date_of_birth]' class='form-control' required></div><x-input-error class='mt-2' :messages='$errors->get('date_of_birth')' /></div><div class='col-sm-4'><div class='mb-3'><label class='form-label'>Sex</label><select name='permit_seekers[`+ $i +`][sex]' id='sex' class='form-control' aria-invalid='false' ><option selected='' disabled='' required>Select sex</option><option value='male'>Male</option><option value='female'>Female</option></select><x-input-error class='mt-2' :messages='$errors->get('sex')' /></div></div><hr><div class='col-sm-4'><div class='mb-3'><label class='form-label'>Identity Number</label><input type='text' max='100' name='permit_seekers[`+ $i +`][identity_number]' class='form-control' placeholder='Enter Identity Number' required></div><x-input-error class='mt-2' :messages='$errors->get('identity_number')' /></div><div class='col-sm-4'><div class='mb-3'><label class='form-label'>Identity Type</label><input type='text' max='100' name='permit_seekers[`+ $i +`][identity_type]' class='form-control' placeholder='Enter Identity Type' required></div><x-input-error class='mt-2' :messages='$errors->get('identity_type')' /></div><div class='col-sm-4'><div class='mb-3'><label class='form-label'>Issuing Authority</label><input type='text' max='100' name='permit_seekers[`+ $i +`][issuing_authority]' class='form-control' placeholder='Enter Issuing Authority' required></div><x-input-error class='mt-2' :messages='$errors->get('issuing_authority')' /></div><div class='col-sm-4'><div class='mb-3'><label class='form-label'>Date of Issue</label><input type='date' name='permit_seekers[`+ $i +`][date_of_issue]' class='form-control' required></div><x-input-error class='mt-2' :messages='$errors->get('date_of_issue')' /></div><div class='col-sm-4'><div class='mb-3'><label class='form-label'>Date of Expiry</label><input type='date' name='permit_seekers[`+ $i +`][date_of_expiry]' class='form-control' required></div><x-input-error class='mt-2' :messages='$errors->get('date_of_expiry')' /></div><div class='col-sm-12'><div class='mb-3'><label class='form-label'>Notice</label><input type='text' id='num' name='notice[`+ $i +`]' oninput='demo()' class='form-control' maxlength='100' rows='3' placeholder='This textarea has a limit of 100 chars.' /></div><p id='out'></p><x-input-error class='mt-2' :messages='$errors->get('notice')' /></div></div> `;
        // b.innerHTML +=` <div class="row"><div class="col-sm-3"><div class="mb-3"><label class="form-label">First Name</label><input type="text" name="permit_seekers[`+ $i +`][first_name]" class="form-control" placeholder="Enter fname" required></div><x-input-error class="mt-2" :messages="$errors->get("first_name")" /></div></div></div> `;
  }
       
  }

</script>

@endsection