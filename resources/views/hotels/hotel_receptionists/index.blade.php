
@extends('hotels.layouts.index')
@section('dashboard')
<div class="page-content">
    <div class="container">
          <div class="col-12">
              <div class="">
                <div class="card">
                  <div class="card-body">
                    <h6 class="card-title">EXECUTIVE MANAGER</h6>
                    <p class="card-description">All Executive Manager </p>
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-bordered">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Sex</th>
                              <th>Country</th>
                              <th>Identity Number</th>
                              <th>Place Of Birth</th>
                              <th>Option</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($hotel_receptionists as $n => $hotel_r)
                        <tr>
                            <td class="sorting_1">{{$n+1}}</td>
                            <td>{{$hotel_r->identity->full_name}}</td>
                            <td>{{$hotel_r->identity->sex}}</td>
                            <td>{{$hotel_r->identity->country}}</td>
                            <td>{{$hotel_r->identity->identity_number}}</td>
                            <td>{{$hotel_r->identity->place_of_birth}}</td>
                            <td>
                              <a href="" class="btn btn-warning me-1 link-icon btn-xs"><i data-feather="eye" ></i></a>
                              <a href="{{route('delete_R',$hotel_r->id )}}" class="btn btn-danger me-1 link-icon btn-xs"><i data-feather="trash"></i></a>
                            </td>
                            {{-- <td>
                                <form action="{{route('hotel_info',$hotel->id )}}" method="GET">
                                    @csrf
                                    <input type="text" name="hotel_id" value="{{$hotel->id}}" hidden>
                                    <button class="btn btn-warning me-1 link-icon"  type="submit">
                                        View
                                    </button>
                                </form>
                                <a href="{{route('hotel_info',$hotel->id )}}"  class="btn btn-warning me-1 link-icon">view</a>
                          </td> --}}
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