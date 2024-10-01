@extends('hotels.layouts.index')
<!-- Internal Data table css -->
{{-- <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"> --}}
@section('dashboard')
<div class="page-content">
	{{-- @dd($accommodations) --}}
				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">All Accommodations</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2"></p>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">ID</th>
												<th class="border-bottom-0">Hotel Name</th>
												<th class="border-bottom-0">price</th>
												<th class="border-bottom-0">Arrival At</th>
												<th class="border-bottom-0">Departure At</th>
												<th class="border-bottom-0">Expected Departure Time</th>
												<th class="border-bottom-0">Created At</th>
												<th class="border-bottom-0">Notice</th>
												<th class="border-bottom-0">Option</th>
											</tr>
										</thead>
										<tbody>
											@foreach($accommodations as $n => $accommodation)
											
												<tr>
													<td class="sorting_1">{{$accommodation->number_accommodation}}</td>
													<td>{{$accommodation->room->hotel->trade_name}}</td>
													<td>{{$accommodation->price}}</td>
													<td>{{$accommodation->arrival_at}}</td>
													<td>{{$accommodation->departure_at}}</td>
													<td>{{$accommodation->expected_departure_time}}</td>
													<td>{{$accommodation->created_at}}</td>
													<td>{{$accommodation->notice}}</td>

													<td>
														<form action="{{route('hotels_accommodations.show')}}" method="post">
															@csrf
															<input type="text" name="id" value="{{$accommodation->id}}" hidden>
															<button class="btn btn-warning me-1 link-icon"  type="submit">
																<i data-feather="eye" ></i>
															</button>
														</form>
														
														{{-- <a href="{{route("{$x}_accommodations.show",$accommodation->id )}}"  class="btn btn-warning me-1 link-icon"><i data-feather="eye" ></i></a> --}}
												</td>
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
