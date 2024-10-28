@extends('template')
@section('content')
    <main class="site-section">
        <div class="container">
            <div class="block-heading-1">
                <span class="d-block mb-3 text-blacK" data-aos="fade-up">{{ $date }}
                    {{--                  <span>&bullet;</span> от Михаила Бакина--}}
                </span>
                <h1 style="line-height:45px;">
                    <p class="mb-7">
                        {{ $h1 }}
                    </p>
                </h1>
            </div>

            <div class="row">
                <div class="col-md-{{ count($images) ? '8' : '12' }} blog-content">
                    @if($announce)
                        <p class="lead">{{ $announce }}</p>
                    @endif
                    {!! $text !!}
                </div>

                @if(count($images))
                    <div class="col-md-4 sidebar">
                        @foreach($images as $image)
                            <div class="sidebar-box">
                                <img src="{{ $image->thumb(2) }}" alt="{{ $image->name }}" class="img-fluid">
                                <br>
                                <p>{{ $image->text }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>
@stop
