@extends("{$x}.layouts.index")
<!-- Internal Data table css -->
{{-- <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"> --}}
@section('dashboard')
<div class="page-content">
	{{-- @dd($accommodation_details) --}}
	<nav class="page-breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route("{$x}_guests_all.index")}}">Guests</a></li>
			<li class="breadcrumb-item active" aria-current="page">Show</li>
		</ol>
	</nav>
				<!-- row opened -->
				<div class=" d-md-block col-md-4 col-xl-12 left-wrapper">
					<div class="card rounded">
					  <div class="card-body">
						<div class="row">
						  <div class="col-sm-12 mb-1" >
							<h6 class="card-title"><b><center><i data-feather="users"></i> Guest Information</center></b></h6>
						  </div>
						  @if (!empty($guest))
						  <div class="col-sm-4">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Full Name:</label>
							  <p class="text-muted">{{$guest->identity->full_name}}</p>
							</div>
						  </div>
						  <div class="col-sm-2">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Country:</label>
							  <p class="text-muted">{{$guest->identity->country}}</p>
							</div>
						  </div>
						  <div class="col-sm-3 mb-3">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Place Of Birth:</label>
							  <p class="text-muted">{{$guest->identity->place_of_birth}}</p>
							</div>
						  </div>
						  <div class="col-sm-3">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Date Of Birth:</label>
							  <p class="text-muted">{{$guest->identity->date_of_birth}}</p>
							</div>
						  </div>
						  <div class="col-sm-2 mb-3">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Identity Number:</label>
							  <p class="text-muted">{{$guest->identity->identity_number}}</p>
							</div>
						  </div>
						  <div class="col-sm-2">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Identity Type:</label>
							  <p class="text-muted">{{$guest->identity->identity_number}}</p>
							</div>
						  </div>
						  <div class="col-sm-2">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Sex:</label>
							  <p class="text-muted">{{$guest->identity->sex}}</p>
							</div>
						  </div>
						  <div class="col-sm-3">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Identity Type:</label>
							  <p class="text-muted">{{$guest->identity->identity_type}}</p>
							</div>
						  </div>
						  <div class="col-sm-2 mb-3">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Date Of Issue:</label>
							  <p class="text-muted">{{$guest->identity->date_of_issue}}</p>
							</div>
						  </div><div class="col-sm-2">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Date Of Expiry:</label>
							  <p class="text-muted">{{$guest->identity->date_of_expiry}}</p>
							</div>
						  </div>
						  <div class="col-sm-2">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Issuing Authority:</label>
							  <p class="text-muted">{{$guest->identity->issuing_authority}}</p>
							</div>
						  </div>
						  
						  @endif
					  </div>
					  </div>
					</div>
				  </div>
				  <div class="row row-sm mt-3">
					<div class="col-xl-12" >
						<div class="card mg-b-20" style="border-top: 2px solid #0162e8 !important;">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">All Accommodation</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2"></p>
							</div>
							<div class="card-body">
								@foreach($accommodation_details as $n => $accommodation_details_guest)
								<div class="table-responsive mb-3" style="border: 2px solid #110072 !important;">
									<table class="table key-buttons text-md-nowrap mb-3" >
										<thead>
											<tr>
												<th class="border-bottom-0">ID</th>
												<th class="border-bottom-0">Hotel Name</th>
												<th class="border-bottom-0">Room Number</th>
												<th class="border-bottom-0">Accommodation Number</th>
												<th class="border-bottom-0">Price</th>
												<th class="border-bottom-0">Arrival At</th>
												<th class="border-bottom-0">Departure At</th>
												<th class="border-bottom-0">Expected Departure Time</th>
												<th class="border-bottom-0">Created At</th>
												<th class="border-bottom-0">Notice</th>
												
											</tr>
										</thead>
										<tbody>
												<tr>
													<td>{{$n+1}}</td>
													<td>{{$accommodation_details_guest->accommodation->room->hotel->trade_name}}</td>
													<td>{{$accommodation_details_guest->accommodation->room->number}}</td>
													<td class="sorting_1">{{$accommodation_details_guest->accommodation->number_accommodation}}</td>
													<td>{{$accommodation_details_guest->accommodation->price}}</td>
													<td>{{$accommodation_details_guest->accommodation->arrival_at}}</td>
													<td>{{$accommodation_details_guest->accommodation->departure_at}}</td>
													<td>{{$accommodation_details_guest->accommodation->expected_departure_time}}</td>
													<td>{{$accommodation_details_guest->accommodation->created_at}}</td>
													<td>{{$accommodation_details_guest->accommodation->notice}}</td>
										</tbody>
									</table>
									<div class="table-responsive">
									<table class="table-dark table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0" >ID</th>
												<th class="border-bottom-0" >firearm_serial_number</th>
												<th class="border-bottom-0">firearm_type</th>
												<th class="border-bottom-0">license_type</th>
												<th class="border-bottom-0">license_number</th>
											</tr>
										</thead>
										<tbody>
											@if ((!empty($accommodation_details_guest->firearm)))
											<tr>
												<td class="sorting_1">{{$accommodation_details_guest->firearm->id}}</td>
												<td>{{$accommodation_details_guest->firearm->firearm_serial_number}}</td>
												<td>{{$accommodation_details_guest->firearm->firearm_type}}</td>
												<td>{{$accommodation_details_guest->firearm->license_type}}</td>
												<td >{{$accommodation_details_guest->firearm->license_number}}</td>

											</tr>
											@else
											<td colspan="5"><center>Nothing</center></td>
											@endif
												
										</tbody>
									</table>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
					<!--/div-->
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->

		<!-- main-content closed -->
		<!-- Sticky js -->
<script src="{{URL::asset('assets/js/sticky.js')}}"></script>
<!-- custom js -->
<script src="{{URL::asset('assets/js/custom.js')}}"></script><!-- Left-menu js-->
<script src="{{URL::asset('assets/plugins/side-menu/sidemenu.js')}}"></script>
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>

@endsection
