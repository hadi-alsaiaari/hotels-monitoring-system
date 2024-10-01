@extends('hotels.layouts.index')
@section('dashboard')
<div class="page-content">
  <div class="container-fluid">
    <div class="row">
      @foreach($rules as $n => $rule)
      <div class="col-md-4 col-lg-4 mg-md-t-0">
        <div class="card">
          {{-- <img class="" src="{{(!empty($rule->image)) ? url('storage/'.$rule->image) : url('backend/assets_/images/others/no_image.jpg')}}" alt="profile"> --}}
          <div class="card-header">
            <h7>
              Rule number ({{$n+1}}) 
            </h7>
          </div>
          <div class="card-body ">
            <p class="card-text">{{$rule->body}}</p>
          </div>
          <div class="card-footer">
            {{$rule->created_at->diffForHumans()}}
          </div>
        </div>
      </div>
      @endforeach
</div>
</div>
    {{-- <div class="container">
          <div class="col-12">
              <div class="row">
                <div class="card">
                  <div class="card-body">
                    <h6 class="card-title">Hotel Activity Rules</h6>
                    <p class="card-description">All Hotel Activity Rules </p>
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-bordered">
                      <thead>
                          <tr>
                              <th>Id</th>
                              <th>Body</th>
                              <th>Image</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($rules as $n => $rule)
                        <tr>
                            <td class="sorting_1">{{$n+1}}</td>
                            <td>{{$rule->body}}</td>
                            <td>
                                <div class="align-items-center justify-content-between mb-2">
                                    <img class="wd-100 rounded-circle" src="{{(!empty($rule->image)) ? url('storage/'.$rule->image) : url('backend/assets_/images/others/no_image.jpg')}}" alt="profile">
                                </div> 
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
    </div> --}}
    </div>

@endsection