<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Requstis</title>
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
      $hotel_user = $request->user()->load('user_of_hotel.hotels');
      $hotelinfo = $hotel_user->user_of_hotel->hotels()->where('id', $id)->with('rooms')->first();
      $hotel_request = App\Models\HotelRequest::where('hotel_id', $id)->first();
  @endphp
  {{-- @dd($hotelinfo); --}}
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
		<div class="page-wrapper" style="width: 100%; ">
      @if ($hotelinfo->license == 'request')
      <div class="row" style="height: 100%;">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Continue to register</h4>
                    <p class="text-muted mb-3"></p>
                    <div id="wizard" role="application" class="wizard clearfix"><div class="steps clearfix"><ul role="tablist"><li role="tab" class="first current" aria-disabled="false" aria-selected="true"><a id="" href="#wizard-h-0" aria-controls="wizard-p-0"><span class="current-info audible">current step: </span><span class="number">1.</span> Rooms data</a></li><li role="tab" class="disabled" aria-disabled="true"><a id="wizard-t-1" href="#wizard-h-1" aria-controls="wizard-p-1"><span class="number">2.</span> Treatment</a></li><li role="tab" class="disabled last" aria-disabled="true"><a id="wizard-t-3" href="#wizard-h-3" aria-controls="wizard-p-3"><span class="number">3.</span> Date visit</a></li><li role="tab" class="disabled" aria-disabled="true"><a id="wizard-t-2" href="#wizard-h-2" aria-controls="wizard-p-2"><span class="number">4.</span> Bill</a></li><li role="tab" class="disabled last" aria-disabled="true"><a id="wizard-t-3" href="#wizard-h-3" aria-controls="wizard-p-3"><span class="number">5.</span> Verified</a></li><li role="tab" class="disabled last" aria-disabled="true"><a id="wizard-t-3" href="#wizard-h-3" aria-controls="wizard-p-3"><span class="number">6.</span> Finish</a></li></ul></div><div class="content clearfix">
                      
                      <h2 aria-disabled="" id="wizard-h-0" tabindex="-1" class="title current">Room data</h2>
                        <section role="tabpanel" aria-labelledby="wizard-h-0" class="body current" aria-hidden="false">
                          <div class="page-content ">
                          <div class="col-md-14 stretch-card" >
                            <div class="card">
                              <div class="card-body">
                                <h6 class="card-title">Room data</h6>
                                  <form action="{{route('add_rooms',$hotelinfo->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf 
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label class="form-label">Number room</label>
                                          <input type="number" name="number" class="form-control" placeholder="Enter number room" required>
                                        </div>
                                      </div><!-- Col -->
                                      <div class="col-sm-6">
                                        <div class="mb-3">
                                          <label class="form-label">Category</label>
                                          <select name="category" id="sex" class="form-control" aria-invalid="false" >
                                            <option selected="" disabled="" required>Select category</option>
                                            <option>A</option>
                                            <option>B</option>
                                            <option>C</option>
                                            <option>D</option>
                                            <option>E</option>
                                        </select>
                                      </div>
                                      </div><!-- Col -->
                                    </div><!-- Row -->
                                    <div class="row">
                                      <div class="col-sm-4">
                                        <div class="mb-3">
                                          <label class="form-label">Type</label>
                                          <select name="type" id="type" class="form-control" aria-invalid="false" >
                                            <option selected="" disabled="" required>Select type</option>
                                            <option>Single</option>
                                            <option>Double</option>
                                            <option>Treble</option>
                                            <option>Apartment</option>
                                            <option>Suite</option>
                                        </select>  
                                        </div>
                                      </div><!-- Col -->
                                      <div class="col-sm-4">
                                        <div class="mb-3">
                                          <label class="form-label">Floor</label>
                                          <input type="number" name="floor" class="form-control" placeholder="Enter Floor" required>
                                        </div>
                                      </div><!-- Col -->
                                      <div class="col-sm-4">
                                        <div class="mb-3">
                                          <label class="form-label">Price</label>
                                          <input type="number" name="price" class="form-control" placeholder="Enter Price" required>
                                        </div>
                                      </div><!-- Col -->
                                    </div><!-- Row -->
                                    <button type="submit" class="btn btn-primary submit">Add room</button>
                                    <a href="{{route('finsh_add_rooms', $hotelinfo->id)}}" class="btn btn-warning me-1 link-icon" >
                                      Finished 
                                    </a>
                                  </form>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-14 stretch-card mt-2">
                              <div class="container">
                                <div class="col-md-12">
                                    <div class="">
                                      <div class="card">
                                        <div class="card-body">
                                          <h6 class="card-title">All Rooms</h6>
                                      <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered">
                                            <thead class="table-white">
                                                <tr>
                                                    <th>Number room</th>
                                                    <th>Category</th>
                                                    <th>Type</th>
                                                    <th>Floor</th>
                                                    <th>Price</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                                <tbody>  
                                                  
                                                  @foreach($hotelinfo->rooms as $n => $room)
                                                  <tr>
                                                      <td class="sorting_1">{{$room->number}}</td>
                                                      <td>{{$room->category}}</td>
                                                      <td>{{$room->type}}</td>
                                                      <td>{{$room->floor}}</td>
                                                      <td>{{$room->price}}</td>
                                                      <td>
                                                          <form action="{{route('delete_rooms',$room->id )}}" method="post">
                                                              @csrf
                                                              @method('DELETE') 
                                                              <input type="text" name="hotel_id" value="{{$hotelinfo->id}}" hidden>
                                                              <button class="btn btn-danger me-1 link-icon"  type="submit">
                                                                  Delete
                                                              </button>
                                                          </form>
                                                    </td>
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
                      </div>
                        </section>
                    </div></div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if ($hotelinfo->license == 'request2')
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Continue to register</h4>
                    <p class="text-muted mb-3"></p>
                    <div id="wizard" role="application" class="wizard clearfix"><div class="steps clearfix"><ul role="tablist"><li role="tab" class="first done" aria-disabled="false" aria-selected="false"><a id="wizard-t-0" href="#wizard-h-0" aria-controls="wizard-p-0"><span class="number">1.</span> Room data</a></li><li role="tab" class="current" aria-disabled="false" aria-selected="true"><a id="wizard-t-1" href="#wizard-h-1" aria-controls="wizard-p-1"><span class="current-info audible">current step: </span><span class="number">2.</span> Treatment</a></li><li role="tab" class="disabled last" aria-disabled="true"><a id="wizard-t-3" href="#wizard-h-3" aria-controls="wizard-p-3"><span class="number">3.</span> Date visit</a></li><li role="tab" class="disabled" aria-disabled="true"><a id="wizard-t-2" href="#wizard-h-2" aria-controls="wizard-p-2"><span class="number">4.</span> Bill</a></li><li role="tab" class="disabled last" aria-disabled="true"><a id="wizard-t-3" href="#wizard-h-3" aria-controls="wizard-p-3"><span class="number">5.</span> Verified</a></li><li role="tab" class="disabled last" aria-disabled="true"><a id="wizard-t-3" href="#wizard-h-3" aria-controls="wizard-p-3"><span class="number">6.</span> Finish</a></li></ul></div><div class="content clearfix">
                      <section role="tabpanel" aria-labelledby="wizard-h-0" class="body current" aria-hidden="false">
                          <div class="page-content ">
              
                      <div class="row w-100 mx-0 auth-page">
                          <div class="col-md-6 col-xl-6 mx-auto">
                              <div class="card">
                                  <div class="row">
                      <div class="col-md-4 pe-md-0">
                        <div class="auth-side-wrapper">
                          <img src="{{asset('backend/assets/images/wating_image-a08f8333242bb71b0de34b59e51bcdff.png')}}" style=" height:300px;width: 300px;" alt="">
                        </div>
                      </div>
                      <div class="col-md-8 ps-md-0">
                        <div class="auth-form-wrapper px-4 py-4">
                          <a href="#" class="noble-ui-logo logo-light d-block mb-2">HMS<span></span></a>
                          <h5 class="text-muted fw-normal mb-4">{{__('Your request is under Treatment')}} Register to your account.</h5>
                              
                              <div class="col-sm-6 col-md-4 col-lg-11" style="font-size: 18px;"> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 28 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg> {{__('A reply will be made and an appointment will be made within 5 working days')}} <div class="spinner-grow spinner-grow-sm" role="status">
                                  <span class="sr-only"></span>
                                  </div> </div>
                                  
      
      
                          </div>
                      </div>
                    </div>
                              </div>
                          </div>
                      </div>
      
                  </div>
                        </section>
                    </div></div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if ($hotelinfo->license == 'processing')
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Continue to register</h4>
                    <p class="text-muted mb-3"></p>
                    <div id="wizard" role="application" class="wizard clearfix"><div class="steps clearfix"><ul role="tablist"><li role="tab" class="first done" aria-disabled="false" aria-selected="false"><a id="wizard-t-0" href="#wizard-h-0" aria-controls="wizard-p-0"><span class="number">1.</span> Room data</a></li><li role="tab" class="first done" aria-disabled="false" aria-selected="false"><a id="wizard-t-0" href="#wizard-h-0" aria-controls="wizard-p-0"><span class="number">2.</span> Treatment</a></li><li role="tab" class="current" aria-disabled="false" aria-selected="true"><a id="wizard-t-1" href="#wizard-h-1" aria-controls="wizard-p-1"><span class="current-info audible">current step: </span><span class="number">3.</span> Date visit</a></li><li role="tab" class="disabled" aria-disabled="true"><a id="wizard-t-2" href="#wizard-h-2" aria-controls="wizard-p-2"><span class="number">4.</span> Bill</a></li><li role="tab" class="disabled last" aria-disabled="true"><a id="wizard-t-3" href="#wizard-h-3" aria-controls="wizard-p-3"><span class="number">5.</span> Verified</a></li><li role="tab" class="disabled last" aria-disabled="true"><a id="wizard-t-3" href="#wizard-h-3" aria-controls="wizard-p-3"><span class="number">6.</span> Finish</a></li></ul></div><div class="content clearfix">
                      <section role="tabpanel" aria-labelledby="wizard-h-0" class="body current" aria-hidden="false">
                          <div class="page-content ">
              
                      <div class="row w-100 mx-0 auth-page">
                          <div class="col-md-8 col-xl-6 mx-auto">
                              <div class="card">
                                  <div class="row">
                      <div class="col-md-4 pe-md-0">
                        <div class="auth-side-wrapper">
                          <img src="{{asset('backend/assets/images/clock-logo-vector-20442098.jpg')}}" style=" height:200px;width: 230px;" alt="">
                        </div>
                      </div>
                      <div class="col-md-8 ps-md-0">
                        <div class="auth-form-wrapper px-4 py-4">
                          <a href="#" class="noble-ui-logo logo-light d-block mb-2">HMS<span></span></a>
                          <h5 class="text-muted fw-normal mb-4">{{__('The field visit to the hotel be on ')}}</h5>
                       
                          <h5>{{__("Date : $hotel_request->field_landing_at")}}</h5>
                          </div>
                      </div>
                    </div>
                              </div>
                          </div>
                      </div>
      
                  </div>
                        </section>
                    </div></div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if ($hotelinfo->license == 'preparation2')
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Continue to register</h4>
                    <p class="text-muted mb-3"></p>
                    <div id="wizard" role="application" class="wizard clearfix"><div class="steps clearfix"><ul role="tablist"><li role="tab" class="first done" aria-disabled="false" aria-selected="false"><a id="wizard-t-0" href="#wizard-h-0" aria-controls="wizard-p-0"><span class="number">1.</span> Room data</a></li><li role="tab" class="done" aria-disabled="false" aria-selected="false"><a id="wizard-t-1" href="#wizard-h-1" aria-controls="wizard-p-1"><span class="number">2.</span> Treatment</a></li><li role="tab" class="done" aria-disabled="false" aria-selected="false"><a id="wizard-t-1" href="#wizard-h-1" aria-controls="wizard-p-1"><span class="number">3.</span> Date visit</a></li><li role="tab" class="done" aria-disabled="false" aria-selected="false"><a id="wizard-t-1" href="#wizard-h-1" aria-controls="wizard-p-1"><span class="number">4.</span> Bill</a></li><li role="tab" class="current" aria-disabled="false" aria-selected="true"><a id="wizard-t-2" href="#wizard-h-2" aria-controls="wizard-p-2"><span class="current-info audible">current step: </span><span class="number">5.</span> Verified</a></li><li role="tab" class="disabled last" aria-disabled="true"><a id="wizard-t-3" href="#wizard-h-3" aria-controls="wizard-p-3"><span class="number">6.</span> Finish</a></li></ul></div><div class="content clearfix">
                      <section role="tabpanel" aria-labelledby="wizard-h-0" class="body current" aria-hidden="false">
                          <div class="page-content ">
              
                      <div class="row w-100 mx-0 auth-page">
                          <div class="col-md-8 col-xl-6 mx-auto">
                              <div class="card">
                                  <div class="row">
                      <div class="col-md-4 pe-md-0">
                        <div class="auth-side-wrapper">
                          <img src="{{asset('backend/assets/images/bill-icon-sign-symbol-logo-free-vector.jpg')}}" style=" height:200px;width: 250px;" alt="">
                        </div>
                      </div>
                      <div class="col-md-8 ps-md-0 mt-4">
                        <div class="auth-form-wrapper px-4 py-4">
                          <a href="#" class="noble-ui-logo logo-light d-block mb-2">HMS<span></span></a>
                          <h5 class="fw-normal mb-4">{{__('The entry invoice will be verified')}}</h5>
                          <div class="spinner-grow text-dark" role="status">
                            <span class="visually-hidden"></span>
                          </div>
                          </div>
                      </div>
                    </div>
                              </div>
                          </div>
                      </div>
      
                  </div>
                        </section>
                    </div></div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if ($hotelinfo->license == 'preparation')
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Continue to register</h4>
                    <p class="text-muted mb-3"></p>
                    <div id="wizard" role="application" class="wizard clearfix"><div class="steps clearfix"><ul role="tablist"><li role="tab" class="first done" aria-disabled="false" aria-selected="false"><a id="wizard-t-0" href="#wizard-h-0" aria-controls="wizard-p-0"><span class="number">1.</span> Room data</a></li><li role="tab" class="done" aria-disabled="false" aria-selected="false"><a id="wizard-t-1" href="#wizard-h-1" aria-controls="wizard-p-1"><span class="number">2.</span> Treatment</a></li><li role="tab" class="done" aria-disabled="false" aria-selected="false"><a id="wizard-t-1" href="#wizard-h-1" aria-controls="wizard-p-1"><span class="number">3.</span> Date visit</a></li><li role="tab" class="current" aria-disabled="false" aria-selected="true"><a id="wizard-t-2" href="#wizard-h-2" aria-controls="wizard-p-2"><span class="current-info audible">current step: </span><span class="number">4.</span> Bill</a></li><li role="tab" class="disabled last" aria-disabled="true"><a id="wizard-t-3" href="#wizard-h-3" aria-controls="wizard-p-3"><span class="number">5.</span> Verified</a></li><li role="tab" class="disabled last" aria-disabled="true"><a id="wizard-t-3" href="#wizard-h-3" aria-controls="wizard-p-3"><span class="number">6.</span> Finish</a></li></ul></div><div class="content clearfix">
                      
                      {{-- <h2 aria-disabled="" id="wizard-h-0" tabindex="-1" class="title current">Room data</h2> --}}
                        <section role="tabpanel" aria-labelledby="wizard-h-0" class="body current" aria-hidden="false">
                          <div class="page-content">
                    <div class="row">
                      <div class="col-md-5 grid-margin" style="margin-left: 34%;">
                        <div class="card rounded">
                          <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="ms-2">
                                  <p>{{__('Bill')}}</p>
                                  <p class="tx-11 text-muted"></p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="">
                            <div class="mt-1 d-flex social-links">
                              <div class="card">
                                <div class="card-body"> 
                                  <h6 class="card-title">You must enter Licens fees to activate your account</h6>         
                                  <p>The calss of your hotel is {{$hotel_request->class}} stars. <br /> Please pay {{$hotel_request->money}} Yemeni riyals for license issuance fee to Tourism Office account. The account number is {{$hotel_request->account}} in {{$hotel_request->bank}} Bank.</p>             
                                  <form class="forms-sample mt-3" method="POST" action="{{route('uploadFile', $hotelinfo->id)}}" enctype="multipart/form-data" >
                                    @csrf 
                                    <div class="input-group flatpickr" id="flatpickr-date">
                                      <input type="file" name="transfer_deed" class="form-control" style="width: 50%;" id="exampleInputUsername1" accept="application/pdf">
                                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    </div>
                                  </form>
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                        </section>
                    </div></div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if ($hotelinfo->license == 'valid')
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Continue to register</h4>
                    <p class="text-muted mb-3"></p>
                    <div id="wizard" role="application" class="wizard clearfix"><div class="steps clearfix"><ul role="tablist"><li role="tab" class="first done" aria-disabled="false" aria-selected="false"><a id="wizard-t-0" href="#wizard-h-0" aria-controls="wizard-p-0"><span class="number">1.</span> Room data</a></li><li role="tab" class="first done" aria-disabled="false" aria-selected="false"><a id="wizard-t-0" href="#wizard-h-0" aria-controls="wizard-p-0"><span class="number">2.</span> Treatment</a></li><li role="tab" class="first done" aria-disabled="false" aria-selected="false"><a id="wizard-t-0" href="#wizard-h-0" aria-controls="wizard-p-0"><span class="number">3.</span> Data visit</a></li><li role="tab" class="done" aria-disabled="false" aria-selected="false"><a id="wizard-t-1" href="#wizard-h-1" aria-controls="wizard-p-1"><span class="number">4.</span> Bill</a></li><li role="tab" class="done" aria-disabled="false" aria-selected="false"><a id="wizard-t-1" href="#wizard-h-1" aria-controls="wizard-p-1"><span class="number">5.</span> Verified</a></li><li role="tab" class="current" aria-disabled="false" aria-selected="true"><a id="wizard-t-1" href="#wizard-h-1" aria-controls="wizard-p-1"><span class="current-info audible">current step: </span><span class="number">6.</span> Finish</a></li></ul></div><div class="content clearfix">                      
                      {{-- <h2 aria-disabled="" id="wizard-h-0" tabindex="-1" class="title current">Room data</h2> --}}
                        <section role="tabpanel" aria-labelledby="wizard-h-0" class="body current" aria-hidden="false">
                          <div class="" style="margin-left: 30%;">
                            <div aria-labelledby="swal2-title" aria-describedby="swal2-html-container" class="swal2-popup swal2-modal swal2-icon-info swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: grid;"><ul class="swal2-progress-steps" style="display: none;"></ul><div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;"><div class="swal2-icon-content"></div><span class="swal2-success-line-tip"></span><span class="swal2-success-line-long"></span></div><img class="swal2-image" style="display: none;"><h2 class="swal2-title" id="swal2-title" style="display: block;"><strong>Success</u></strong></h2><div class="swal2-html-container" id="swal2-html-container" style="display: block;">You can <b>Login</b> to HMS ,you just have to <u>Logout</u> then Login again.</div><input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;"><div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select class="swal2-select" style="display: none;"></select><div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"><span class="swal2-label"></span></label><textarea class="swal2-textarea" style="display: none;"></textarea><div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div><div class="swal2-footer" style="display: none;"></div><div class="swal2-timer-progress-bar-container"><div class="swal2-timer-progress-bar" style="display: none;"></div></div></div>
                          </div>
                        </section>
                    </div></div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if ($hotelinfo->license == 'rejected')
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Continue to register</h4>
                    <p class="text-muted mb-3"></p>
                    <div id="wizard" role="application" class="wizard clearfix"><div class="steps clearfix"><ul role="tablist"><li role="tab" class="first done" aria-disabled="false" aria-selected="false"><a id="wizard-t-0" href="#wizard-h-0" aria-controls="wizard-p-0"><span class="number">1.</span> Room data</a></li><li role="tab" class="first done" aria-disabled="false" aria-selected="false"><a id="wizard-t-0" href="#wizard-h-0" aria-controls="wizard-p-0"><span class="number">2.</span> Treatment</a></li><li role="tab" class="first done" aria-disabled="false" aria-selected="false"><a id="wizard-t-0" href="#wizard-h-0" aria-controls="wizard-p-0"><span class="number">3.</span> Data visit</a></li><li role="tab" class="done" aria-disabled="false" aria-selected="false"><a id="wizard-t-1" href="#wizard-h-1" aria-controls="wizard-p-1"><span class="number">4.</span> Bill</a></li><li role="tab" class="done" aria-disabled="false" aria-selected="false"><a id="wizard-t-1" href="#wizard-h-1" aria-controls="wizard-p-1"><span class="number">5.</span> Verified</a></li><li role="tab" class="current" aria-disabled="false" aria-selected="true"><a id="wizard-t-1" href="#wizard-h-1" aria-controls="wizard-p-1"><span class="current-info audible">current step: </span><span class="number">6.</span> Finish</a></li></ul></div><div class="content clearfix">                      
                      {{-- <h2 aria-disabled="" id="wizard-h-0" tabindex="-1" class="title current">Room data</h2> --}}
                        <section role="tabpanel" aria-labelledby="wizard-h-0" class="body current" aria-hidden="false">
                          <div class="" style="margin-left: 30%;">
                            <div aria-labelledby="swal2-title" aria-describedby="swal2-html-container" class="swal2-popup swal2-modal swal2-icon-info swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: grid;"><ul class="swal2-progress-steps" style="display: none;"></ul><div class="swal2-icon swal2-error swal2-icon-show" style="display: flex;"><div class="swal2-icon-content"></div><span class="swal2-x-mark-line-left"></span>
                            <span class="swal2-x-mark-line-right"></span><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></div><img class="swal2-image" style="display: none;"><h2 class="swal2-title" id="swal2-title" style="display: block;"><strong>Rejected</u></strong></h2><div class="swal2-html-container" id="swal2-html-container" style="display: block;">Your request has rejected. <b>You should</b> check with the tourism office as soon as possible</div><input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;"><div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select class="swal2-select" style="display: none;"></select><div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"><span class="swal2-label"></span></label><textarea class="swal2-textarea" style="display: none;"></textarea><div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div><div class="swal2-footer" style="display: none;"></div><div class="swal2-timer-progress-bar-container"><div class="swal2-timer-progress-bar" style="display: none;"></div></div></div>
                          </div>
                        </section>
                    </div></div>
                </div>
            </div>
        </div>
    </div>
    @endif
      {{-- <form id="msform" >
        @csrf
        <!-- progressbar -->
        <ul id="progressbar">
            <li class="active" id="account"><strong>Hotel</strong></li>
            <li id="personal"><strong>Hotel Owner</strong></li>
            <li id="payment"><strong>Document</strong></li>
            <li id="personal"><strong>Account</strong></li>
        </ul>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div> <br> <!-- fieldsets -->
        @if ($hotelinfo->license == 'request')
        <fieldset>
            <div class="form-card">
                <div class="row">
                    <div class="col-7">
                        <h2 class="fs-title">Hotel data</h2>
                    </div>
                    <div class="col-5">
                        <h2 class="steps">Step 1 - 4</h2>
                    </div>
                </div> 
                
                
            <div class=" row-cols-1 ">
        <div class="page-content ">
            <div class="col-md-14 stretch-card" >
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Room data</h6>
                    <form action="{{route('add_rooms',$hotelinfo->id)}}" method="POST" enctype="multipart/form-data">
                      @csrf 
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">Number room</label>
                            <input type="number" name="number" class="form-control" placeholder="Enter number room" required>
                          </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category" id="sex" class="form-control" aria-invalid="false" >
                              <option selected="" disabled="" required>Select category</option>
                              <option>A</option>
                              <option>B</option>
                              <option>C</option>
                              <option>D</option>
                              <option>E</option>
                          </select>
                        </div>
                        </div><!-- Col -->
                      </div><!-- Row -->
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select name="type" id="type" class="form-control" aria-invalid="false" >
                              <option selected="" disabled="" required>Select type</option>
                              <option>Single</option>
                              <option>Double</option>
                              <option>Treble</option>
                              <option>Apartment</option>
                              <option>Suite</option>
                          </select>  
                          </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                          <div class="mb-3">
                            <label class="form-label">Floor</label>
                            <input type="number" name="floor" class="form-control" placeholder="Enter Floor" required>
                          </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                          <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" name="price" class="form-control" placeholder="Enter Price" required>
                          </div>
                        </div><!-- Col -->
                      </div><!-- Row -->
                      <button type="submit" class="btn btn-primary submit">Add room</button>
                      <a href="{{route('finsh_add_rooms', $hotelinfo->id)}}" class="btn btn-warning me-1 link-icon" >
                        Finished 
                      </a>
                    </form>
                </div>
              </div>
            </div>
            <div class="col-md-14 stretch-card mt-2">
                <div class="container">
                  <div class="col-md-12">
                      <div class="">
                        <div class="card">
                          <div class="card-body">
                            <h6 class="card-title">All Rooms</h6>
                        <div class="table-responsive">
                          <table id="example" class="table table-striped table-bordered">
                              <thead class="table-white">
                                  <tr>
                                      <th>Number room</th>
                                      <th>Category</th>
                                      <th>Type</th>
                                      <th>Floor</th>
                                      <th>Price</th>
                                      <th>Option</th>
                                  </tr>
                              </thead>
                                  <tbody>  
                                    
                                    @foreach($hotelinfo->rooms as $n => $room)
                                    <tr>
                                        <td class="sorting_1">{{$room->number}}</td>
                                        <td>{{$room->category}}</td>
                                        <td>{{$room->type}}</td>
                                        <td>{{$room->floor}}</td>
                                        <td>{{$room->price}}</td>
                                        <td>
                                            <form action="{{route('delete_rooms',$room->id )}}" method="post">
                                                @csrf
                                                @method('DELETE') 
                                                <input type="text" name="hotel_id" value="{{$hotelinfo->id}}" hidden>
                                                <button class="btn btn-danger me-1 link-icon"  type="submit">
                                                    Delete
                                                </button>
                                            </form>
                                      </td>
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
        </div>
        
      </div>
      
            </div>
        </fieldset>
        @endif
        @if ($hotelinfo->license == 'processing')
        <fieldset>
            <div class="form-card">
                <div class="row">
                    <div class="col-7">
                        <h2 class="fs-title">Hotel Owner Information:</h2>
                    </div>
                    <div class="col-5">
                        <h2 class="steps">Step 2 - 4</h2>
                    </div>
                </div> 
                
                
                  <div class="page-content d-flex align-items-center justify-content-center">
              
                      <div class="row w-100 mx-0 auth-page">
                          <div class="col-md-6 col-xl-6 mx-auto">
                              <div class="card">
                                  <div class="row">
                      <div class="col-md-4 pe-md-0">
                        <div class="auth-side-wrapper">
                          <img src="{{asset('backend/assets/images/wating_image-a08f8333242bb71b0de34b59e51bcdff.png')}}" style=" height:200px;width: 200px;" alt="">
                        </div>
                      </div>
                      <div class="col-md-8 ps-md-0">
                        <div class="auth-form-wrapper px-4 py-4">
                          <a href="#" class="noble-ui-logo logo-light d-block mb-2">HMS<span>UI</span></a>
                          <h5 class="text-muted fw-normal mb-4">{{__('Your request is under treatment')}} Register to your account.</h5>
                              
                              <div class="col-sm-6 col-md-4 col-lg-11"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg> {{__('A reply will be made and an appointment will be made within 5 working days')}} <div class="spinner-grow spinner-grow-sm" role="status">
                                  <span class="sr-only"></span>
                                  </div> </div>
                                  
      
      
                          </div>
                      </div>
                    </div>
                              </div>
                          </div>
                      </div>
      
                  </div>
                 
            </div> 
        </fieldset>
        @endif
        @if ($hotelinfo->license == 'preparation')
        <fieldset>
            <div class="form-card">
                <div class="row">
                    <div class="col-7">
                        <h2 class="fs-title">Document Upload:</h2>
                    </div>
                    <div class="col-5">
                        <h2 class="steps">Step 3 - 4</h2>
                    </div>
                </div> 
                
                <div class="col-md-8 col-xl-6 middle-wrapper page-content d-flex align-items-center justify-content-center">
                    <div class="row">
                      <div class="col-md-12 grid-margin">
                        <div class="card rounded">
                          <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                              <div class="d-flex align-items-center">
                                <div class="ms-2">
                                  <p>{{__('You must enter Licens fees to activate your account')}}</p>
                                  <p class="tx-11 text-muted"></p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-body">
                            <div class="mt-1 d-flex social-links">
                              <div class="card">
                                <div class="card-body"> 
                                  <h6 class="card-title">Bill</h6>                      
                                  <form class="forms-sample" method="POST" action="{{route('uploadFile', $hotelinfo->id)}}" enctype="multipart/form-data" >
                                    @csrf 
                                    <div class="input-group flatpickr" id="flatpickr-date">
                                      <input type="file" name="transfer_deed" class="form-control" style="width: 50%;" id="exampleInputUsername1" accept="application/pdf">
                                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    </div>
                                  </form>
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                

                </div> 
                   
        </fieldset>
        @endif
        @if ($hotelinfo->license == 'valid')
        <fieldset>
            <div class="form-card">
                <div class="row">
                    <div class="col-7">
                        <h2 class="fs-title">Account:</h2>
                    </div>
                    <div class="col-5">
                        <h2 class="steps">Step 4 - 4</h2>
                    </div>
                </div>
                
              <div class="col-md-8 col-xl-6 middle-wrapper page-content d-flex align-items-center justify-content-center">
                <div aria-labelledby="swal2-title" aria-describedby="swal2-html-container" class="swal2-popup swal2-modal swal2-icon-info swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: grid;"><ul class="swal2-progress-steps" style="display: none;"></ul><div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;"><div class="swal2-icon-content"></div><span class="swal2-success-line-tip"></span><span class="swal2-success-line-long"></span></div><img class="swal2-image" style="display: none;"><h2 class="swal2-title" id="swal2-title" style="display: block;"><strong>Success</u></strong></h2><div class="swal2-html-container" id="swal2-html-container" style="display: block;">You can <b>Login</b> to HMS ,you just have to <u>Logout</u> then Login again.</div><input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;"><div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select class="swal2-select" style="display: none;"></select><div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"><span class="swal2-label"></span></label><textarea class="swal2-textarea" style="display: none;"></textarea><div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div><div class="swal2-footer" style="display: none;"></div><div class="swal2-timer-progress-bar-container"><div class="swal2-timer-progress-bar" style="display: none;"></div></div></div>
              </div>
            
            </div>
            
            
        </fieldset>
        @endif
    </form> --}}
           
        
            
            
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