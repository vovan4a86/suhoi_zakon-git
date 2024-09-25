@extends('template')
@section('content')
    <main>
        <!--section.hero-->
        <section class="hero">
            <div class="hero__view">
                <picture>
                    <img class="hero__img"
                         src="{{ $page->image ? $page->image_src : '/static/images/common/hero-2.jpeg' }}"
                         alt="policy"/>
                </picture>
            </div>
            <div class="hero__container container">
                <div class="hero__body">
                    <h2 class="page-title">СДВ-СТРОЙ</h2>
                    <div class="hero__subtitle">{{ $h1 }}</div>
                </div>
            </div>
        </section>
        <section class="s-content">
            <div class="s-content__container container">
                <div class="s-content__body text-block">
                    {!! $text !!}
                </div>
            </div>
        </section>
    </main>
@stop
