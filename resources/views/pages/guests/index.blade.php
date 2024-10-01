@extends("{$x}.layouts.index")

@section('dashboard')
<div class="page-content">
	{{-- @dd($guests) --}}
				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">All Guests</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2"></p>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">Full Name</th>
												<th class="border-bottom-0">Country</th>
												<th class="border-bottom-0">Place Of Birth</th>
												<th class="border-bottom-0">Date Of Birth</th>
												<th class="border-bottom-0">Sex</th>
												<th class="border-bottom-0">Identity Number</th>
												<th class="border-bottom-0">Identity Type</th>
												<th class="border-bottom-0">Date Of Issue</th>
												<th class="border-bottom-0">Date Of Expiry</th>
												<th class="border-bottom-0">Issuing Authority</th>
												<th class="border-bottom-0">Option</th>
											</tr>
										</thead>
										<tbody>
											@foreach($guests as $n => $guest)
											
												<tr>
													<td class="sorting_1">{{$n+1}}</td>
													<td>{{$guest->identity->full_name}}</td>
													<td>{{$guest->identity->country}}</td>
													<td>{{$guest->identity->place_of_birth}}</td>
													<td>{{$guest->identity->date_of_birth}}</td>
													<td>{{$guest->identity->sex}}</td>
													<td>{{$guest->identity->identity_number}}</td>
													<td>{{$guest->identity->identity_type}}</td>
													<td>{{$guest->identity->date_of_issue}}</td>
													<td>{{$guest->identity->date_of_expiry}}</td>
													<td>{{$guest->identity->issuing_authority}}</td>

													<td>
														@can('guests.view')
															<a href="{{route("{$x}_guests.show",$guest->id )}}"  class="btn btn-warning me-1 link-icon"><i data-feather="eye" ></i></a>															
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
