<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Webpixels">
    <title>CSRMSS</title>
    <link rel="shortcut icon" href="{{ asset('asset/img/logo.png') }}">
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
    <!-- Modal -->
        {{-- <div class="modal fade bd-example-modal-xl" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title lead" id="staticBackdropLabel">Services</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body"> --}}
                
            {{-- <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card" >
                        <div class="card-header">
                            <h4 class="lead">Baptism</h4>
                        </div>
                        <div class="card-body">
            <div class="p-3 d-flex"> --}}
                                        {{-- <div>
                                            <div class="icon icon-shape rounded-circle bg-warning text-white mr-4">
                                             
                                                <i class="fas fa-baby"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="h6">100% Responsive</span>
                                            <p class="text-sm text-muted mb-0">
                                                Built to be customized.
                                            </p>
                                        </div>
                                    </div>
                        </div>
                        <div class="card-footer p-1">
                            <a href="{{ route('register','baptism') }}" class="btn btn-secondary btn-sm btn-block btn-icon">Proceed
                            <span class="btn-inner--icon"><i data-feather="chevron-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="lead">Wedding</h4>
                        </div>
                        <div class="card-body">
                        <div class="p-3 d-flex">
                                        <div>
                                            <div class="icon icon-shape rounded-circle bg-info text-white mr-4">
                                                <i class="fas fa-female"></i>
                                                <i class="fas fa-male"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="h6">100% Responsive</span>
                                            <p class="text-sm text-muted mb-0">
                                                Built to be customized.
                                            </p>
                                        </div>
                                    </div>    
                        </div>
                        <div class="card-footer p-1">
                            <a href="{{ route('register','wedding') }}" class="btn btn-secondary btn-sm btn-block btn-icon">Proceed
                            <span class="btn-inner--icon"><i data-feather="chevron-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card" style="background-image: url('{{ asset("landing_asset/img/brand/favicon.png") }}')">
                        <div class="card-header">
                            <h4 class="lead">Cofirmation</h4>
                        </div>
                        <div class="card-body">
                        <div class="p-3 d-flex">
                                        <div>
                                            <div class="icon icon-shape rounded-circle bg-success text-white mr-4">
                                                <i class="fas fa-hands"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="h6">100% Responsive</span>
                                            <p class="text-sm text-muted mb-0">
                                                Built to be customized.
                                            </p>
                                        </div>
                                    </div>    
                        </div>
                        <div class="card-footer p-1">
                            <a href="{{ route('register','confirmation') }}" class="btn btn-secondary btn-sm btn-block btn-icon">Proceed
                            <span class="btn-inner--icon"><i data-feather="chevron-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="lead">Mass</h4>
                        </div>
                        <div class="card-body">
                        <div class="p-3 d-flex">
                                        <div>
                                            <div class="icon icon-shape rounded-circle bg-danger text-white mr-4">
                                                <i class="fas fa-church"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="h6">100% Responsive</span>
                                            <p class="text-sm text-muted mb-0">
                                                Built to be customized.
                                            </p>
                                        </div>
                                    </div>    
                        </div>
                        <div class="card-footer p-1">
                            <a href="{{ route('register','mass') }}" class="btn btn-secondary btn-sm btn-block btn-icon">Proceed
                            <span class="btn-inner--icon"><i data-feather="chevron-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="lead">Burial</h4>
                        </div>
                        <div class="card-body">
                        <div class="p-3 d-flex">
                                        <div>
                                            <div class="icon icon-shape rounded-circle bg-info text-white mr-4">
                                                <i class="fas fa-cross"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="h6">100% Responsive</span>
                                            <p class="text-sm text-muted mb-0">
                                                Built to be customized.
                                            </p>
                                        </div>
                                    </div>    
                        </div>
                        <div class="card-footer p-1">
                            <a href="{{ route('register','burial') }}" class="btn btn-secondary btn-sm btn-block btn-icon">Proceed
                            <span class="btn-inner--icon"><i data-feather="chevron-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div> --}}
            {{-- </div>

                </div>
                <div class="modal-footer p-1">
                <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div> --}}
    <!-- Preloader -->
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
                    <img src="{{ asset('asset/img/logo.png') }}" class="img-fluid" style="height: 100px;" alt="Illustration" />
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
    {{-- <section class="slice slice-lg pt-lg-6 pb-0 pb-lg-6 bg-section-secondary" id="missionVision">
        <div class="container">
            <!-- Title -->
            <!-- Section title -->
            <div class="row mb-5 justify-content-center text-center">
                <div class="col-lg-6">
                   
                    <h2 class=" mt-4">Our Services</h2>
                    <!-- <div class="mt-2">
                        <p class="lead lh-180">sa</p>
                    </div> -->
                </div>
            </div>
            <!-- Card -->
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body pb-5">
                            <div class="pt-4 pb-5">
                                <img src="{{asset('landing_asset/img/svg/illustrations/illustration-5.svg')}}" class="img-fluid img-center" style="height: 150px;" alt="Illustration" />
                            </div>
                            <h5 class="h4 lh-130 mb-3">Baptism</h5>
                            <p class="text-muted mb-0">
                                To protect and promote the right of every Filipino to quality, equitably, culture-based, and complete basic education where:
                                <ul>
                                    <li>Students learn in a child-friendly, gender-sensitive, safe, and motivating environment</li>
                                    <li>Teachers facilitate learning and constantly nurture every learner</li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body pb-5">
                            <div class="pt-4 pb-5">
                                <img src="{{asset('landing_asset/img/svg/illustrations/illustration-6.svg')}}" class="img-fluid img-center" style="height: 150px;" alt="Illustration" />
                            </div>
                            <h5 class="h4 lh-130 mb-3">Wedding</h5>
                            <p class="text-muted mb-0">
                                We dream of Filipinos who passionately love their country and whose values and competencies enable them to realize their full potential and contribute meaningfully to building the nation. As a learner-centered public institution, the Department of Education continuously improves itself to better serve its stakeholders.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body pb-5">
                            <div class="pt-4 pb-5">
                                <img src="{{asset('landing_asset/img/svg/illustrations/illustration-6.svg')}}" class="img-fluid img-center" style="height: 150px;" alt="Illustration" />
                            </div>
                            <h5 class="h4 lh-130 mb-3">Comfirmation</h5>
                            <p class="text-muted mb-0">
                                We dream of Filipinos who passionately love their country and whose values and competencies enable them to realize their full potential and contribute meaningfully to building the nation. As a learner-centered public institution, the Department of Education continuously improves itself to better serve its stakeholders.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
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