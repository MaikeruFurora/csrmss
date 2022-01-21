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
    <link rel="stylesheet" href="{{ asset('css/toast/iziToast.css') }}">
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
    <div class="modal fade" id="approvedModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="approvedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="approvedModalLabel">Term and Condition</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <p>A Terms and Conditions agreement acts as legal contracts between you (the company) who has the website or mobile app, and the user who accesses your website/app.
                    Having a Terms and Conditions agreement is completely optional. No laws require you to have one. Not even the super-strict and wide-reaching General Data Protection Regulation (GDPR).
                    Your Terms and Conditions agreement will be uniquely yours. While some clauses are standard and commonly seen in pretty much every Terms and Conditions agreement, it's up to you to set the rules and guidelines that the user must agree to.</p>
                
                <b>REPUBLIC ACT NO. 10173</b>

                <p>AN ACT PROTECTING INDIVIDUAL PERSONAL INFORMATION IN INFORMATION AND COMMUNICATIONS SYSTEMS IN THE GOVERNMENT AND THE PRIVATE SECTOR, CREATING FOR THIS PURPOSE A NATIONAL PRIVACY COMMISSION, AND FOR OTHER PURPOSES</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
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
                        <small>* All fields marked with an asterisk are required</small>
                           <div class="form-group">
                               <label for=""><span class="text-danger">*</span> Fullname</label>
                               <input id="" class="form-control" type="text" required value="{{ old('fullname') }}" name="fullname" placeholder="Enter your fullname">
                           </div>
                          <div class="form-row">
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label for=""><span class="text-danger">*</span> Contact No.</label>
                                <input id="" class="form-control" type="text" onkeypress="return numberOnly(event)"  maxlength="11" required value="{{ old('contact_no') }}" name="contact_no" placeholder="Enter your Contact No.">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label for=""> Email</label>
                                <input id="" class="form-control" type="email" value="{{ old('email') }}" name="email" placeholder="Enter your email">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for=""><span class="text-danger">*</span> Address</label>
                            <input id="" class="form-control" type="text" value="{{ old('address') }}" name="address" required placeholder="Enter your complete address">
                        </div>
                        <div class="form-group">
                            <label for=""><span class="text-danger">*</span> Username</label>
                            <input id="" class="form-control" type="text" value="{{ old('username') }}" name="username" required placeholder="Enter your complete username">
                            <span class="uniqueUsername"></span>
                        </div>
                        <div class="form-group">
                            <label for=""><span class="text-danger">*</span> Password</label>
                            <input id="" class="form-control" type="password" name="password" required placeholder="Enter your complete password">
                        </div>
                        <div class="form-group">
                            <label for=""><span class="text-danger">*</span> Confirm password</label>
                            <input id="" class="form-control" type="password" name="confirm_password" required placeholder="Enter your complete confirm password">
                            <span class="text-danger confirmpass"></span>
                            @error('confirm_password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="btn-group-toggle">
                                {{-- <label class="btn btn-primary"> --}}
                                    <input type="checkbox"> Terms and Condition | Data Privacy Act of 2012
                                {{-- </label> --}}
                            </div>
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
    <script src="{{ asset('js/toast/iziToast.js') }}"></script>
    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('js/global.js') }}"></script>
    <script>
        $('.btnSave').prop("disabled",true);
        $('input[type="checkbox"]').on('click',function(){
            if($(this).is(":checked")){
                $("#approvedModal").modal("show")
            }
            $('.btnSave').prop("disabled", !$(this).is(":checked"));
        })
        
        $("input[name='confirm_password']").on('blur',function(){
            if($(this).val()==$('input[name="password"]').val()){
                $(".confirmpass").text('');
            }else{
                $(".confirmpass").text("Confirm password didn't match");

            }
        })

        $('input[name="username"]').on('blur',function(){
            $.ajax({
                url: "/register/check/username/" + $(this).val(),
                type: "GET",
            })
                .done(function (response) {
                    if(response.msg){
                        $(".uniqueUsername").text(response.msg).addClass('text-danger');
                        $('input[name="username"]').removeClass('is-valid').addClass('is-invalid');
                        $('.btnSave').hide();
                    }else{
                        $(".uniqueUsername").text('Available').addClass('text-success');
                        $('input[name="username"]'). removeClass('is-invalid').addClass('is-valid');
                        $('.btnSave').show();
                    }
                })
                .fail(function (jqxHR, textStatus, errorThrown) {
                    console.log(jqxHR, textStatus, errorThrown);
                    // getToast("error", "Eror", errorThrown);
                });
        });
    </script>
</body>

</html>