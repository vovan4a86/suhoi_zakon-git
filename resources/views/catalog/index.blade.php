@extends('template')
@section('content')
    <main>
        <!--section.hero-->
        <section class="hero">
            <div class="hero__view">
                <picture>
                    <img class="hero__img" src="/static/images/common/hero.jpeg" alt="catalog-image" />
                </picture>
            </div>
            <div class="hero__container container">
                <div class="hero__body">
                    <div class="page-title">СДВ-СТРОЙ</div>
                    <div class="hero__subtitle">{{ $h1 }}</div>
                    <div class="hero__actions">
                        <a class="btn btn--filled btn--accent" href="#contacts-extensible" title="Оставить заявку">
                            <span>Оставить заявку</span>
                        </a>
                        <button class="btn btn--outlined btn-reset" type="button" data-popup="data-popup" data-src="#callback" aria-label="Обратный звонок">
                            <span>Обратный звонок</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <!--section.s-catalog-->
        <section class="s-catalog">
            <div class="s-catalog__container container">
                <h1 class="page-title">Каталог СДВ-СТРОЙ</h1>
                @if(count($categories))
                    <div class="s-catalog__grid">
                        @foreach($categories as $category)
                            <div class="card">
                            <a class="card__view" href="{{ $category->url }}" title="{{ $category->name }}">
                                <picture>
                                    <img class="card__img no-select" src="{{ $category->thumb(2) }}" width="240" height="240"
                                         alt="{{ $category->name }}" loading="lazy" />
                                </picture>
                            </a>
                            <h3 class="card__title">
                                <a href="{{ $category->url }}">{{ $category->name }}</a>
                            </h3>
                            <div class="card__actions">
                                <div class="card__col">
                                    @if(!$category->request_only)
                                        <a href="{{ $category->url }}" class="btn btn--black btn--accent" type="button">
                                            <span>Подробнее</span>
                                        </a>
                                    @else
                                        <a class="btn btn--outlined btn--black btn--dust" href="#contacts-extensible" title="Оставить заявку">
                                            <span>Оставить заявку</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    </main>

    @include('blocks.points')
    @include('blocks.contacts')
    @include('blocks.request')

@endsection
