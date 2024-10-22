@extends('template')
@section('content')
    <main class="site-section bg-light" id="pricing-section">
        <div class="container">
            <div class="row mb-5 justify-content-center text-center">
                <div class="col-md-10">
                    <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
                        <h2>{{ $h1 }}/{{ $item->year }}</h2>
                        <p>
                            @foreach($years as $year)
                                @if(!$loop->last)
                                    <a href="{{ $year->url }}">{{ $year->year }}</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                @else
                                    <a href="{{ $year->url }}">{{ $year->year }}</a>
                                @endif
                            @endforeach
                        </p>
                    </div>
                </div>
                <div class="site-section bg-light">
                    @foreach($magazines_chunks as $chunk)
                        <div class="row mb-4">
                            @foreach($chunk as $item)
                                @include('archive.magazine_item')
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@stop
