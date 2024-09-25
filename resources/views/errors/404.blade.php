@extends('template')
@section('content')
    <main>
        <!--section.hero-->
        <section class="hero">
            <div class="hero__view">
                <picture>
                    <img class="hero__img" src="/static/images/common/hero-2.jpeg" alt="page-not-found-image" />
                </picture>
            </div>
            <div class="hero__container container">
                <div class="hero__body">
                    <h2 class="page-title">404</h2>
                    <div class="hero__subtitle">Страница не найдена</div>
                    <div class="hero__actions">
                        <a class="btn btn--filled btn--accent" href="{{ route('main') }}" title="Перейти на главную">
                            <span>Перейти на главную</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('blocks.points')
    @include('blocks.contacts')
    @include('blocks.request')
@stop
