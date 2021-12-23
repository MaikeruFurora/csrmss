<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Webpixels">
    <title>CSRMSS</title>
    <link rel="shortcut icon" href="{{ asset('image/'.$church_logo) }}">
    <!-- Preloader -->
    <style>
        @keyframes hidePreloader {
            0% {
                width: 100%;
                height: 100%;
            }

            100% {
                width: 0;
                height: 0;
            }
        }

        body>div.preloader {
            position: fixed;
            background: white;
            width: 100%;
            height: 100%;
            z-index: 1071;
            opacity: 0;
            transition: opacity .5s ease;
            overflow: hidden;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body:not(.loaded)>div.preloader {
            opacity: 1;
        }

        body:not(.loaded) {
            overflow: hidden;
        }

        body.loaded>div.preloader {
            animation: hidePreloader .5s linear .5s forwards;
        }
    </style>
    <script>
        window.addEventListener("load", function() {
            setTimeout(function() {
                document.querySelector('body').classList.add('loaded');
            }, 300);
        });
    </script>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('landing_asset/img/brand/favicon.png" type="image/png') }}"><!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('landing_asset/libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <!-- Quick CSS -->
    <link rel="stylesheet" href="{{ asset('landing_asset/css/quick-website.css') }}" id="stylesheet">
</head>

<body>
 
    <div class="preloader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <section class="slice py-7">
        <div class="container">
            <div class="row row-grid align-items-center">
                <div class="col-12 col-md-5 col-lg-6 order-md-2 text-center">
                    <!-- Image -->
                    <figure class="w-100">
                        <img alt="Image placeholder" src="{{ asset('landing_asset/img/svg/illustrations/illustration-5.svg') }}" class="img-fluid mw-md-120">
                    </figure>
                </div>
                <div class="col-12 col-md-7 col-lg-6 order-md-1 pr-md-5">
                    <!-- Heading -->
                    <img src="{{ asset('image/'.$church_logo) }}" class="img-fluid" style="height: 100px;" alt="Illustration" />
                    <h1 class=" text-center text-md-left mb-3 mt-2">
                        <strong class="text-primary">CSRMSS:</strong>
                        Church Services Record Management and Scheduling System
                    </h1>
                    <!-- Text -->
                    <p class="lead text-center text-md-left text-muted">
                        We are a church that connects people with God, helps them grow strong and healthy relationships, and live a life full of generosity.
                    </p>
                    <!-- Buttons -->
                    <div class="text-center text-md-left mt-5">
                        {{-- <button class="btn btn-primary btn-icon btnSelect">
                            <span class="btn-inner--text">Register Services</span>
                            <span class="btn-inner--icon"><i data-feather="chevron-right"></i></span>
                        </button> --}}
                        <a href="{{ route('auth.register') }}" class="btn btn-primary btn-icon">
                            <span class="btn-inner--text">Register</span>
                            <span class="btn-inner--icon"><i data-feather="chevron-right"></i></span>
                        </a>
                       @guest
                       <a href="{{ route('auth.login') }}" class="btn btn-neutral btn-icon d-none d-lg-inline-block">Sign In</a>
                        @else
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-neutral btn-icon d-none d-lg-inline-block">Go back</a>
                       @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>
  
    <section class="slice slice-lg pt-lg-6 pb-0 pb-lg-6 bg-section-secondary" id="pnhsHistory">
        <div class="container">
            <div class="py-6">
                <div class="row row-grid align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <h5 class="h3">St. Paul The Apostle Parish</h5>
                        <p class="lead my-4">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima veritatis architecto doloribus aspernatur sequi. Quisquam officiis quidem est necessitatibus. Facere veritatis sapiente laboriosam iure eius placeat earum fuga quod. Accusamus.
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Labore unde porro cupiditate. In beatae accusamus ducimus tempora at, placeat omnis odit iste eius, repellat dolor tenetur eveniet nihil esse quasi.   omnis odit iste eius, repellat dolor tenetur eveniet nihil esse quasi.   
                        </p>
                      
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="card mb-0">
                            <div class="card-body p-1">
                                <img alt="Image placeholder" src="{{ asset('asset/img/bg.jpg') }}" class="img-fluid shadow rounded">
                            </div>
                        </div>
                    </div>
                </div>
                <p class="lead">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis dolorem impedit libero et, iure aperiam nobis maiores. Minima saepe, nisi, delectus possimus enim veritatis quos numquam temporibus earum facere consequatur. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi laboriosam, omnis dicta doloremque deleniti atque eum qui fugit natus neque impedit voluptatum, asperiores sint blanditiis minima repellendus officiis, error dignissimos.
                </p>
            </div>
            
        </div>
    </section>
    <footer class="position-relative" id="footer-main">
        <div class="footer pt-lg-7 footer-dark bg-dark">
            <!-- SVG shape -->
            <div class="shape-container shape-line shape-position-top shape-orientation-inverse">
                <svg width="2560px" height="100px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" viewBox="0 0 2560 100" style="enable-background:new 0 0 2560 100;" xml:space="preserve" class=" fill-section-secondary">
                    <polygon points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
            <!-- Footer -->
            <div class="container pt-4">
            
                <hr class="divider divider-fade divider-dark my-4">
                <div class="row align-items-center justify-content-md-between pb-4">
                    <div class="col-md-6">
                        <div class="copyright text-sm font-weight-bold text-center text-md-left">
                            &copy; 2020 <a href="https://webpixels.io" class="font-weight-bold" target="_blank">Webpixels</a>. All rights reserved
                        </div>
                    </div>
                    <div class="col-md-6">
                        <ul class="nav justify-content-center justify-content-md-end mt-3 mt-md-0">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Team Gladious
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Core JS  -->
    <script src="{{ asset('landing_asset/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('landing_asset/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing_asset/libs/svg-injector/dist/svg-injector.min.js') }}"></script>
    <script src="{{ asset('landing_asset/libs/feather-icons/dist/feather.min.js') }}"></script>
    <!-- Quick JS -->
    <script src="{{ asset('landing_asset/js/quick-website.js') }}"></script>
    <!-- Feather Icons -->
    <script>
        feather.replace({
            'width': '1em',
            'height': '1em'
        })

        $(".btnSelect").on('click',function(){
            $("#staticBackdrop").modal("show")
        });
    </script>
</body>

</html>