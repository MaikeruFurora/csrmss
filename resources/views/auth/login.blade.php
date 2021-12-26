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
                <div class="col-lg-8 offset-lg-2">
                    {{-- <div class="card mb-3">
                        <div class="card-body pb-1 text-center">
                            <h4>{{ $church_name }}</h4>
                        </div>
                    </div> --}}
                    <form method="POST" action="{{ route('auth.login.post') }}">@csrf
                    <div class="card shadow">
                        <div class="row no-gutters">
                          <div class="col-md-4 p-3 bg-info">
                            <img src="{{ asset('image/'.$church_logo) }}" class="card-img" alt="background">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <h5 class="card-title text-dark">SIGN IN</h5>
                              <div class="card-description"> <small>{{ date('M d, Y') }}</small></div>
                              {{-- <span>{{ $church_name }}</span> --}}
                              <div class="input-group mt-3">
                                {{-- <div class="input-group-prepend">
                                  <span class="input-group-text">First and last name</span>
                                </div> --}}
                                <input type="text" name="username" value="{{ old('username') }}" class="form-control" required placeholder="Username">
                                <input type="password" name="password" class="form-control" required placeholder="Password">
                              </div>
                              <button class="btn btn-block btn-info mb-3 mt-2">Login</button>
                              <a href="{{ route('auth.register') }}">Create account?</a> | <a href="{{ route('welcome') }}">Back to Home</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                    
                   
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