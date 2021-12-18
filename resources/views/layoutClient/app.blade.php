<!DOCTYPE html>
<html lang="en">

<!-- layout-top-navigation.html  Tue, 07 Jan 2020 03:35:42 GMT -->
<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<title>CSRMSS</title>

<!-- General CSS Files -->
<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

<!-- CSS Libraries -->

<!-- Template CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/components.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/toast/iziToast.css') }}">    
<link rel="stylesheet" href="{{ asset('datepicker/jquery-ui.css') }}">
</head>

<body class="layout-3">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
</div>
<div id="app">
    <div class="main-wrapper container">
        <div class="navbar-bg"></div>
        <!-- Start app top navbar -->
        @include('../layoutClient/navbar')
        <!-- Start app main Content -->
        <div class="main-content" style="margin-top">
            @yield('content')
        </div>
       @include('../layoutClient/footer')
    </div>
</div>

<!-- General JS Scripts -->
<script src="{{ asset('assets/bundles/lib.vendor.bundle.js') }}"></script>
<script src="{{ asset('js/CodiePie.js') }}"></script>
<script src="{{ asset('js/toast/iziToast.js') }}"></script>

<!-- JS Libraies -->

<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="{{ asset('js/scripts.js') }}"></script>
{{-- <script src="js/custom.js"></script> --}}
{{-- <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script> --}}
<script src="{{ asset('datepicker/jquery-ui.js') }}"></script>
@yield('moreJs')
</body>

<!-- layout-top-navigation.html  Tue, 07 Jan 2020 03:35:42 GMT -->
</html>