@extends('tourism_office.layouts.index')
@section('dashboard')
<div class=" row-cols-1 ">
    <div class="page-content ">
      <nav class="page-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('all_percentage')}}">Percentage</a></li>
          <li class="breadcrumb-item active" aria-current="page">Add Percentage</li>
        </ol>
      </nav>
        <div class="col-md-14 stretch-card mt-2">
            <div class="container">
              <div class="col-md-12">
                  <div class="">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Add Percentage</h4>
                        <p class="text-muted mb-3">Percentage example 1,2 or any natural number, Implementatio Date should be the beginning of a month.</a></p>
                            <form action="{{route('store_percentage',$class)}}" method="POST" enctype="multipart/form-data" onsubmit="return submitForm(this);">
                              @csrf
                              <div class="row mb-3">
                              <div class="col-lg-3">
                                <label for="defaultconfig" class="col-form-label">Percentage</label>
                              </div>
                              <div class="col-lg-8">
                                <input class="form-control" maxlength="25" name="percentage" id="defaultconfig" type="text" placeholder="Percentage">
                                <x-input-error style="color: red" :messages="$errors->get('percentage')" class="mt-2" />
                              </div>
                            </div>
                            <div class="row mb-3">
                              <div class="col-lg-3">
                                <label for="defaultconfig-2" class="col-form-label">Implementatio Date</label>
                              </div>
                              <div class="col-lg-8">
                                <input class="form-control" maxlength="20" name="implementation_date" id="defaultconfig-2" type="date" >
                                <x-input-error style="color: red" :messages="$errors->get('implementation_date')" class="mt-2" />
                              </div>
                            </div>
                            <div class="row mb-3">
                              <div class="col-lg-3">
                                <label for="defaultconfig-3" class="col-form-label">Decision pdf<span style="color: red"> *</span></label>
                              </div>
                              <div class="col-lg-8">
                                <div class="card-body">
                                  <div class="dropify-wrapper">
                                    <div class="dropify-message">
                                      <span class="file-icon">
                                        <p>Drag and drop a file here or click</p>
                                      </span>
                                      <p class="dropify-error">Ooops, something wrong appended.</p>
                                    </div>
                                    <div class="dropify-loader"></div>
                                    <div class="dropify-errors-container"><ul></ul></div>
                                    <input type="file" id="myDropify" name="decision">
                                    <x-input-error style="color: red" :messages="$errors->get('decision')" class="mt-2" />
                                    <button type="button"  class="dropify-clear">Remove</button>
                                    <div class="dropify-preview">
                                      <span class="dropify-render"></span>
                                        <div class="dropify-infos">
                                          <div class="dropify-infos-inner">
                                            <p class="dropify-filename">
                                              <span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>
                                              <p class="dropify-infos-message">Drag and drop or click to replace</p></div>
                                            </div>
                                          </div>
                                        </div>
                                </div>
                              </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-icon-text">
                              <i class="btn-icon-prepend" data-feather="check-square"></i>
                              Add Percentage
                            </button>
                          </form>
                      </div>
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
  text: "The value of the previous will be deleted, which is {{(!empty($tax_percentage_coming->percentage)) ? $tax_percentage_coming->percentage."%" : 'not found' }}",
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