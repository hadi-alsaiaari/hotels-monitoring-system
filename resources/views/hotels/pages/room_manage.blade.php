@extends('hotels.layouts.index')
@section('dashboard')

<div class="page-content ">
    <div class="col-md-14 stretch-card" >
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Room data</h6>
            <form action="{{route('add_rooms',$hotelinfo->id)}}" method="POST" enctype="multipart/form-data">
              @csrf 
              <div class="row">
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label class="form-label">Number room</label>
                    <input type="number" name="number" class="form-control" placeholder="Enter number room" required>
                  </div>
                </div><!-- Col -->
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category" id="sex" class="form-control" aria-invalid="false" >
                      <option selected="" disabled="" required>Select category</option>
                      <option>A</option>
                      <option>B</option>
                      <option>C</option>
                      <option>D</option>
                      <option>E</option>
                  </select>
                </div>
                </div><!-- Col -->
              </div><!-- Row -->
              <div class="row">
                <div class="col-sm-4">
                  <div class="mb-3">
                    <label class="form-label">Type</label>
                    <select name="type" id="type" class="form-control" aria-invalid="false" >
                      <option selected="" disabled="" required>Select type</option>
                      <option>Single</option>
                      <option>Double</option>
                      <option>Treble</option>
                      <option>Apartment</option>
                      <option>Suite</option>
                  </select>  
                  </div>
                </div><!-- Col -->
                <div class="col-sm-4">
                  <div class="mb-3">
                    <label class="form-label">Floor</label>
                    <input type="number" name="floor" class="form-control" placeholder="Enter Floor" required>
                  </div>
                </div><!-- Col -->
                <div class="col-sm-4">
                  <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" placeholder="Enter Price" required>
                  </div>
                </div><!-- Col -->
              </div><!-- Row -->
              <button type="submit" class="btn btn-primary submit">Add room</button>
              <a href="{{route('finsh_add_rooms', $hotelinfo->id)}}" class="btn btn-warning me-1 link-icon" >
                Finished 
              </a>
            </form>
        </div>
      </div>
    </div>
    <div class="col-md-14 stretch-card mt-2">
        <div class="container">
          <div class="col-md-12">
              <div class="">
                <div class="card">
                  <div class="card-body">
                    <h6 class="card-title">All Rooms</h6>
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-bordered">
                      <thead class="table-white">
                          <tr>
                              <th>Number room</th>
                              <th>Category</th>
                              <th>Type</th>
                              <th>Floor</th>
                              <th>Price</th>
                              <th>Option</th>
                          </tr>
                      </thead>
                          <tbody>  
                            
                            @foreach($hotelinfo->rooms as $n => $room)
                            <tr>
                                <td class="sorting_1">{{$room->number}}</td>
                                <td>{{$room->category}}</td>
                                <td>{{$room->type}}</td>
                                <td>{{$room->floor}}</td>
                                <td>{{$room->price}}</td>
                                <td>
                                    <form action="{{route('delete_rooms',$room->id )}}" method="post">
                                        @csrf
                                        @method('DELETE') 
                                        <input type="text" name="hotel_id" value="{{$hotelinfo->id}}" hidden>
                                        <button class="btn btn-danger me-1 link-icon"  type="submit">
                                            Delete
                                        </button>
                                    </form>
                                    <a href="" class="btn btn-warning me-1 link-icon btn-xs"><i data-feather="edit" ></i></a>
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
</div>

@endsection