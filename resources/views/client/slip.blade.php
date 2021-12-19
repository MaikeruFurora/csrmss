<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>PNOP &mdash;</title>

<!-- General CSS Files -->
<link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.css') }}">

   <!-- Template CSS -->
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
            border: 1px solid green;
        }

        .not .ui-state-default {
            color: gray;
            border: 1px solid gray;
        }
    </style>
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                    class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                    
                        <div id="capture">

                            <div class="card card-hero shadow-lg">
                                <div class="card-header">
                                  <div class="card-icon">
                                    <i class="fas fa-church"></i>
                                  </div>
                                  <h4><small style="font-size: 15px">No.</small> {{$registerService->transaction_no }}</h4>
                                  <div class="card-description">Transaction Slip</div>
                                </div>
                                <div class="card-body p-0">

                                    <ul class="list-unstyled list-unstyled-border p-4">
                                       <div class="row">
                                           <div class="col-lg-6">
                                            <li class="media">
                                                <a href="#">
                                                    {{-- <img class=" width=" 50" src="{{ asset('image/avatar-1.png') }}" alt="product">
                                                    --}}
                                                    <i class="mr-3 rounded fas fa-user mr-4 " style="font-size: 23px"></i>
                                                </a>
                                                <div class="media-body">
                                                   
                                                    <div class="media-title">{{ auth()->user()->fullname  }}</div>
                                                    <div class="text-muted text-small">Fullname</div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <a href="#">
                                                    <i class="mr-3 rounded fas fa-location-arrow mr-4 " style="font-size: 23px"></i>
                                                </a>
                                                <div class="media-body">
                                                   
                                                    <div class="media-title">{{ auth()->user()->address }}</div>
                                                    <div class="text-muted text-small">Address
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <a href="#">
                                                    <i class="mr-3 rounded fas fa-calendar mr-4 " style="font-size: 23px"></i>
                                                </a>
                                                <div class="media-body">
                                                 <div class="media-title">{{ $registerService->schedule_date}}</div>
                                                    <div class="text-muted text-small">Date Scheduled
                                                    </div>
                                                </div>
                                            </li>
                                           </div>
                                           <div class="col-lg-6 text-center">
                                            <img class="img-fluid m-0 " src="{{ asset('asset/img/logo.png') }}"
                                            alt="PNHS LOGO" width="80px">
                                            <br><br>
                                            <small class="">
                                                <b>Note:</b> This will serve will serve as a proof of transaction and or appointment, 
                                                present this to the personnel in charge upon entering the office the day of your appointment. Thank you!
                                            </small>
                                           </div>
                                       </div>
                                      
                
                                    </ul>
                                  <div class="tickets-list">
                                   
                                    <button id="btn" class="ticket-item ticket-more btn btn-icon icon-left btn-primary">
                                        <i class="fas fa-download"></i> Download Image
                                    </button>
                                  </div>
                                </div>
                              </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/html2canvas/html2canvas.js') }}"></script>
    <script>
    $("#btn").on('click',function(){
        $(".card-hero").removeClass('shadow-lg')
        $(this).hide();
      setTimeout(() => {
        $(".card-body").addClass("bg-white")
        html2canvas(document.getElementById("capture")).then(function (canvas) {
      //  console.log(canvas.toDataURL("image/jpeg", 0.9));
        var a=document.createElement('a');
                a.href = canvas.toDataURL("image/png");
                a.download = "appointment-slip.png";
                a.click();
     });
     $(".card-hero").addClass('shadow-lg')
     $(this).show();   
      }, 1500);
    })
    </script>
</body>

</html>