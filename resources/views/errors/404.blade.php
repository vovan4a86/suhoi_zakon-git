@extends('template')
@section('content')
    <main>
        <section class="hero">
            <div class="hero__container container">
                <div class="hero__body">
                    <h2 class="page-title">404</h2>
                    <div class="hero__subtitle">Страница не найдена</div>
                    <div class="hero__actions">
                        <a class="btn btn--filled btn--accent" href="{{ route('main') }}"
                           title="Перейти на главную">
                            <span>Перейти на главную</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@stop
