@extends('template')
@section('content')
    <main>
        <!--section.hero-->
        <section class="hero">
            <div class="hero__view">
                <picture>
                    <img class="hero__img"
                         src="{{ $page->image ? $page->image_src : '/static/images/common/hero-2.jpeg' }}"
                         alt="about hero image"/>
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

                    @if(count($gallery))
                        <div class="s-content__gallery">
                            <div class="b-gallery">
                                <h4 class="b-gallery__title">Благодарственные письма</h4>
                                <div class="b-gallery__grid">
                                    @foreach($gallery as $item)
                                        <a class="b-gallery__item" href="{{ $item->src }}"
                                           data-fancybox="gallery" title="{{ isset($item['data']) ? $item['data']['text'] : ''  }}">
                                            <img class="b-gallery__img"
                                                 src="{{ $item->thumb(2) }}"
                                                 alt="{{ isset($item['data']) ? $item['data']['text'] : ''  }}" loading="lazy"
                                            />
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>

    @include('blocks.contacts')
    @include('blocks.request')
@stop
