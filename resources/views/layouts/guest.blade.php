<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'HMS') }}</title>
        <link rel="stylesheet" href="{{asset('backend/assets/vendors/sweetalert2/sweetalert2.min.css')}}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('backend/assets/vendors/core/core.css')}}">
      <!-- endinject -->
      <!-- plugin css for this page -->
      <!-- end plugin css for this page -->
      <!-- inject:css -->
      <link rel="stylesheet" href="{{asset('backend/assets/fonts/feather-font/css/iconfont.css')}}">
      <link rel="stylesheet" href="{{asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
      <!-- endinject -->
      <!-- Layout styles -->  
      <link rel="stylesheet" href="{{asset('backend/assets/css/demo_1/style.css')}}">
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
    </head>
    <body class="font-sans text-gray-900 antialiased"> 

            <div class="">
                {{ $slot }}
            </div>

            <script src="{{asset('backend/assets/vendors/core/core.js')}}"></script>
	<!-- endinject -->
  <!-- plugin js for this page -->
	<!-- end plugin js for this page -->
	<!-- inject:js -->
	<script src="{{asset('backend/assets/vendors/feather-icons/feather.min.js')}}"></script>
	<script src="{{asset('backend/assets/js/template.js')}}"></script>
  <script src="{{asset('backend/assets/js/scriptwizerd.js')}}"></script>

  <script src="{{asset('backend/assets_/js/tags-input.js')}}"></script>
<script src="{{asset('backend/assets_/js/inputmask.js')}}"></script>
<script src="{{asset('backend/assets_/js/form-validation.js')}}"></script>
<script src="{{asset('backend/assets_/js/bootstrap-maxlength.js')}}"></script>
<script src="{{asset('backend/assets_/js/inputmask.js')}}"></script>
<script src="{{asset('backend/assets_/js/select2.js')}}"></script>
<script src="{{asset('backend/assets_/js/typeahead.js')}}"></script>
<script src="{{asset('backend/assets_/js/dropzone.js')}}"></script>
<script src="{{asset('backend/assets_/js/dropify.js')}}"></script>
<script src="{{asset('backend/assets_/js/pickr.js')}}"></script>
<script src="{{asset('backend/assets_/js/flatpickr.js')}}"></script>
<script src="{{asset('backend/assets_/vendors/jquery-tags-input/jquery.tagsinput.min.js')}}"></script>
<script src="{{asset('backend/assets_/vendors/dropzone/dropzone.min.js')}}"></script>
<script src="{{asset('backend/assets_/vendors/dropify/dist/dropify.min.js')}}"></script>
<script src="{{asset('backend/assets_/vendors/moment/moment.min.js')}}"></script>

<script src="{{asset('backend/assets_/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{asset('backend/assets_/vendors/inputmask/jquery.inputmask.min.js')}}"></script>
<script src="{{asset('backend/assets_/vendors/select2/select2.min.js')}}"></script>
<script src="{{asset('backend/assets_/vendors/typeahead.js/typeahead.bundle.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/sweet-alert.js')}}"></script>
<script src="{{ asset('backend/assets/vendors/sweetalert2/sweetalert2.min.js')}}"></script>

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
