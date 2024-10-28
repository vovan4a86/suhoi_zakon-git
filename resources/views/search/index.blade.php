@extends('template')
@section('content')
    <main class="site-wrap" id="home-section">
        <div class="site-section pt-5 pb-2" id="blog-section">
            <div class="container">
                <div class="row justify-content-center text-center mb-5">
                    <div class="mb-5 mb-lg-0">
                        <div class="block-heading-1" data-aos="fade-right" data-aos-delay="">
                            <h2>Результат поиска «{{ $q }}»</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if(count($items))
                        @foreach($items as $item)
                            <div class="col-lg-6">
                                <div class="mb-2 d-flex blog-entry" data-aos="fade-right" data-aos-delay="">
                                    <div class="blog-excerpt">
                                        <h2 class="h4  mb-3">
                                            <a href="{{ $item->url }}">{{ $item->name }}</a>
                                        </h2>

                                        <p>{!! $item->getAnnounce($q)  !!}</p>

                                        <p><a href="{{ $item->url }}" class="text-primary">Читать больше</a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div>По вашему запросу ничего не найдено.</div>
                    @endif
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
