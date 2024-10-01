<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel Blocked</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HMS') }}</title>
    {{-- <link rel="stylesheet" href="{{asset('backend/assets/vendors/sweetalert2/sweetalert2.min.css')}}"> --}}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('backend/assets/vendors/core/core.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- end plugin css for this page -->
  <!-- inject:css -->
  {{-- <link rel="stylesheet" href="{{asset('backend/assets/fonts/feather-font/css/iconfont.css')}}">
  <link rel="stylesheet" href="{{asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}"> --}}
  <!-- endinject -->
  <!-- Layout styles -->  
  {{-- <link rel="stylesheet" href="{{asset('backend/assets/css/demo_1/style.css')}}"> --}}
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.png')}}" />
        <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'><link rel="stylesheet" href="./style.css">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <link rel="stylesheet" href="{{asset('backend/assets/css/stylewizerd.css')}}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->
  @php
      $request = request();
      $id = $request->hotel;
	  $hotel_request = App\Models\Hotel::where('id', $id)->first();


  @endphp
  {{-- @dd($hotel_request->status); --}}
  <!-- plugin css for this page -->
	<link rel="stylesheet" href="{{asset('backend/assets_/vendors/prismjs/themes/prism.css')}}">
	<!-- end plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="{{asset('backend/assets_/fonts/feather-font/css/iconfont.css')}}">
	<link rel="stylesheet" href="{{asset('backend/assets_/vendors/flag-icon-css/css/flag-icon.min.css')}}">
	<!-- endinject -->
	<!-- core:css -->
	<link rel="stylesheet" href="{{asset('backend/assets_/vendors/core/core.css')}}">
	<!-- endinject -->

	<!-- Plugin css for this page -->
	<link rel="stylesheet" href="{{asset('backend/assets_/vendors/flatpickr/flatpickr.min.css')}}">
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="{{asset('backend/assets_/fonts/feather-font/css/iconfont.css')}}">
	<link rel="stylesheet" href="{{asset('backend/assets_/vendors/flag-icon-css/css/flag-icon.min.css')}}">
	<!-- endinject -->
    <script src="{{asset('backend/assets_/vendors/feather-icons/feather.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('backend/assets_/vendors/sweetalert2/sweetalert2.min.css')}}">
  <!-- dark Theem -->  
	{{-- <link rel="stylesheet" href="{{asset('backend/assets_/css/demo2/style.css')}}"> --}}
  <!-- Light Theem -->  
  <link rel="stylesheet" href="{{asset('backend/assets_/css/demo_5/style.css')}}">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="{{asset('backend/assets_/images/favicon.png')}}" />
  <!-- Fonts -->

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

  <link rel="stylesheet" href="{{asset('backend/assets_/vendors/jquery-steps/jquery.steps.css')}}">
  
</head>
<body>
    <div class="main-wrapper">
        <div class="horizontal-menu">
			<nav class="navbar top-navbar">
				<div class="container">
					<div class="navbar-content">
						<a href="#" class="navbar-brand">
							HMS<span></span>
						</a>
						<form class="search-form">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i data-feather="search"></i>
									</div>
								</div>
								<input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
							</div>
						</form>
						<ul class="navbar-nav">
              <x-dashboard.list-hotels count="7"/>
							<li class="nav-item dropdown nav-apps">
								
							</li>
							<li class="nav-item dropdown nav-messages">
								<a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="flag-icon flag-icon-us mt-1" title="us"></i> <span class="font-weight-medium ml-1 mr-1">English</span>
								</a>
								<div class="dropdown-menu" aria-labelledby="languageDropdown">
									<a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-us" title="us" id="us"></i> <span class="ml-1"> English </span></a>
									<a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-fr" title="fr" id="fr"></i> <span class="ml-1"> French </span></a>
									<a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-de" title="de" id="de"></i> <span class="ml-1"> German </span></a>
									<a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-pt" title="pt" id="pt"></i> <span class="ml-1"> Portuguese </span></a>
									<a href="javascript:;" class="dropdown-item py-2"><i class="flag-icon flag-icon-es" title="es" id="es"></i> <span class="ml-1"> Spanish </span></a>
								</div>
							</li>
              
							{{-- <li class="nav-item dropdown nav-notifications">
								<a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i data-feather="bell"></i>
									<div class="indicator">
										<div class="circle"></div>
									</div>
								</a>
								<div class="dropdown-menu" aria-labelledby="notificationDropdown">
									<div class="dropdown-header d-flex align-items-center justify-content-between">
										<p class="mb-0 font-weight-medium">6 New Notifications</p>
										<a href="javascript:;" class="text-muted">Clear all</a>
									</div>
									<div class="dropdown-body">
										<a href="javascript:;" class="dropdown-item">
											<div class="icon">
												<i data-feather="user-plus"></i>
											</div>
											<div class="content">
												<p>New customer registered</p>
												<p class="sub-text text-muted">2 sec ago</p>
											</div>
										</a>
										<a href="javascript:;" class="dropdown-item">
											<div class="icon">
												<i data-feather="gift"></i>
											</div>
											<div class="content">
												<p>New Order Recieved</p>
												<p class="sub-text text-muted">30 min ago</p>
											</div>
										</a>
										<a href="javascript:;" class="dropdown-item">
											<div class="icon">
												<i data-feather="alert-circle"></i>
											</div>
											<div class="content">
												<p>Server Limit Reached!</p>
												<p class="sub-text text-muted">1 hrs ago</p>
											</div>
										</a>
										<a href="javascript:;" class="dropdown-item">
											<div class="icon">
												<i data-feather="layers"></i>
											</div>
											<div class="content">
												<p>Apps are ready for update</p>
												<p class="sub-text text-muted">5 hrs ago</p>
											</div>
										</a>
										<a href="javascript:;" class="dropdown-item">
											<div class="icon">
												<i data-feather="download"></i>
											</div>
											<div class="content">
												<p>Download completed</p>
												<p class="sub-text text-muted">6 hrs ago</p>
											</div>
										</a>
									</div>
									<div class="dropdown-footer d-flex align-items-center justify-content-center">
										<a href="javascript:;">View all</a>
									</div>
								</div>
							</li>    --}}
								<li class="dropdown-item mt-1" style="margin-left:10%;">
                    
                                    <form method="POST" action="{{ route('logout') }}">
                                      @csrf
                        
                                      <x-dropdown-link :href="route('logout')"
                                              onclick="event.preventDefault();
                                                          this.closest('form').submit();">
                                                          
                                          <i class="me-7 icon-md" style="color: gray" data-feather="log-out"></i>                
                                          <span style="color: gray">{{ __('Log Out') }}</span>
                                      </x-dropdown-link>
                                    </form>
                                  
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div class="page-wrapper full-page">
			@if ($hotel_request->status == 'block')
			<div class="page-content d-flex align-items-center justify-content-center">

				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
						<img src="{{asset('backend/assets/images/hotel_closed.jpg')}}" class="img-fluid mb-2" alt="404">
						<h1 class="fw-bolder mb-22 mt-2 tx-70 text-muted">Hotel closed !!</h1>
                        <h4 class="fw-bolder mt-2 text-muted">Because of the violation of one of Hotel Activity Rules " " </h4>
                        <h4 class="fw-bolder mt-2 text-muted">You have to check the tourism office</h4>
						<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
							
						</div>
					</div>
				</div>

			</div>
			@else
			<div class="page-content d-flex align-items-center justify-content-center">
				<div class="row w-100 mx-0 auth-page">
			<div class="" style="margin-left: 30%;">
				<div aria-labelledby="swal2-title" aria-describedby="swal2-html-container" class="swal2-popup swal2-modal swal2-icon-info swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: grid;"><ul class="swal2-progress-steps" style="display: none;"></ul><div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;"><div class="swal2-icon-content"></div><span class="swal2-success-line-tip"></span><span class="swal2-success-line-long"></span></div><img class="swal2-image" style="display: none;"><h2 class="swal2-title" id="swal2-title" style="display: block;"><strong>Success un block</u></strong></h2><div class="swal2-html-container" id="swal2-html-container" style="display: block;">You can <b>Login</b> to HMS ,you just have to <u>Logout</u> then Login again.</div><input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;"><div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select class="swal2-select" style="display: none;"></select><div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"><span class="swal2-label"></span></label><textarea class="swal2-textarea" style="display: none;"></textarea><div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div><div class="swal2-footer" style="display: none;"></div><div class="swal2-timer-progress-bar-container"><div class="swal2-timer-progress-bar" style="display: none;"></div></div></div>
			  </div>
				</div></div>
			@endif
			
		</div>
	</div>
	</div>
  <script src="{{asset('backend/assets_/vendors/core/core.js')}}"></script>
	<!-- endinject -->
	<!-- plugin js for this page -->
	<script src="{{asset('backend/assets_/vendors/prismjs/prism.js')}}"></script>
	<script src="{{asset('backend/assets_/clipboard/clipboard.min.js')}}"></script>
	<!-- end plugin js for this page -->
  
  <script src="{{asset('backend/assets_/vendors/feather-icons/feather.min.js')}}"></script>
  <script src="{{ asset('backend/assets_/jst/jquery-3.6.0.min.js')}}"></script>
  <script src="{{ asset('backend/assets_/jst/datatables.min.js')}}"></script>
  {{-- <script src="{{ asset('backend/assets_/jst/pdfmake.min.js')}}"></script>
  <script src="{{ asset('backend/assets_/jst/vfs_fonts.js')}}"></script> --}}
  <script src="{{ asset('backend/assets_/jst/custom-req.js')}}"></script>

<!-- Plugin js for this page -->
<script src="{{asset('backend/assets_/vendors/flatpickr/flatpickr.min.js')}}"></script>
<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="{{asset('backend/assets_/vendors/feather-icons/feather.min.js')}}"></script>
{{-- <script src="{{asset('backend/assets_/js/template.js')}}"></script> --}}
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{asset('backend/assets_/js/dashboard-light.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
 @endif 
</script>

</body>
</html>