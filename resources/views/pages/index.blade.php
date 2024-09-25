@extends('template')
@section('content')
    <main>
        <!--section.hero-->
        <section class="hero">
            <div class="hero__view">
                <picture>
                    <img class="hero__img"
                         src="{{ $page->image ? $page->image_src : '/static/images/common/hero.jpeg' }}"
                         alt="main-hero"/>
                </picture>
            </div>
            <div class="hero__container container">
                <div class="hero__body">
                    <h2 class="page-title">{{ Settings::get('main_header') }}</h2>
                    @if($subs = Settings::get('main_subs'))
                        <div class="hero__text">
                            @foreach($subs as $sub)
                                <p>{{ $sub }}</p>
                            @endforeach
                        </div>
                    @endif
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
        <!--section.s-feat-->
        @if($feats = Settings::get('main_feat_icons'))
            <section class="s-feat">
                <div class="s-feat__container container">
                    <div class="s-feat__grid">
                        @foreach($feats as $feat)
                            <div class="s-feat__item">
                                @if($img = $feat['icon'])
                                    <div class="s-feat__icon lazy" data-bg="{{ Settings::fileSrc($img) }}"></div>
                                @endif
                                <div class="s-feat__label">{{ $feat['text'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    <!--section.s-srv-->
        <section class="s-srv">
            <div class="s-srv__container container">
                <div class="s-srv__heading">
                    <h2 class="page-title">{{ Settings::get('main_main_title') }}</h2>
                    <div class="s-srv__text">
                        {!! Settings::get('main_main_text') !!}
                    </div>
                </div>
                @if(count($services))
                    <div class="s-srv__body">
                        <div class="cat-view">
                            @foreach($services as $chunk)
                                <div class="cat-view__grid">
                                    @if(isset($chunk[0]))
                                        <div class="cat-view__col">
                                            <div class="cat-view__item cat-view__item--wide">
                                                <a class="cat-view__view"
                                                   href="{{ $chunk[0]['url'] ?: 'javascript:void(0)' }}"
                                                   title="{{ $chunk[0]['title'] }}">
                                                    @if($img = $chunk[0]['img'])
                                                        <img class="cat-view__pic"
                                                             src="{{ Settings::fileSrc($img) }}"
                                                             width="504"
                                                             height="504" alt="{{ $chunk[0]['title'] }}"
                                                             loading="lazy"/>
                                                    @endif
                                                </a>
                                                <div class="cat-view__body">
                                                    <h3 class="cat-view__title">
                                                        <a href="{{ $chunk[0]['url'] ?: 'javascript:void(0)' }}">{{ $chunk[0]['title'] }}</a>
                                                    </h3>
                                                    <div class="cat-view__text">
                                                        <p>{{ $chunk[0]['text'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($chunk[1]))
                                        <div class="cat-view__col">
                                            <div class="cat-view__item">
                                                <a class="cat-view__view"
                                                   href="{{ $chunk[1]['url'] ?: 'javascript:void(0)' }}"
                                                   title="{{ $chunk[1]['title'] }}">
                                                    @if($img = $chunk[1]['img'])
                                                        <img class="cat-view__pic"
                                                             src="{{ Settings::fileSrc($img) }}"
                                                             width="504"
                                                             height="504" alt="{{ $chunk[1]['title'] }}"
                                                             loading="lazy"/>
                                                    @endif
                                                </a>
                                                <div class="cat-view__body">
                                                    <h3 class="cat-view__title">
                                                        <a href="{{ $chunk[1]['url'] ?: 'javascript:void(0)' }}">{{ $chunk[1]['title'] }}</a>
                                                    </h3>
                                                    <div class="cat-view__text">
                                                        <p>{{ $chunk[1]['text'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($chunk[2]))
                                                <div class="cat-view__item">
                                                    <a class="cat-view__view"
                                                       href="{{ $chunk[2]['url'] ?: 'javascript:void(0)' }}"
                                                       title="{{ $chunk[2]['title'] }}">
                                                        @if($img = $chunk[2]['img'])
                                                            <img class="cat-view__pic"
                                                                 src="{{ Settings::fileSrc($img) }}"
                                                                 width="504"
                                                                 height="504" alt="{{ $chunk[2]['title'] }}"
                                                                 loading="lazy"/>
                                                        @endif
                                                    </a>
                                                    <div class="cat-view__body">
                                                        <h3 class="cat-view__title">
                                                            <a href="{{ $chunk[2]['url'] ?: 'javascript:void(0)' }}">{{ $chunk[2]['title'] }}</a>
                                                        </h3>
                                                        <div class="cat-view__text">
                                                            <p>{{ $chunk[2]['text'] }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </section>
        <!--section.b-text-->
        @if(($title = Settings::get('main_delivery_title')) && ($text = Settings::get('main_delivery_text')))
            <section class="b-text">
                <div class="b-text__container container">
                    <h2 class="page-title page-title--small">{{ $title }}</h2>
                    <div class="page-text">
                        <p>{{ $text }}</p>
                    </div>
                </div>
            </section>
        @endif
    <!--section.b-actions-->
        <section class="b-actions">
            <div class="b-actions__container container">
                <div class="b-actions__row">
                    <a class="btn btn--white" href="{{ route('catalog.index') }}" title="Перейти в каталог">
                        <span>Перейти в каталог</span>
                    </a>
                    <a class="btn btn--outlined btn--dust" href="#contacts-extensible" title="Контакты">
                        <span>Контакты</span>
                    </a>
                </div>
            </div>
        </section>
        @include('blocks.features')
    </main>

    @include('blocks.points')
    @include('blocks.contacts')
    @include('blocks.request')
@stop
