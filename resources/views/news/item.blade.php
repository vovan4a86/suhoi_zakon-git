@extends('template')
@section('content')
    <main class="site-section">
        <div class="container">
            <div class="block-heading-1">
                <span class="d-block mb-3 text-blacK" data-aos="fade-up">Апрель 20, 2024
{{--                  <span>&bullet;</span> от Михаила Бакина--}}
                </span>
                <h1 style="line-height:45px;">
                    <p class="mb-7">
                        {{ $h1 }}
                    </p>
                </h1>
            </div>

            <div class="row">
                <div class="col-md-8 blog-content">
                    {{--                    <!-- EMBEDDED VIDEO -->--}}
                    {{--                    <iframe width="718" height="415" src="https://www.youtube.com/embed/_vM3eOcXTAw?si=St4bSl0vuGS708mw"--}}
                    {{--                            title="YouTube video player" frameborder="0"--}}
                    {{--                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"--}}
                    {{--                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>--}}
                </div>
                <div class="col-md-4 sidebar">
                    @if($announce)
                        <div class="sidebar-box">
                            <p class="lead">{{ $announce }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 blog-content">
                    {!! $text !!}
                </div>
                @if(count($images))
                    <div class="col-md-4 sidebar">
                        @foreach($images as $image)
                            <div class="sidebar-box">
                                <img src="{{ $image->thumb(2) }}" alt="{{ $image->name }}" class="img-fluid">
                                <br>
                                <p>{{ $image->name }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>
@stop
