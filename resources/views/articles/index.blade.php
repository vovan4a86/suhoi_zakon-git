@extends('template')
@section('content')
    <main class="site-wrap" id="home-section">
        <div class="site-section py-5" id="blog-section">
            <div class="container">
                <div class="row justify-content-center text-center mb-5">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="block-heading-1" data-aos="fade-right" data-aos-delay="">
                            <h2>{{ $h1 }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($items as $article)
                        @include('pages.index.article_item')
                    @endforeach
                </div>
            </div>
        </div>

        @if(count($items))
            <nav class="mb-5" aria-label="Page navigation">
                @include('paginations.with_pages', ['paginator' => $items])
            </nav>
        @endif

        @include('pages.index.contacts')
    </main>
@stop
