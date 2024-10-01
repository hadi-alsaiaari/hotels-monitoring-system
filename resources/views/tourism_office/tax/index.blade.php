@extends('tourism_office.layouts.index')
@section('dashboard')
<div class="page-content">
    <div class="container">
          <div class="col-12">
              <div class="">
                <div class="card">
                  <div class="card-body">
                    <h6 class="card-title">All Taxs Reports</h6>
                <div class="table-responsive">
                  <table id="example" class="table table-striped table-bordered">
                      <thead class="table-white">
                          <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Class</th>
                              <th>PDF</th>
                              <th>Payment Status</th>
                          </tr>
                      </thead>
                          <tbody>  
                            @foreach($monthly_taxes as $n => $monthly_tax)
                          <tr>
                              <td class="sorting_1">{{$n+1}}</td>
                              <td>{{$monthly_tax->hotel->trade_name}}</td>
                              <td>{{$monthly_tax->tax_percentage->class}}</td>
                              <td>
                                <a href="/storage/taxes/{{$monthly_tax->hotel_tax_report}}.pdf" download class="form-control"  id="exampleInputUsername1" accept="application/pdf">
                                  <img src="{{url('backend/assets_/images/others/2899-download-pdf.png')}}" width="42" height="62" alt="">
                                  <label for="">{{$monthly_tax->hotel_tax_report}}</label>
                                </a>
                                </td>
                              <td>{{$monthly_tax->payment_status}}</td>
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