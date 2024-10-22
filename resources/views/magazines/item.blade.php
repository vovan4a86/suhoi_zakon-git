@extends('template')
@section('content')
    <main class="site-section">
        <div class="container">

            <!-- СЛАЙДЕР -->
            <div class="slider">
                <section style="border:2px solid #808080; border-radius:5px; width: 100%; text-align:center; padding:20px;">
                    <h2>N{{ $item->number_year }} ({{ $item->number_total }}) / {{ $item->archive->year }}</h2>
                    @if($item->file)
                        <div class="_df_book" webgl="true" source="{{ $item->file_src }}" id="df_manual_book"
                             style="height: 800px"></div>
                    @endif
                </section>
            </div>
        </div>
        <br>
        @if(count($more_magazines))
            <div class="container">
                <div class="px-md-3">
                    <p>
                        @foreach($more_magazines as $item)
                            <a href="{{ $item->url }}" class="text-primary">{{ $item->number_year }} > &nbsp;&nbsp;</a>
                        @endforeach
                    </p>
                </div>
            </div>
        @endif
        <div class="container">
            <div class="row mb-5 justify-content-center text-center">
                <div class="col-md-12">
                    <div class="block-heading-1" data-aos="fade-up" data-aos-delay="">
                        <br><br>
                        <h2>архив номеров</h2>
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
            </div>
        </div>
    </main>
@stop
