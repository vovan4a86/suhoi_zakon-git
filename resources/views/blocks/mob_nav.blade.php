<div class="mob-nav" data-burger-menu="data-burger-menu">
    <div class="mob-nav__body">
        <div class="mob-nav__close">
            <button class="hamburger hamburger--spin is-active" type="button" data-close="data-close" aria-label="Закрыть меню">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
            </button>
        </div>
        <div class="mob-nav__brand">
            @if(Route::is('main'))
                <img class="logo" src="/static/images/common/logo.png" width="157" height="64" alt="СДВ-СТРОЙ" />
            @else
                <a href="{{ route('main') }}">
                    <img class="logo" src="/static/images/common/logo.png" width="157" height="64" alt="СДВ-СТРОЙ" />
                </a>
            @endif
        </div>
        @if(count($mobile_menu))
            <nav class="mob-nav__nav">
                <ul class="mob-nav__list list-reset">
                    <li class="mob-nav__item">
                        <a class="mob-nav__link" href="{{ route('main') }}" title="Главная">Главная</a>
                    </li>
                    @foreach($mobile_menu as $item)
                        <li class="mob-nav__item">
                            <a class="mob-nav__link" href="{{ $item->url }}" title="{{ $item->name }}">{{ $item->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        @endif
        <div class="mob-nav__action">
            <a class="btn btn--outlined btn--white" href="#contacts-extensible" data-close="data-close" title="Сделать заказ">
                <span>Сделать заказ</span>
            </a>
        </div>
    </div>
</div>
