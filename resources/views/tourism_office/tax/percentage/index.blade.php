@extends('tourism_office.layouts.index')
@section('dashboard')
{{-- @dd($tax_percentage_comings) --}}
<div class=" row-cols-1 ">
    <div class="page-content ">    
      
         <div class="col-md-14 stretch-card mt-2">
            <div class="container">
              <div class="col-md-12">
                  <div class="">
                    <div class="card">
                      
                      <div class="card-body">
                        <h6 class="card-title" style="display: ruby-text;">Percentage 
                          <a href="" ></a>
                          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <div class="btn-group" role="group">
                              <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Add New Percentage
                              </button>
                              @can('tax-percentage.create')
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="{{route('add_percentage', $class='one')}}">One Star</a>
                                <a class="dropdown-item" href="{{route('add_percentage', $class='two')}}">Two Star</a>
                                <a class="dropdown-item" href="{{route('add_percentage', $class='three')}}">Three Star</a>
                                <a class="dropdown-item" href="{{route('add_percentage', $class='four')}}">Four Star</a>
                                <a class="dropdown-item" href="{{route('add_percentage', $class='five')}}">Five Star</a>
                              </div>
                              @endcan
                            </div>
                          </div>
                        </h6>
                        @if (!(sizeof($tax_percentage_useds) == 0))
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-white">
                                <tr>
                                    <th>Star</th>
                                    <th>Percentage</th>
                                    <th>Implementation date</th>
                                    <th>Expiry date</th>
                                    <th>Decision</th>
                                </tr>
                            </thead>
                                <tbody>
                                  @foreach($tax_percentage_useds as $n => $percentage)
                                  <tr>
                                      <td class="sorting_1">
                                        @if ($percentage->class == 'one')
                                        <ul style="color: rgb(169, 169, 2)">
                                          <i data-feather="star"></i>
                                        </ul>
                                        @endif
                                        @if ($percentage->class == 'two')
                                        <ul style="color: rgb(169, 169, 2)">
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                        </ul>
                                        @endif
                                        @if ($percentage->class == 'three')
                                        <ul style="color: rgb(169, 169, 2)">
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                        </ul>
                                        @endif
                                        @if ($percentage->class == 'four')
                                        <ul style="color: rgb(169, 169, 2)">
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                        </ul>
                                        @endif
                                        @if ($percentage->class == 'five')
                                        <ul style="color: rgb(169, 169, 2)">
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                        </ul>
                                        @endif
                                        
                                      </td>
                                      
                                      <td>{{(!empty($percentage->percentage)) ? $percentage->percentage."%" : 'not found' }}</td>
                                      <td>{{(!empty($percentage->implementation_date)) ? $percentage->implementation_date : 'not found' }}</td>
                                      <td>{{(!empty($percentage->expiry_date)) ? $percentage->expiry_date : 'Unlimited' }}</td>
                                      <td>
                                        <a href="/storage/{{$percentage->decision}}" download class="form-control"  id="exampleInputUsername1" accept="application/pdf">
                                          <img src="{{url('backend/assets_/images/others/2899-download-pdf.png')}}" width="42" height="62" alt="">
                                        </a>
                                      </td>
                                      
                                  </tr>
                                  @endforeach
                                  {{-- <tr>
                                    <td class="sorting_1">
                                      <ul style="color: rgb(169, 169, 2)">
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                      </ul>
                                    </td>
                                      @if ($percentage->class == 'two')
                                      <td>{{(!empty($percentage->percentage)) ? $percentage->percentage."%" : 'not found' }}</td>
                                      <td>{{(!empty($percentage->implementation_date)) ? $percentage->implementation_date : 'not found' }}</td>
                                      <td>{{(!empty($percentage->expiry_date)) ? $percentage->expiry_date : 'not found' }}</td>
                                      <td>
                                        <a href="/storage/{{$percentage->decision}}" download class="form-control"  id="exampleInputUsername1" accept="application/pdf">
                                          <img src="{{url('backend/assets_/images/others/2899-download-pdf.png')}}" width="42" height="62" alt="">
                                        </a>
                                      </td>
                                      @else
                                      <td>not found</td>
                                      <td>not found</td>
                                      <td>not found</td>
                                      <td>not found</td>
                                      @endif
                                      
                                </tr>
                                <tr>
                                    <td class="sorting_1">
                                      <ul style="color: rgb(169, 169, 2)">
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                      </ul>
                                    </td>
                                    @if ($percentage->class == 'three')
                                    <td>{{(!empty($percentage->percentage)) ? $percentage->percentage."%" : 'not found' }}</td>
                                    <td>{{(!empty($percentage->implementation_date)) ? $percentage->implementation_date : 'not found' }}</td>
                                    <td>{{(!empty($percentage->expiry_date)) ? $percentage->expiry_date : 'not found' }}</td>
                                    <td>
                                      <a href="/storage/{{$percentage->decision}}" download class="form-control"  id="exampleInputUsername1" accept="application/pdf">
                                        <img src="{{url('backend/assets_/images/others/2899-download-pdf.png')}}" width="42" height="62" alt="">
                                      </a>
                                    </td>
                                    @else
                                    <td>not found</td>
                                    <td>not found</td>
                                    <td>not found</td>
                                    <td>not found</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="sorting_1">
                                      <ul style="color: rgb(169, 169, 2)">
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                      </ul>
                                    </td>
                                    @if ($percentage->class == 'four')
                                    <td>{{(!empty($percentage->percentage)) ? $percentage->percentage."%" : 'not found' }}</td>
                                    <td>{{(!empty($percentage->implementation_date)) ? $percentage->implementation_date : 'not found' }}</td>
                                    <td>{{(!empty($percentage->expiry_date)) ? $percentage->expiry_date : 'not found' }}</td>
                                    <td>
                                      <a href="/storage/{{$percentage->decision}}" download class="form-control"  id="exampleInputUsername1" accept="application/pdf">
                                        <img src="{{url('backend/assets_/images/others/2899-download-pdf.png')}}" width="42" height="62" alt="">
                                      </a>
                                    </td>
                                    @else
                                    <td>not found</td>
                                    <td>not found</td>
                                    <td>not found</td>
                                    <td>not found</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="sorting_1">
                                      <ul style="color: rgb(169, 169, 2)">
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                          <i data-feather="star"></i>
                                      </ul>
                                    </td>
                                    @if ($percentage->class == 'five')
                                    <td>{{(!empty($percentage->percentage)) ? $percentage->percentage."%" : 'not found' }}</td>
                                    <td>{{(!empty($percentage->implementation_date)) ? $percentage->implementation_date : 'not found' }}</td>
                                    <td>{{(!empty($percentage->expiry_date)) ? $percentage->expiry_date : 'not found' }}</td>
                                    <td>
                                      <a href="/storage/{{$percentage->decision}}" download class="form-control"  id="exampleInputUsername1" accept="application/pdf">
                                        <img src="{{url('backend/assets_/images/others/2899-download-pdf.png')}}" width="42" height="62" alt="">
                                      </a>
                                    </td>
                                    @else
                                    <td>not found</td>
                                    <td>not found</td>
                                    <td>not found</td>
                                    <td>not found</td>
                                    @endif
                                </tr> --}}
                                
                          </tbody>
                        </table>
                    </div>
                    @endif
                      </div>
                    </div>
                  </div>
              </div>
        
            </div>
          </div>
          
          @if (!(sizeof($tax_percentage_comings) == 0))
        <div class="col-md-14 stretch-card mt-2">
            <div class="container">
              <div class="col-md-12">
                  <div class="">
                    <div class="card">
                      <div class="card-body">
                        <h6 class="card-title">Percentage Comings</h6>
                    <div class="table-responsive">
                      <table id="example" class="table table-striped table-bordered">
                          <thead class="table-white">
                              <tr>
                                  <th>Star</th>
                                  <th>Percentage</th>
                                  <th>Implementation Date</th>
                                  <th>Expiry Date</th>
                                  <th>Decision</th>
                              </tr>
                          </thead>
                              <tbody>  
                                
                                @foreach($tax_percentage_comings as $n => $percentage_comings)
                                <tr>
                                    <td class="sorting_1">{{$percentage_comings->class}}</td>
                                    <td>{{$percentage_comings->percentage}}</td>
                                    <td>{{$percentage_comings->implementation_date}}</td>
                                    <td>{{$percentage_comings->expiry_date}}</td>
                                    <td>
                                      <a href="/storage/{{$percentage_comings->decision}}" download class="form-control"  id="exampleInputUsername1" accept="application/pdf">
                                        <img src="{{url('backend/assets_/images/others/2899-download-pdf.png')}}" width="42" height="62" alt="">
                                      </a>
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
        
            </div>
          </div>
          @endif
    </div>
    
  </div>
@endsection