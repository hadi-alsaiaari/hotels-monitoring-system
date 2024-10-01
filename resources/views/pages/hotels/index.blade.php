
@extends("{$x}.layouts.index")
@section('dashboard')
<div class="page-content">
    <div class="container">
          <div class="col-12">
              <div class="">
                <div class="card">
                  <div class="card-body">
                    <h6 class="card-title">Hotels</h6>
                    <p class="card-description">All hotels </p>
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-bordered">
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>Hotel owner</th>
                              <th>Location</th>
                              <th>class</th>
                              <th>Number rooms</th>
                              <th>status</th>
                              <th>View</th>
                          </tr>
                      </thead>
                      <tbody>
                        
                        @foreach($hotels as $n => $hotel)
                        <tr>
                            <td class="sorting_1">{{$hotel->trade_name}}</td>
                            <td>{{$hotel->hotel_owner->identity->full_name}}</td>
                            <td>{{$hotel->location}}</td>
                            <td>{{$hotel->class}}</td>
                            <td>{{$hotel->rooms_count}}</td>
                            <td>{{$hotel->status}}</td>
                            <td>
                                {{-- <form action="{{route("{$x}_hotel_info" )}}" method="post">
                                    @csrf
                                    <input type="text" name="hotel_id" value="{{$hotel->id}}" hidden>
                                    <button class="btn btn-warning me-1 link-icon"  type="submit">
                                        View
                                    </button>
                                </form> --}}
                                @can('hotels.view')
                                <a href="{{route("{$x}_hotel_info",$hotel->id )}}" class="btn btn-warning me-1 link-icon">View</a>
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