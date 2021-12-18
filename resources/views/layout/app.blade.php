<!DOCTYPE html>
<html lang="en">

<!-- blank.html  Tue, 07 Jan 2020 03:35:42 GMT -->
<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<title>
    CSRMSS &mdash; @yield('title')
</title>
<link rel="shortcut icon" href="{{ asset('asset/img/logo.png') }}">
<!-- General CSS Files -->
<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.css') }}">
<link rel="stylesheet" href="{{ asset('css/toast/iziToast.css') }}">
<link rel="stylesheet" href="{{ asset('datepicker/jquery-ui.css') }}">
<!-- CSS Libraries -->

<!-- Template CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
@yield('moreCss')
</head>
<body>
    @csrf
    <!-- Page Loader -->
    {{-- <div class="page-loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div> --}}
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('../layout/navbar')
            @include('../layout/sidebar')
            <!-- Start app main Content -->
            <div class="main-content">
                @yield('content')
            </div>
           @include('../layout.footer')
        </div>
    </div>

    {{-- <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('../layout/navbar')
            @include('../layout/main-sidebar')
            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            @include('../layout/footer')
        </div>
    </div> --}}

<!-- General JS Scripts -->
<script src="{{ asset('assets/bundles/lib.vendor.bundle.js') }}"></script>
<script src="{{ asset('js/CodiePie.js') }}"></script>
<script src="{{ asset('js/toast/iziToast.js') }}"></script>

<!-- JS Libraies -->

<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/global.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('datepicker/jquery-ui.js') }}"></script>

@yield('moreJs')
</body>

<!-- blank.html  Tue, 07 Jan 2020 03:35:42 GMT -->
</html>