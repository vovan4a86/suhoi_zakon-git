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
                </div>
            </div>
        </section>
        <!--section.s-cont-->
        <section class="s-cont">
            <div class="s-cont__container container">
                <div class="s-cont__top">
                    @if($img = Settings::get('contacts_img'))
                        <div class="s-cont__view">
                            <img class="s-cont__pic" src="{{ Settings::fileSrc($img) }}" width="432" height="432" alt=""
                                 loading="lazy"/>
                        </div>
                    @endif
                    <div class="s-cont__body">
                        <h2 class="page-title">{{ Settings::get('contacts_title') }}</h2>
                        <div class="s-cont__body-content">
                            <h3 class="s-cont__title">{{ Settings::get('contacts_subtitle') }}</h3>
                            <div class="s-cont__text">
                                <p>{{ Settings::get('contacts_text') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--section.s-legal-->
        <section class="s-legal">
            <div class="s-legal__container container">
                <h2 class="page-title">{{ Settings::get('contacts_ur_title') }}</h2>
                <div class="s-legal__text">
                    <p>{{ Settings::get('contacts_ur_subtitle') }}</p>
                </div>
                @if($info = Settings::get('contacts_ur_info'))
                    <div class="s-legal__grid">
                        @if($info['address'])
                            <div class="s-legal__col">
                                <dl class="datalist">
                                    <dt>Адрес</dt>
                                    <dd>{{ $info['address'] }}</dd>
                                </dl>
                            </div>
                        @endif
                        @if($info['inn'])
                            <div class="s-legal__col">
                                <dl class="datalist">
                                    <dt>ИНН</dt>
                                    <dd>{{ $info['inn'] }}</dd>
                                </dl>
                            </div>
                        @endif
                        @if($info['ogrn'])
                            <div class="s-legal__col">
                                <dl class="datalist">
                                    <dt>ОГРН</dt>
                                    <dd>{{ $info['ogrn'] }}</dd>
                                </dl>
                            </div>
                        @endif
                        @if($info['kpp'])
                            <div class="s-legal__col">
                                <dl class="datalist">
                                    <dt>КПП</dt>
                                    <dd>{{ $info['kpp'] }}</dd>
                                </dl>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </section>
    </main>

    @include('blocks.contacts')
    @include('blocks.request')
@stop
