

@extends('tourism_office.layouts.index')
@section('dashboard')
{{-- <div class="page-content">

        <div class="card">
                <div class="card-body">
                  <h6 class="card-title">All requests</h6>
                  <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p>
                  <div class="table-responsive">
                    <div id="dataTableExample_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="dataTableExample_length"><label>Show <select name="dataTableExample_length" aria-controls="dataTableExample" class="form-select form-select-sm"><option value="10">10</option><option value="30">30</option><option value="50">50</option><option value="-1">All</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="dataTableExample_filter" class="dataTables_filter"><label><input type="search" class="form-control" placeholder="Search" aria-controls="dataTableExample"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="dataTableExample" class="table dataTable no-footer" aria-describedby="dataTableExample_info">
                      <thead>
                        <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 135.208px;">Owner name</th><th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 218.427px;">Hotel name</th><th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 98.8021px;">Location</th><th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 35.4896px;">Situation</th><th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 89.0833px;">Level</th><th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 89.0833px;">View</th></tr>
                      </thead>
                      <tbody>  
                        @foreach($hotels as $n => $hotel)
                      <tr href="{{route('show.requests',$hotel_id=$hotel->id)}}">
                          <td class="sorting_1">{{$hotel->hotel_owner->identity->full_name}}</td>
                          <td>{{$hotel->trade_name}}</td>
                          <td>{{$hotel->hotel_owner->city}}</td>
                          <td>{{$hotel->situation}}</td>
                          <td>{{$hotel->class}}</td>
                          <td>
                            <a href="{{route('show.requests',$hotel->id )}}" class="btn btn-warning me-1 link-icon" >
                              <li data-feather="eye"></li>
                            </a>
                          </td>
                        </tr>
                        <div class="dropdown-divider"></div>
                        @endforeach
                </tbody>
                    </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="dataTableExample_info" role="status" aria-live="polite">Showing 1 to 10 of 22 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="dataTableExample_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="dataTableExample_previous"><a href="#" aria-controls="dataTableExample" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="dataTableExample" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTableExample" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="dataTableExample" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item next" id="dataTableExample_next"><a href="#" aria-controls="dataTableExample" data-dt-idx="4" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
                  </div>
                </div>
              </div>
    
      
        </div> --}}

        <div class="page-content">
          <div class="container">
                <div class="col-12">
                    <div class="">
                      <div class="card">
                        <div class="card-body">
                          <h6 class="card-title">All requests</h6>
                      <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <thead class="table-white">
                                <tr>
                                    <th>Owner name</th>
                                    <th>Hotel name</th>
                                    <th>Location</th>
                                    <th>Situation</th>
                                    <th>Level</th>
                                    <th>view</th>
                                </tr>
                            </thead>
                                <tbody>  
                                  @foreach($hotels as $n => $hotel)
                                <tr href="{{route('show.requests',$hotel_id=$hotel->id)}}">
                                    <td class="sorting_1">{{$hotel->hotel_owner->identity->full_name}}</td>
                                    <td>{{$hotel->trade_name}}</td>
                                    <td>{{$hotel->hotel_owner->city}}</td>
                                    <td>{{$hotel->situation}}</td>
                                    <td>{{$hotel->class}}</td>
                                    <td>
                                      <a href="{{route('show.requests',$hotel->id )}}" class="btn btn-warning me-1 link-icon" >
                                        <li data-feather="eye"></li>
                                      </a>
                                    </td>
                                  </tr>
                                  <div class="dropdown-divider"></div>
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

@endsection