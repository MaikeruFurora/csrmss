<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>CSRMSS &mdash; Register</title>

<!-- General CSS Files -->
<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/toast/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
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
                    <form method="POST" action="{{ route('auth.register.post') }}">@csrf
                        <div class="card card-hero">
                            <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-church"></i>
                            </div>
                            <h5>REGISTER FORM</h5>
                            <div class="card-description"> <small>{{ date('M d, Y') }}</small></div>
                            <span>St. Paul The Apostle Parish</span>
                            </div>
                            <div class="card-body">
                           <div class="form-group">
                               <label for="">Fullname</label>
                               <input id="" class="form-control" type="text" required value="{{ old('fullname') }}" name="fullname" placeholder="Enter your fullname">
                           </div>
                          <div class="form-row">
                            <div class="form-group col-6">
                                <label for="">Contact No.</label>
                                <input id="" class="form-control" type="text" onkeypress="return numberOnly(event)"  maxlength="11" required value="{{ old('contact_no') }}" name="contact_no" placeholder="Enter your Contact No.">
                            </div>
                            <div class="form-group col-6">
                                <label for="">Email</label>
                                <input id="" class="form-control" type="email" value="{{ old('email') }}" name="email" placeholder="Enter your email">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="">Address</label>
                            <input id="" class="form-control" type="text" value="{{ old('address') }}" name="address" required placeholder="Enter your complete address">
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input id="" class="form-control" type="text" value="{{ old('username') }}" name="username" required placeholder="Enter your complete username">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input id="" class="form-control" type="password" name="password" required placeholder="Enter your complete password">
                        </div>
                        <div class="form-group">
                            <label for="">Confirm password</label>
                            <input id="" class="form-control" type="password" name="confirm_password" required placeholder="Enter your complete confirm password">
                            @error('confirm_password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="card-footer p-1">
                            <button type="submit" class="btn btn-block btn-primary btn-lg btnSave">Register</button>
                        </div>
                            </div>
                        </div></form>
                    <a href="{{ route('welcome') }}">Back to Home</a>
                </div>
            </div>
        </section>
    </div>



    <!-- General JS Scripts -->
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}">
    </script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}">
    </script>
    <script src="{{ asset('assets/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('js/global.js') }}"></script>
    <script>
        // $('input[name="confirm_password"]').on
    </script>
</body>

</html>