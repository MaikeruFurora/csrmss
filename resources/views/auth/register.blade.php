<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>CSRMSS &mdash; Login</title>

<!-- General CSS Files -->
<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/toast/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
    <style>
        .center-screen {
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* text-align: center; */
            min-height: 90vh;
        }

        .full .ui-state-default {
            color: red;
            border: 1px solid red;
        }

        .vacant .ui-state-default {
            color: green;
            border: .5px solid green;
        }

        .not .ui-state-default {
            color: gray;
            border: 1px solid gray;
        }

        .ui-datepicker-unselectable .ui-state-default {
            background: gray;
            color: black;
            border: none
        }
    </style>
</head>

<body>

    <div id="app">
        <section class="section">
            <div class="container mt-2 center-screen">
                <div class="col-lg-6 offset-lg-3">
                    <form action="{{ route('register.store') }}">
                        <div class="card card-hero">
                            <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-church"></i>
                            </div>
                            <h4>{{ strtoupper($type) }}</h4>
                            <div class="card-description">Registration Form | <small>{{ date('M d, Y') }}</small></div>
                            <span>St. Paul The Apostle Parish</span>
                            </div>
                            <div class="card-body">
                           <div class="form-group">
                               <label for="">Fullname</label>
                               <input id="" class="form-control" type="text" required name="fullname" placeholder="Please Enter your Fullname">
                           </div>
                          <div class="form-row">
                            <div class="form-group col-6">
                                <label for="">Contact No.</label>
                                <input id="" class="form-control" type="text" required name="contact_no" placeholder="Please Enter your Contact No.">
                            </div>
                            <div class="form-group col-6">
                                <label for="">Email</label>
                                <input id="" class="form-control" type="text" name="email" placeholder="Please Enter your email">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="">Address</label>
                            <input id="" class="form-control" type="text" name="address" required placeholder="Please Enter your complete address">
                        </div>
                        <div class="form-group">
                            <label for="">Select Date</label>
                            <input id="" class="form-control" type="text" name="fullname" required >
                        </div>
                        <div class="card-footer p-1">
                            <button type="submit" class="btn btn-block btn-primary btn-lg">Register</button>
                        </div>
                            </div>
                        </div></form>
                    <a href="{{ url()->previous() }}">Back to Home</a>
                </div>
            </div>
        </section>
    </div>



    <!-- General JS Scripts -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}">
    </script>
    <script src="{{ asset('js/bootstrap.min.js') }}">
    </script>
    <script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations.js"></script>
    <script src="{{ asset('js/global.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>

    {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script> --}}
    <script src="{{ asset('js/appoint.js') }}"></script>

</body>

</html>