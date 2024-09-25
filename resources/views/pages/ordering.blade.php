@extends('template')
@section('content')
    <main>
        <!--section.hero-->
        <section class="hero">
            <div class="hero__view">
                <picture>
                    <img class="hero__img"
                         src="{{ $page->image ? $page->image_src : '/static/images/common/hero.jpeg' }}"
                         alt="contacts"/>
                </picture>
            </div>
            <div class="hero__container container">
                <div class="hero__body">
                    <h2 class="page-title">СДВ-СТРОЙ</h2>
                    <div class="hero__subtitle">{{ $h1 }}</div>
                    <div class="hero__actions">
                        <a class="btn btn--filled btn--accent" href="#contacts-extensible" title="Оставить заявку">
                            <span>Оставить заявку</span>
                        </a>
                        <button class="btn btn--outlined btn-reset" type="button" data-popup="data-popup"
                                data-src="#callback" aria-label="Обратный звонок">
                            <span>Обратный звонок</span>
                        </button>
                    </div>
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

        @include('blocks.features')

        <section class="s-content">
            <div class="s-content__container container">
                <div class="s-content__body text-block">
                    {!! $text_after !!}
                </div>
            </div>
        </section>
    </main>

    @include('blocks.points')
    @include('blocks.contacts')
    @include('blocks.request')
@stop
