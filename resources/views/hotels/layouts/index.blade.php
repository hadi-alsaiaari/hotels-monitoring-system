
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="">
	<meta name="keywords" content="bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<title>HMS - Hotel Panel</title>

  <style>
  /*** Spinner ***/

    #spinner {
        opacity: 0;
        visibility: hidden;
        transition: opacity .5s ease-out, visibility 0s linear .5s;
        z-index: 99999;
    }
    
    #spinner.show {
        transition: opacity .5s ease-out, visibility 0s linear 0s;
        visibility: visible;
        opacity: .85;
    }
    </style>
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets1/css/template.bundle.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets1/css/template.dark.bundle.css') }}" media="(prefers-color-scheme: dark)"> --}}

<!-- End custom js for this page -->

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

	<!-- core:css -->
	<link rel="stylesheet" href="{{asset('backend/assets_/vendors/core/core.css')}}">
	<!-- endinject -->
  <link rel="stylesheet" href="{{ asset('backend/assets_/csst/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('backend/assets_/csst/datatables.min.css')}}">
	<!-- Plugin css for this page -->
	<link rel="stylesheet" href="{{asset('backend/assets_/vendors/flatpickr/flatpickr.min.css')}}">
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="{{asset('backend/assets_/fonts/feather-font/css/iconfont.css')}}">
	<link rel="stylesheet" href="{{asset('backend/assets_/vendors/flag-icon-css/css/flag-icon.min.css')}}">
	<!-- endinject -->
  
	<link rel="stylesheet" href="{{asset('backend/assets_/vendors/select2/select2.min.css')}}">
  <!-- dark Theem -->  
	{{-- <link rel="stylesheet" href="{{asset('backend/assets_/css/demo2/style.css')}}"> --}}
  <!-- Light Theem -->  
  <link rel="stylesheet" href="{{asset('backend/assets_/css/demo1/style.css')}}">
  <!-- End layout styles -->
  <link rel="stylesheet" href="{{asset('backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css')}}">
  <!-- End layout styles -->
  <link rel="stylesheet" href="{{asset('backend/assets/vendors/sweetalert2/sweetalert2.min.css')}}">

	<link rel="stylesheet" href="{{asset('backend/assets_/vendors/dropify/dist/dropify.min.css')}}">

  <link rel="shortcut icon" href="{{asset('backend/assets_/images/favicon.png')}}" />
  <!-- Fonts -->

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
  
  {{-- <!-- Favicon -->
<link rel="shortcut icon" href="./assets/img/favicon/favicon.ico" type="image/x-icon">

<!-- Font -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700" rel="stylesheet"> --}}
</head>
<body>
  <!-- Spinner Start -->
  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only"></span>
    </div>
</div>
<!-- Spinner End -->
	<div class="main-wrapper">
		<!-- partial:partials/_sidebar.html -->
		@include('hotels.layouts.sidebar')
		<!-- partial -->
	
		<div class="page-wrapper">
					
			<!-- partial:partials/_navbar.html -->
			@include('hotels.layouts.header')
			<!-- partial -->
      {{-- <div class="alert alert-primary" role="alert">
        <i data-feather="alert-circle"></i>
        A simple primary alert—check it out!
      </div> --}}
			@yield('dashboard')

			<!-- partial:partials/_footer.html -->
			@include('hotels.layouts.footer')
			<!-- partial -->
		
		</div>
	</div>

	  <!-- core:js -->
    <script src="{{asset('backend/assets_/vendors/core/core.js')}}"></script>
    <!-- endinject -->
    
    <!-- Plugin js for this page -->
    <script src="{{asset('backend/assets_/vendors/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('backend/assets_/vendors/apexcharts/apexcharts.min.js')}}"></script>
    <!-- End plugin js for this page -->
    
    <!-- inject:js -->
    <script src="{{asset('backend/assets_/vendors/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('backend/assets_/js/template.js')}}"></script>
    <!-- endinject -->
    
    <!-- Custom js for this page -->
    <script src="{{asset('backend/assets_/js/dashboard-light.js')}}"></script>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{asset('backend/assets_/js/tags-input.js')}}"></script>
    <script src="{{asset('backend/assets_/js/inputmask.js')}}"></script>
    <script src="{{asset('backend/assets_/js/form-validation.js')}}"></script>
    <script src="{{asset('backend/assets_/js/bootstrap-maxlength.js')}}"></script>
    <script src="{{asset('backend/assets_/js/inputmask.js')}}"></script>
    <script src="{{asset('backend/assets_/js/select2.js')}}"></script>
    <script src="{{asset('backend/assets_/js/typeahead.js')}}"></script>
    <script src="{{asset('backend/assets/js/dropzone.js')}}"></script>
    <script src="{{asset('backend/assets/js/dropify.js')}}"></script>
    <script src="{{asset('backend/assets/js/pickr.js')}}"></script>
    <script src="{{asset('backend/assets/js/flatpickr.js')}}"></script>
    <script src="{{asset('backend/assets_/vendors/jquery-tags-input/jquery.tagsinput.min.js')}}"></script>
    <script src="{{asset('backend/assets_/vendors/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('backend/assets_/vendors/dropify/dist/dropify.min.js')}}"></script>
    <script src="{{asset('backend/assets_/vendors/moment/moment.min.js')}}"></script>
    
    <script src="{{asset('backend/assets_/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{asset('backend/assets_/vendors/inputmask/jquery.inputmask.min.js')}}"></script>
    <script src="{{asset('backend/assets_/vendors/select2/select2.min.js')}}"></script>
    <script src="{{asset('backend/assets_/vendors/typeahead.js/typeahead.bundle.min.js')}}"></script>
    <script src="{{ asset('backend/assets_/jst/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('backend/assets_/jst/datatables.min.js')}}"></script>
    <script src="{{ asset('backend/assets_/jst/pdfmake.min.js')}}"></script>
    <script src="{{ asset('backend/assets_/jst/vfs_fonts.js')}}"></script>
    <script src="{{ asset('backend/assets_/jst/custom.js')}}"></script>
    <script src="{{ asset('backend/assets/js/sweet-alert.js')}}"></script>
    <script src="{{ asset('backend/assets/vendors/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{ asset('backend/assets/vendors/promise-polyfill/polyfill.min.js')}}"></script>
    <script src="{{ asset('backend/assets_/vendors/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{ asset('backend/assets_/js/apexcharts-light.js')}}"></script>
    <script src="{{ asset('backend/assets_/js/chat.js')}}"></script>
    <script src="{{ asset('js/main.js')}}"></script>
    
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
    