<section class="s-points">
    <div class="s-points__container container">
        <h2 class="page-title">{{ Settings::get('block_free_title') }}</h2>
        @if($items = Settings::get('block_free_list'))
            <div class="s-points__row">
                @foreach($items as $item)
                    <div class="b-point">
                        <div class="b-point__order">{{ $loop->iteration > 9 ? $loop->iteration : '0' . $loop->iteration }}.
                        </div>
                        <h3 class="b-point__title">{{ $item['title'] }}</h3>
                        <div class="b-point__text">
                            <p>{{ $item['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        @if($icons = Settings::get('block_free_icons'))
            <div class="s-points__features">
                @foreach($icons as $icon)
                    <div class="point-card">
                        <h3 class="point-card__title">{{ $icon['title'] }}</h3>
                        @if($img = $icon['img'])
                            <div class="point-card__icon lazy" data-bg="{{ Settings::fileSrc($img) }}"></div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
