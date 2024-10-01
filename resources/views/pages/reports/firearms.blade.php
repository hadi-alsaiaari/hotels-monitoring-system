@extends("{$x}.layouts.index")
<style>
    @media print {
        #print_Button {
            display: none;
        }
    }

</style>
@section('dashboard')

<div class="page-content">
    {{-- @dd($accommodations) --}}

<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">

            <div class="card-header pb-0 mb-3" >
                <h6 class="card-title">Firearms Filter </h6>
                <form action="{{route("filter_fir")}}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-sm-2 mt-3">
                            <div class="mb-3">
                              <label class="form-label">Hotel Name</label>
                              <select name="hotel_id" class="js-example-basic-single form-select" data-width="50%">
                                <option value="0" selected>Selected</option>
                                @foreach ($hotels as $hotel)
                                <option value="{{$hotel->id}}">{{$hotel->trade_name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                            <div class="col-sm-2 mt-3">
                              <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" >
                              </div>
                            </div>
                            <div class="col-sm-2 mt-3">
                              <div class="mb-3">
                                <label class="form-label">Second Name</label>
                                <input type="text" name="second_name" class="form-control" placeholder="Enter Second Name" >
                              </div>
                            </div>
                            <div class="col-sm-2 mt-3">
                              <div class="mb-3">
                                <label class="form-label">Third Name</label>
                                <input type="text" name="third_name" class="form-control" placeholder="Enter Third Name" >
                              </div>
                            </div>
                            <div class="col-sm-2 mt-3">
                              <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" >
                              </div>
                            </div>
                            <div class="col-sm-2 mt-3">
                              <div class="mb-3">
                                <label class="form-label">Serial Number</label>
                                <input type="text" name="firearm_serial_number" class="form-control" placeholder="Enter Serial Number" >
                              </div>
                            </div>
                            <div class="col-sm-2 mt-3">
                              <div class="mb-3">
                                <label class="form-label">License Number</label>
                                <input type="text" name="license_number" class="form-control" placeholder="Enter License Number" >
                              </div>
                            </div>
                            <div class="col-sm-2 mt-3">
                              <div class="mb-3">
                                <label class="form-label">Identity</label>
                                <input type="text" name="identity_number" class="form-control" placeholder="Enter Last Name" >
                              </div>
                            </div>
                            <div class='col-sm-4 mt-3'>
                              <div class='mb-3'>
                                  <label class='form-label'>From</label>
                                  <input type='date' name='start_at' class='form-control' >
                              </div>
                            </div>
                            <div class='col-sm-4 mt-3'>
                              <div class='mb-3'>
                                  <label class='form-label'>To</label>
                                  <input type='date' name='end_at' class='form-control' >
                              </div>
                            </div>

                                <button type="submit" class="btn btn-primary btn-block" id="print_Button">Filter</button>
                            {{-- <a href="javascript:;" class="btn btn-outline-primary float-end mt-4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</a> --}}
                            <button class="btn btn-outline-primary float-end mt-4" id="print_Button" onclick="printDiv()"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</button>
                      </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<!-- row closed -->
<div class="row row-sm mt-3"id="print" >
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-body">
              <div class="container-fluid d-flex justify-content-between">
                <div class="col-lg-3 ps-0">
                  {{-- <a href="#" class="noble-ui-logo logo-light d-block mt-3">Noble<span>UI</span></a>                  --}}
                  <p class="mt-1 mb-1"><b>REPUBLIC OF YEMEN</b></p>
                  <p >Ministry of</p>
                  <p>Tourism And Environment</p>
                  <h5 class="mt-3 mb-2 text-muted"></h5>
                  <p>Number( )<br> Date :</p>
                </div>
                <div class="col-lg-3 pe-0" style="">
                  <h4 class="mt-1 mb-1"><b><center>بسم الله الرحمن الرحيم</center></b></h4>
                  <img style="width: 80%;height: 40%;margin-left: 19px;" src="{{url('backend/assets_/images/others/Emblem_of_Yemen.png')}}" alt="">
                  <img style="width: 80%;height: 30%;margin-left: 19px;" src="{{url('backend/assets_/images/others/IMG-20231023-WA0009.jpg')}}" alt="">

              </div>
                <div class="col-lg-3 pe-0">
                  <h4 class="fw-bolder text-uppercase text-end mt-4 mb-2">الجمهورية اليمنية</h4>
                  <h4 class="text-end mb-1 pb-4">وزارة السياحة</h4>
                </div>
              </div>
              <hr>
                <div class="table-responsive"style="border-top: 2px solid #0162e8 !important;">
                  <table class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0" >ID</th>
                        <th class="border-bottom-0">Hotel Name</th>
                        <th class="border-bottom-0">Full Name</th>
												<th class="border-bottom-0">Identity</th>
                        <th class="border-bottom-0">Arrival At</th>
												<th class="border-bottom-0">Departure At</th>
												<th class="border-bottom-0" >Firearm Serial Number</th>
												<th class="border-bottom-0">Firearm Type</th>
												<th class="border-bottom-0">License Number</th>
												<th class="border-bottom-0">License Type</th>
											</tr>
										</thead>
										<tbody>
                      
											@foreach ($accommodations as $n => $accommodationDeatailes)
                      @if (!empty($accommodationDeatailes->firearm))
											<tr>
                        {{-- @dd($accommodationDeatailes->firearm->firearm_type) --}}
												<td class="sorting_1">{{$n+1}}</td>
                        <td>{{$accommodationDeatailes->accommodation->room->hotel->trade_name}}</td>
                        <td>{{$accommodationDeatailes->guest->identity->full_name}}</td>
                        <td>{{$accommodationDeatailes->guest->identity->identity_number}}</td>
                        <td>{{$accommodationDeatailes->accommodation->arrival_at}}</td>
												<td>{{$accommodationDeatailes->accommodation->departure_at}}</td>
												<td>{{$accommodationDeatailes->firearm->firearm_serial_number}}</td>
												<td>{{$accommodationDeatailes->firearm->firearm_type}}</td>
												<td>{{$accommodationDeatailes->firearm->license_number}}</td>
												<td>{{$accommodationDeatailes->firearm->license_type}}</td>

											</tr>
                      @endif
											@endforeach
                      
										</tbody>
									</table>
                </div>
                

            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    function printDiv() {
        var printContents = document.getElementById('print').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        // location.reload();
    }

</script>
@endsection
