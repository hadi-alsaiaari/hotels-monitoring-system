

@extends('tourism_office.layouts.index')
@section('dashboard')


<div class="page-content">

    <div class="row profile-body">
      <!-- left wrapper start -->
      <!-- left wrapper end -->
      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-12 middle-wrapper">
        <div class="row">
            <div class="card">
            <div class="card-body">
              <h6 class="card-title">Update rule</h6>

              <form class="forms-sample" method="POST" action="{{route('update.activity_rules', $rule->id )}}" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <label for="exampleInputUsername1" class="form-label">Description rule</label>
                  <div class="col-lg-8">
                    <textarea id="maxlength-textarea" name="body" class="form-control" maxlength="1000" rows="8" placeholder="This textarea has a limit of 100 chars.">{{(!empty($rule->body)) ? $rule->body : ''}}</textarea>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">PDF <span style="color: red">*</span></label>
                  <input class="form-control" type="file" name="image"  style="width: 60%;" id="image" >
                  </div>
                  <button type="submit" class="btn btn-primary me-2">Save</button>
                  <button class="btn btn-secondary">Cancel</button>
              </form>
                

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