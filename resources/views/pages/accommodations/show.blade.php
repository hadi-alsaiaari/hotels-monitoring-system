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
	{{-- @dd($accommodation) --}}
	<nav class="page-breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route("{$x}_accommodations_all.index")}}">Accommodation</a></li>
			<li class="breadcrumb-item active" aria-current="page">Show</li>
		</ol>
	</nav>
				<!-- row opened -->
				<div class=" d-md-block col-md-4 col-xl-12 left-wrapper">
					<div class="card rounded">
					  <div class="card-body">
						<div class="row">
						  <div class="col-sm-12 mb-1" >
							<h6 class="card-title"><b><center><i data-feather="archive"></i> Accommodation</center></b></h6>
						  </div>
						  @if (!empty($accommodation))
						  <div class="col-sm-3">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Number Accommodation:</label>
							  <p class="text-muted">{{$accommodation->number_accommodation}}</p>
							</div>
						  </div>
						  <div class="col-sm-1">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Price:</label>
							  <p class="text-muted">{{$accommodation->price}}</p>
							</div>
						  </div>
						  <div class="col-sm-3 mb-3">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Expected Departure Time:</label>
							  <p class="text-muted">{{$accommodation->expected_departure_time}}</p>
							</div>
						  </div>
						  <div class="col-sm-3">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Arrival At:</label>
							  <p class="text-muted">{{$accommodation->arrival_at}}</p>
							</div>
						  </div>
						  <div class="col-sm-2">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Departure At:</label>
							  <p class="text-muted">{{$accommodation->Departure_at}}</p>
							</div>
						  </div>
						  <div class="col-sm-2 mb-3">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Notice:</label>
							  <p class="text-muted">{{$accommodation->notice}}</p>
							</div>
						  </div>
						  <hr>
						  <h6 class="card-title"><b><center><i data-feather="hard-drive"></i> Room</center></b></h6>
						  <div class="col-sm-3">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Room Number:</label>
							  <p class="text-muted">{{$accommodation->room->number}}</p>
							</div>
						  </div>
						  <div class="col-sm-1">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Category:</label>
							  <p class="text-muted">{{$accommodation->room->category}}</p>
							</div>
						  </div>
						  <div class="col-sm-3 mb-3">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Type:</label>
							  <p class="text-muted">{{$accommodation->room->type}}</p>
							</div>
						  </div>
						  <div class="col-sm-3">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Floor:</label>
							  <p class="text-muted">{{$accommodation->room->floor}}</p>
							</div>
						  </div>
						  <div class="col-sm-2">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Price:</label>
							  <p class="text-muted">{{$accommodation->room->price}}</p>
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
									<h4 class="card-title mg-b-0">All Guest</h4>
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
												<th class="border-bottom-0">Full Name</th>
												<th class="border-bottom-0">sex</th>
												<th class="border-bottom-0">country</th>
												<th class="border-bottom-0">place_of_birth</th>
												<th class="border-bottom-0">date_of_birth</th>
												<th class="border-bottom-0">identity_number</th>
												<th class="border-bottom-0">identity_type</th>
												<th class="border-bottom-0">date_of_issue</th>
												<th class="border-bottom-0">date_of_expiry</th>
												<th class="border-bottom-0">issuing_authority</th>
											</tr>
										</thead>
										<tbody>
												<tr>
													<td class="sorting_1">{{$n+1}}</td>
													<td>{{$accommodation_details_guest->guest->identity->full_name}}</td>
													<td>{{$accommodation_details_guest->guest->identity->sex}}</td>
													<td>{{$accommodation_details_guest->guest->identity->country}}</td>
													<td>{{$accommodation_details_guest->guest->identity->place_of_birth}}</td>
													<td>{{$accommodation_details_guest->guest->identity->date_of_birth}}</td>
													<td>{{$accommodation_details_guest->guest->identity->identity_number}}</td>
													<td>{{$accommodation_details_guest->guest->identity->identity_type}}</td>
													<td>{{$accommodation_details_guest->guest->identity->date_of_issue}}</td>
													<td>{{$accommodation_details_guest->guest->identity->date_of_expiry}}</td>
													<td>{{$accommodation_details_guest->guest->identity->issuing_authority}}</td>

												</tr>
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
											<td colspan="5"><center>Nothing ..</center></td>
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
