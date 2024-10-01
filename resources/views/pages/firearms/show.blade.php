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
			<li class="breadcrumb-item"><a href="{{route('firearm_all.index')}}">Firearm</a></li>
			<li class="breadcrumb-item active" aria-current="page">Show</li>
		</ol>
	</nav>
				<!-- row opened -->
				<div class=" d-md-block col-md-4 col-xl-12 left-wrapper">
					<div class="card rounded">
					  <div class="card-body">
						<div class="row">
						  <div class="col-sm-12 mb-1" >
							<h6 class="card-title"><b><center><i data-feather=""></i>Firearm Detailes</center></b></h6>
						  </div>
						  @if (!empty($firearm))
						  <div class="col-sm-3">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Firearm Serial Number:</label>
							  <p class="text-muted">{{$firearm->firearm_serial_number}}</p>
							</div>
						  </div>
						  <div class="col-sm-3">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">Firearm Type:</label>
							  <p class="text-muted">{{$firearm->firearm_type}}</p>
							</div>
						  </div>
						  <div class="col-sm-3 mb-3">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">License Number:</label>
							  <p class="text-muted">{{$firearm->license_number}}</p>
							</div>
						  </div>
						  <div class="col-sm-3">
							<div class="mt-3">
							  <label class="tx-11 fw-bolder mb-0 text-uppercase">License Type:</label>
							  <p class="text-muted">{{$firearm->license_type}}</p>
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
									<h4 class="card-title mg-b-0">All Guests</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2"></p>
							</div>
							<div class="card-body">
								<div class="table-responsive mb-3" >
									<table class="table key-buttons text-md-nowrap mb-3" >
										<thead>
											<tr>
												<th class="border-bottom-0">Accommodation No.</th>
												<th class="border-bottom-0"><center>Full Name</center></th>
												<th class="border-bottom-0"><center>Sex</center></th>
												<th class="border-bottom-0"><center>Identity Number</center></th>
												<th class="border-bottom-0"><center>Hotel Name</center></th>
												<th class="border-bottom-0"><center>Location</center></th>
											</tr>
										</thead>
										<tbody>
											@foreach($accommodation_details as $n => $accommodation_detail)
												<tr>
													<td class="sorting_1">{{$accommodation_detail->accommodation->number_accommodation}}</td>
													<td>{{$accommodation_detail->guest->identity->full_name}}</td>
													<td>{{$accommodation_detail->guest->identity->sex}}</td>
													<td>{{$accommodation_detail->guest->identity->identity_number}}</td>
													<td>{{$accommodation_detail->accommodation->room->hotel->trade_name}}</td>
													<td>{{$accommodation_detail->accommodation->room->hotel->location}}</td>
												</tr>
												@endforeach
										</tbody>
									</table>
								</div>
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
