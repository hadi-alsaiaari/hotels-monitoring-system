@extends('tourist_police.layouts.index')
@section('dashboard')
<div class="page-content">
    <div class="container">
          <div class="col-12">
              <div class="">
                <div class="card">
                  <div class="card-body">
                    <h6 class="card-title">Residential Permit Details</h6>
                    <p class="card-description">Permit Seekers </p>
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-bordered">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Name Seeker</th>
                              <th>Sex</th>
                              <th>Country</th>
                              <th>Identity Number</th>
                              <th>Place Of Birth</th>
                              <th>Notice</th>
                          </tr>
                      </thead>
                      <tbody>
                        {{-- @dd(count($residential_permit->permit_seekers)) --}}
                        @foreach($residential_permit as $n => $r_p)
                        <tr>
                            <td class="sorting_1">{{$n+1}}</td>
                            <td>{{$r_p->guests->identity->full_name}}</td>
                            <td>{{$hotel_r->guests->identity->sex}}</td>
                            <td>{{$hotel_r->guests->identity->country}}</td>
                            <td>{{$hotel_r->guests->identity->identity_number}}</td>
                            <td>{{$hotel_r->guests->identity->place_of_birth}}</td>
                            <td>{{$hotel_r->guests->identity->notice}}</td>
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