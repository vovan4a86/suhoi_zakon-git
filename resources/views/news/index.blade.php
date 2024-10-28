@extends('template')
@section('content')
    <main class="site-wrap" id="home-section">
        <br>
        <br>
        <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">
                <div class="block-heading-1">
                    <h2><a id="anchor">{{ $h1 }}</a></h2>
                    @if($sub = S::get('news_subtitle'))
                        <p>{{ $sub }}</p>
                    @endif
                </div>
            </div>
        </div>

        @if(count($items))
            <div class="ftco-service-image-1 pb-5">
                <div class="container">
                    <div class="owl-carousel owl-all">
                        @foreach($items as $item)
                            <div class="service text-center">
                                <a href="{{ $item->url }}">
                                    @if($item->image)
                                        <img src="{{ $item->thumb(2) }}" alt="{{ $item->name }}" class="img-fluid">
                                    @endif
                                </a>
                                <div class="px-md-3">
                                    <h3><a href="{{ $item->url }}">{{ $item->name }}</a></h3>
                                    <p>{{ $item->getAnnounce() }}</p>
                                    <p><a href="{{ $item->url }}" class="text-primary">Читать дальше >>> </a></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if(count($items))
            <nav class="mb-5" aria-label="Page navigation">
                @include('paginations.with_pages', ['paginator' => $items])
            </nav>
        @endif

        @include('pages.index.contacts')
    </main>
@stop
