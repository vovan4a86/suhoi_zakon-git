@extends('template')
@section('content')
    <main>
        <!--section.hero-->
        <section class="hero">
            <div class="hero__view">
                <picture>
                    <img class="hero__img"
                         src="{{ $category->image ? $category->image_src : '/static/images/common/hero.jpeg' }}"
                         alt="contacts"/>
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
                        <button class="btn btn--outlined btn-reset" type="button" data-popup="data-popup"
                                data-src="#callback" aria-label="Обратный звонок">
                            <span>Обратный звонок</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
        @if(count($category->features))
            <section class="s-feat">
                <div class="s-feat__container container">
                    <div class="s-feat__grid">
                        @foreach($category->features as $feat)
                            <div class="s-feat__item">
                                <div class="s-feat__icon lazy" data-bg="{{ $feat->thumb(2) }}"></div>
                                <div class="s-feat__label">{{ $feat->text }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        @if($text)
            <section class="s-points">
                <div class="s-points__container container">
                    <div class="s-points__body text-block">
                        @if($h1)
                            <h1>{{ $h1 }}</h1>
                        @endif
                        {!! $text !!}
                    </div>
                </div>
            </section>
        @endif
    <!--section.s-catalog-->
        @if(count($products))
            <section class="s-catalog">
                <div class="s-catalog__container container">
                    @if($category->h2)
                        <h2 class="page-title">{{ $category->h2 }}</h2>
                    @endif
                    <div class="s-catalog__grid">
                        @foreach($products as $product)
                            <div class="card">
                                <a href="{{ $product->url }}" class="card__view" title="{{ $product->name }}">
                                    <picture>
                                        <img class="card__img no-select"
                                             src="{{ $product->image ? $product->thumb(2) : $product->catalog->thumb(2) }}"
                                             width="240" height="240" alt="{{ $product->name }}" loading="lazy"/>
                                    </picture>
                                </a>
                                <h3 class="card__title">

                                    <a href="{{ $product->url }}">{{ $product->name }}</a>
                                </h3>
                                <div class="card__text">{{ $product->comment }}</div>
                                <div class="card__actions">
                                    @if($product->price)
                                        <div class="card__col">
                                            <button class="btn btn--filled btn--accent btn-reset" type="button"
                                                    data-cart="{{ $product->id }}" {{ Cart::ifInCart($product->id) ? 'disabled' : null }}>
                                                <span>{{ Cart::ifInCart($product->id) ? 'В корзине' : 'В корзину' }}</span>
                                            </button>
                                        </div>
                                        <div class="card__col">
                                            <div class="card__price">от {{ $product->price }} ₽</div>
                                            <div class="card__count">Цена за {{ $product->measure ?: 'шт' }}</div>
                                        </div>
                                    @else
                                        <div class="card__col">
                                            <a class="btn btn--black btn--accent" href="#contacts-extensible"
                                               title="Заказать расчет">
                                                <span>Заказать расчет</span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if(count($gallery) && !$category->gallery_template)
            <section class="templates">
                <div class="c-gallery__container container">
                    <div class="c-gallery__body text-block">
                        <h2>Галерея</h2>
                        {!! $category->gallery_text  !!}
                    </div>
                    <div class="c-gallery__gallery" data-masonry-gallery="data-masonry-gallery">
                        @foreach($gallery as $item)
                            <a class="c-gallery__link" href="{{ $item->image_src }}" data-fancybox="gallery">
                                <img class="c-gallery__img" src="{{ $item->image_src }}" alt="gallery-item"
                                     loading="lazy"/>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if(count($gallery) && $category->gallery_template)
            <section class="templates">
                <div class="templates__container container">
                    <div class="templates__body text-block">
                        <h2>Галерея</h2>
                        {!! $category->gallery_text  !!}
                    </div>
                    <div class="templates__gallery">
                        @foreach($gallery as $item)
                            <figure class="templates__item">
                                <span class="templates__wrapper">
                                    <img class="templates__img no-select" src="{{ $item->thumb(3) }}"
                                         width="240" height="240" loading="lazy" alt="template-image"/>
                                </span>
                                <figcaption class="templates__caption">{{ $item->text }}</figcaption>
                            </figure>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if($text_after)
            <section class="s-points templates is-white">
                <div class="s-points__container container">
                    <div class="s-points__body text-block">
                        {!! $text_after !!}
                    </div>
                </div>
            </section>
        @endif
    </main>

    @include('blocks.points')
    @include('blocks.contacts')
    @include('blocks.request')

@endsection
