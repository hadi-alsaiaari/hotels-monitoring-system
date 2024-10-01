
@extends('tourist_police.layouts.index')
@section('dashboard')
<div class="page-content">
    <div class="container">
          <div class="col-12">
              <div class="">
                <div class="card">
                  <div class="card-body">
                    <h6 class="card-title">Residential Permit</h6>
                    <p class="card-description">All Residential Permit </p>
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-bordered">
                      <thead>
                          <tr>
                              <th>Hotel Name</th>
                              <th>Number Of Seekers</th>
                              <th>Number Of Days</th>
                              <th>Number Of Permit</th>
                              <th>status</th>
                              <th>View</th>
                          </tr>
                      </thead>
                      <tbody>
                        {{-- @dd($residential_permits) --}}
                        @foreach($residential_permits as $n => $r_p)
                       
                        <tr>
                            <td class="sorting_1">{{$r_p->hotel_name}}</td>
                            <td>{{$r_p->permit_seekers_count}}</td>
                            <td>{{$r_p->days_number}}</td>
                            <td>{{$r_p->number_permit}}</td>
                            <td>{{$r_p->statu}}</td>
                            <td>
                                {{-- <form action="{{route('hotel_info',$hotel->id )}}" method="GET">
                                    @csrf
                                    <input type="text" name="hotel_id" value="{{$hotel->id}}" hidden>
                                    <button class="btn btn-warning me-1 link-icon"  type="submit">
                                        View
                                    </button>
                                </form> --}}
                                @can('residential-permit.view')
                                  <a href="{{route('residential_permit.show',$r_p->id)}}"  class="btn btn-warning me-1 link-icon"><i data-feather="eye"></i></a>
                                @endcan
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

@endsection