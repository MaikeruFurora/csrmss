@extends('../layoutClient/app')
@section('content')
<section class="section">

    <div class="section-body">
        <h2 class="section-title">Services</h2>
        <p class="section-lead">Please select and register</p>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <article class="article">
                    <div class="article-header">
                        <div class="article-image" data-background="{{ asset('asset/img/1.jpg') }}">
                        </div>
                        <div class="article-title">
                            <h2><a href="#">Baptism</a></h2>
                        </div>
                    </div>
                    <div class="article-details">
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. </p>
                        <div class="article-cta">
                            <a href="{{ route('client.registerForm','Baptism') }}" class="btn btn-block btn-primary">Proceed</a>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <article class="article">
                    <div class="article-header">
                        <div class="article-image" data-background="{{ asset('asset/img/2.jpg') }}">
                        </div>
                        <div class="article-title">
                            <h2><a href="#">Wedding</a></h2>
                        </div>
                    </div>
                    <div class="article-details">
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. </p>
                        <div class="article-cta">
                            <a href="{{ route('client.registerForm','Wedding') }}" class="btn btn-block btn-primary">Proceed</a>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <article class="article">
                    <div class="article-header">
                        <div class="article-image" data-background="{{ asset('asset/img/3.jpg') }}">
                        </div>
                        <div class="article-title">
                            <h2><a href="#">Burial</a></h2>
                        </div>
                    </div>
                    <div class="article-details">
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. </p>
                        <div class="article-cta">
                            <a href="{{ route('client.registerForm','Burial') }}" class="btn btn-block btn-primary">Proceed</a>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <article class="article">
                    <div class="article-header">
                        <div class="article-image" data-background="{{ asset('asset/img/4.jpg') }}">
                        </div>
                        <div class="article-title">
                            <h2><a href="#">Mass</a></h2>
                        </div>
                    </div>
                    <div class="article-details">
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. </p>
                        <div class="article-cta">
                            <a href="{{ route('client.registerForm','Mass') }}" class="btn btn-block btn-primary">Proceed</a>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <article class="article">
                    <div class="article-header">
                        <div class="article-image" data-background="{{ asset('asset/img/4.jpg') }}">
                        </div>
                        <div class="article-title">
                            <h2><a href="#">Confirmation</a></h2>
                        </div>
                    </div>
                    <div class="article-details">
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. </p>
                        <div class="article-cta">
                            <a href="{{ route('client.registerForm','Confirmation') }}" class="btn btn-block btn-primary">Proceed</a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
@endsection