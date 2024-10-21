@extends('template')
@section('content')
    <main class="site-wrap" id="home-section">
        <!-- АРХИВ НОМЕРОВ -->
        <div class="site-section bg-light" id="pricing-section">
            <div class="container">
                <!-- <div class="row mb-5 justify-content-center text-center"> -->
                <div class="row mb-5 justify-content-center text-center">
                    <div class="col-md-10">
                        <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
                            <h2>{{ $h1 }}</h2>
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
                        @foreach($years_chunks as $chunk)
                            <div class="row mb-4">
                                @foreach($chunk as $item)
                                    <div class="mb-lg-0 col-lg-4 col-md-4 col-md-6 col-xl-3" data-aos="fade-up"
                                         data-aos-delay="">
                                        <div class="pricing">
                                            <div>
                                                <h3 class="text-center text-black">сухой закон</h3>
                                            </div>
                                            <hr color="#696969" style="height: 0px;">
                                            <div class="price text-center accordion"
                                                 style="margin-top:0px; height: 75px;">
                                                    <span><span><font size="7">{{ $item->year }}</font></span>
                                                    </span>
                                            </div>
                                            @if(count($item->public_magazines))
                                                <ul>
                                                    @foreach($item->public_magazines()->limit(6)->get() as $m)

                                                    @endforeach
                                                    <li><a href="{{ $m->url }}" style="height: 5px;">N{{ $m->number_year }}&nbsp; ({{ $item->year }} г.)</a>
                                                    </li>
                                                </ul>
                                            @endif
                                            <br>
                                            <p class="text-center">
                                                <a href="{{ $item->url }}" class="btn btn-secondary btn-md">Все
                                                    номера</a>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop
