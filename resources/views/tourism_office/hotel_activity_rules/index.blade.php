
@extends('tourism_office.layouts.index')
@section('dashboard')

<div class="page-content">
  @if (!empty(count($rules)))
  <div class="row row-cols-1 row-cols-md-4 ">
    @foreach($rules as $n => $rule)
    <div class="col" >
      <div class="card">
        {{-- @dd($rule->image) --}}
        {{-- <img width="50%" height="50%" src="{{(!empty($rule->image)) ? url($rule->image) : url('backend/assets_/images/others/no_image.jpg')}}" class="card-img-top" alt="..."> --}}
        <div class="card-body">
          {{-- <h5 class="card-title">{{$n+1}}</h5> --}}
          <p class="card-text">{{$rule->body}}</p>
        </div>
        <div style="display: flex" class="m-2">
          <form action="{{route('delete.activity_rules',$rule->id )}}" style="width: 47%;" method="post" onsubmit="return submitForm(this);">
            @csrf
            @method('DELETE')
            <button type="submit" style="width: 90%;" class="btn btn-danger m-2" style="width: 46%;">Delete</button>
        </form>
          {{-- <a href="{{route('delete.activity_rules',$rule->id )}}" class="btn btn-danger m-2" style="width: 46%;">Delete</a> --}}
          {{-- <a href="{{route('edit.activity_rules',$rule->id )}}" class="btn btn-warning m-2" style="width: 50%;">Edit</a> --}}
          <form action="{{route('edit.activity_rules',$rule->id )}}" style="width: 47%;" method="get">
            @csrf
            @method('put')
            <button type="submit" class="btn btn-warning m-2" style="width: 90%;">Edit</button>
        </form>
        </div>
      </div>
      
    </div>
    @endforeach
  </div>
      
  @else
  <div class="col-md-12 col-xl-12 middle-wrapper page-content d-flex align-items-center justify-content-center">
    <div aria-labelledby="swal2-title" aria-describedby="swal2-html-container" class="swal2-popup swal2-modal swal2-icon-info swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: grid;"><ul class="swal2-progress-steps" style="display: none;"></ul><div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;"><div class="swal2-icon-content">!</div><span class="swal2-success-line-tip"></span><span class="swal2-success-line-long"></span></div><img class="swal2-image" style="display: none;"><h2 class="swal2-title" id="swal2-title" style="display: block;"><strong>There is nothing</u></strong></h2><div class="swal2-html-container" id="swal2-html-container" style="display: block;">You can <b>"add new activity rules"</b> to HMS ,you just have to go <u>Add rules</u></div><input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;"><div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select class="swal2-select" style="display: none;"></select><div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"><span class="swal2-label"></span></label><textarea class="swal2-textarea" style="display: none;"></textarea><div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div><div class="swal2-footer" style="display: none;"></div><div class="swal2-timer-progress-bar-container"><div class="swal2-timer-progress-bar" style="display: none;"></div></div></div>
  </div>
  @endif
  
</div>

<script>
  function submitForm(form) {
    
    swal.fire({
    title: "Are you sure?",
    text: "",
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