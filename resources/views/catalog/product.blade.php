@extends('template')
@section('content')
    <main>
        <!--section.hero-->
        <section class="hero">
            <div class="hero__view">
                <picture>
                    <source media="(max-width: 820px)" srcset="/static/images/common/hero--820.webp" type="image/webp" />
                    <source media="(max-width: 820px)" srcset="/static/images/common/hero--820.jpeg" />
                    <source srcset="/static/images/common/hero.webp" type="image/webp" />
                    <img class="hero__img" src="/static/images/common/hero.jpeg" alt="hero image" />
                </picture>
            </div>
            <div class="hero__container container_container container">
                <div class="hero__body">
                    <div class="page-title">СДВ-СТРОЙ</div>
                    <div class="hero__subtitle">{{ $h1 }}</div>
{{--                    <div class="hero__text">--}}
{{--                        <p>Быстрое и качественное производство доборных элементов для фасада и кровли, в&nbsp;том числе, по&nbsp;Вашим чертежам.</p>--}}
{{--                    </div>--}}
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
        <!--section.s-cont-->
        <section class="s-cont bg-grey">
            <div class="s-cont__container container">
                <h1 class="page-title">{{ $h1 }}</h1>
                <div class="s-cont__top">
                    <div class="s-cont__view">
                        <img class="s-cont__pic" src="{{ $product->getImage() }}"
                             width="432" height="432" alt="" loading="lazy">
                    </div>
                    <div class="s-cont__body">
                        <div class="s-cont__body-content">
                            <div class="s-cont__text">
                                {!! $announce !!}
                            </div>
                            @if($product->price)
                                <div class="s-cont__title">{{ $product->price }} ₽/{{ $product->measure ?: 'шт' }}.</div>
                                <button class="btn btn--filled btn--accent btn-reset" type="button"
                                        data-cart="{{ $product->id }}" {{ Cart::ifInCart($product->id) ? 'disabled' : null }}
                                        aria-label="Добавить в корзину">
                                    <span>{{ Cart::ifInCart($product->id) ? 'В корзине' : 'Добавить в корзину' }}</span>
                                </button>
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
                </div>
            </div>
        </section>
        <!--section.s-content-->
        <section class="s-content">
            <div class="s-content__container container">
                <div class="s-content__body text-block">
                    {!! $text !!}
                    <a class="btn btn--filled btn--accent" href="{{ url()->previous() }}" title="Вернуться назад">
                        <span>Вернуться назад</span>
                    </a>
                </div>
            </div>
        </section>
    </main>

    @include('blocks.points')
    @include('blocks.contacts')
    @include('blocks.request')

@endsection
