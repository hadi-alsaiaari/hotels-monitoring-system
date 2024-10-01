
@extends('tourism_office.layouts.index')
@section('dashboard')
{{-- @dd($hotels_block) --}}

<div class="page-content">

    <div class="row profile-body">
      <div class="col-md-8 col-xl-12 middle-wrapper">
        <div class="row">
            <div class="card">
            <div class="card-body">
              <h6 class="card-title">Hotel Blocked</h6>

              <form class="forms-sample" method="POST" action="{{route('on_block')}}" enctype="multipart/form-data">
                  @csrf 
                  <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Hotel Name</label>
                  <select name="id" class="js-example-basic-single form-select" data-width="50%">
                    <option value="0" selected>Selected</option>
                    @foreach ($hotels as $hotel)
                    <option value="{{$hotel->id}}">{{$hotel->trade_name}}</option>
                    @endforeach
                  </select>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Hotel Activity Roles</label>
                    <select name="hotel_activity_rule_id" class="js-example-basic-single form-select" data-width="50%">
                      <option value="0" selected>Selected</option>
                      @foreach ($hotel_activity_rules as $rule)
                      <option value="{{$rule->id}}">{{$rule->body}}</option>
                      @endforeach
                    </select>
                    </div>
                  <label for="exampleInputUsername1" class="form-label">Description</label>
                  <div class="col-lg-8">
                    <textarea id="maxlength-textarea" name="body" class="form-control" maxlength="1000"  placeholder="This textarea has a limit of 100 chars."></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary me-2">Block</button>
                  <button class="btn btn-secondary">Cancel</button>
              </form>
                

</div>
</div>
<div class="card mt-4">
  <div class="card-body">
    <h6 class="card-title">All Hotel Blocked</h6>
<div class="table-responsive">
  <table id="example" class="table table-striped table-bordered">
      <thead class="table-white">
          <tr>
              <th>ID</th>
              <th>Hotel Name</th>
              <th>Hotel Owner</th>
              <th>Location</th>
              <th>Status</th>
              <th>Option</th>
          </tr>
      </thead>
          <tbody>  
            @foreach($hotels_block as $n => $Hotel)
          <tr>
              <td class="sorting_1">{{$n+1}}</td>
              <td>{{$Hotel->trade_name}}</td>
              <td>{{$Hotel->hotel_owner->identity->full_name}}</td>
              <td>{{$Hotel->hotel_owner->governorate ."/". $Hotel->hotel_owner->city."/". $Hotel->hotel_owner->street_address." street"}}</td>
              <td style="color: red;">{{$Hotel->status}}</td>
              <td>
                <a href="{{route('up_block',$Hotel->id)}}"  class="btn btn-success me-1 link-icon"><span>Un Block</span></a>
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
      <!-- middle wrapper end -->
      <!-- right wrapper start -->
      
      <!-- right wrapper end -->
    </div>

        </div>
        <script >
          $(document).redy(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showimage').attr('src',e.target.result);
                }
                  reader.readAsDataURL(e.target.files['0']);
            });
          });
        </script>
        
@endsection