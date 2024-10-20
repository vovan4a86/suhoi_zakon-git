@extends('template')
@section('content')
    <main class="site-section">
        <div class="container">
            <div class="block-heading-1">
                <h1 style="line-height:45px;">
                    <p class="mb-7">
                        {{ $h1 }}
                    </p>
                </h1>
            </div>

            <div class="row">
                <div class="col-md-8 blog-content">
                    {!! $text !!}
                </div>
            </div>
        </div>
    </main>
@stop
