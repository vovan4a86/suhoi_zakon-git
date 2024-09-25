<!--section.s-features-->
@if($list = Settings::get('main_features_list'))
    <section class="s-features">
        <div class="s-features__container container">
            <h2 class="page-title">{{ Settings::get('main_features_title') }}</h2>
            <div class="s-features__grid">
                <div class="s-features__body">
                    @foreach($list as $item)
                        <div class="b-feature">
                            <div class="b-feature__icon lazy"
                                 data-bg="/static/images/common/ico_success.png"></div>
                            <div class="b-feature__body">
                                <h3 class="b-feature__title">{{ $item['title'] }}</h3>
                                <div class="b-feature__text">
                                    <p>{!! $item['text']  !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($img = Settings::get('main_features_img'))
                    <div class="s-features__view">
                        <img class="s-features__pic no-select" src="{{ Settings::fileSrc($img) }}" width="686"
                             height="548" alt="feature image" loading="lazy"/>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif
