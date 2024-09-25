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
        @if($text)
            <section class="s-points bg-white">
                <div class="s-points__container container">
                    <div class="s-points__body text-block">
                        {!! $text !!}
                    </div>
                </div>
            </section>
        @endif
    <!--section.s-catalog-->
        @if(count($children))
            @foreach($children as $child)
                <section class="s-points bg-white">
                    @if($child->text)
                        <div class="s-points__container container bg-white">
                            <div class="s-points__body text-block">
                                {!! $child->text !!}
                            </div>
                        </div>
                    @endif

                    @if(count($child->images) && !$category->gallery_template)
                        <section class="c-gallery">
                            <div class="c-gallery__container container">
                                <div class="c-gallery__body text-block">
                                    <h2>Галерея</h2>
                                    {!! $child->gallery_text  !!}
                                </div>
                                <div class="c-gallery__gallery" data-masonry-gallery="data-masonry-gallery">
                                    @foreach($child->images as $item)
                                        <a class="c-gallery__link" href="{{ $item->image_src }}"
                                           data-fancybox="gallery">
                                            <img class="c-gallery__img" src="{{ $item->image_src }}" alt="gallery-item"
                                                 loading="lazy"/>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    @endif

                    @if($child->text_after)
                        <div class="s-points__container container bg-white">
                            <div class="s-points__body text-block">
                                {!! $child->text_after !!}
                            </div>
                        </div>
                        {{--                    </section>--}}
                    @endif
                </section>
            @endforeach
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
