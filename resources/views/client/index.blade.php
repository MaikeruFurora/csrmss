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
                        <p>Allow us to demonstrate our connection with Jesus and with our brothers and sisters in Christ </p>
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
                        <p>is the ceremony in which two people are united in marriage </p>
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
                        <p>Religious service of the Roman Catholic Church. which has as its central act the perfotmance of the sacrament of the Eucharist</p>
                        <div class="article-cta">
                            <a href="{{ route('client.registerForm','Mass') }}" class="btn btn-block btn-primary">Proceed</a>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <article class="article">
                    <div class="article-header">
                        <div class="article-image" data-background="{{ asset('asset/img/5.jpg') }}">
                        </div>
                        <div class="article-title">
                            <h2><a href="#">Confirmation</a></h2>
                        </div>
                    </div>
                    <div class="article-details">
                        <p>Is the completion of Baptism. Baptism marked the start if your relationships with christ. Your soul changed permanently and you were filled with grace from God. </p>
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