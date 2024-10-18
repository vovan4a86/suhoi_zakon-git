@extends('template')
@section('content')
    <main class="site-wrap" id="home-section">
        @if($titles = S::get('main_titles'))
            <div class="site-section-cover overlay inner-page bg-light"
                 style="background-image: url({{ $titles['img'] ? S::fileSrc($titles['img']) : 'images/Landing-Page-picture.jpg' }})"
                 data-aos="fade" line-height="50px">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <h1 style="line-height:50px;">
                                <p class="mb-7">
                                    {{ $titles['title'] }}
                                </p>
                            </h1>
                            <p class="mb-5">{{ $titles['subtitle'] }}</p>
                            <div class="form-group d-flex col-md-4">
                                <a class="btn btn-primary text-white px-4" href="single_slider.html">Свежий номер</a>
                            </div>
                            <div class="form-group d-flex col-md-4">
                                <a class="btn btn-primary text-white px-4" href="single_archive.html">Архив номеров</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endif
        <br>
        <br>
        @include('pages.index.news')

        @include('pages.index.archive')

        @include('pages.index.about')

        @include('pages.index.redaction')

        @include('pages.index.reviews')

        @include('pages.index.articles')

        @include('pages.index.contacts')
    </main>
@stop
