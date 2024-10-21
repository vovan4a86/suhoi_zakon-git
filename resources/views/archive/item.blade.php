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
                            @foreach($chunk as $magazine)
                                <div class="mb-lg-0 col-lg-4 col-md-4 col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="">
                                    <div class="pricing">
                                        <div>
                                            <a href="{{ $magazine->url }}">
                                                <img src="{{ $magazine->thumb(2) }}" alt="Номер {{ $magazine->number_year }}" width="225" height="270">
                                            </a>
                                        </div>
                                        <br>

                                        <div class="price text-center accordion">
                                            <span><span>N{{ $magazine->number_year }} ({{ $magazine->number_total }})</span> / {{ $item->year }}</span>
                                        </div>
                                        <ul class="list-unstyled ul-check success mb-5">

                                            <li>Пенетрон на <br>
                                                знаковых объектах
                                            </li>
                                            <li>Гидрозащита коммуникаций</li>
                                            <li>Строительный сезон <br>
                                                без остановки
                                            </li>

                                        </ul>
                                        <p class="text-center">
                                            <a href="{{ $magazine->url }}" class="btn btn-secondary btn-md">Читать сейчас</a>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@stop
