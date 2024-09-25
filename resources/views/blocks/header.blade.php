<header class="header">
    <div class="header__container container">
        <div class="header__brand">
            @if(Route::is('main'))
                <img class="logo" src="/static/images/common/logo.png" width="157" height="64" alt="СДВ-СТРОЙ">
            @else
                <a href="{{ route('main') }}">
                    <img class="logo" src="/static/images/common/logo.png" width="157" height="64" alt="СДВ-СТРОЙ">
                </a>
            @endif
        </div>
        <div class="header__data">
            @if(count($header_menu))
                <div class="header__nav">
                    <nav class="nav" itemscope itemtype="https://schema.org/SiteNavigationElement" aria-label="Меню">
                        <ul class="nav__list list-reset" itemprop="about" itemscope itemtype="https://schema.org/ItemList">
                            @foreach($header_menu as $item)
                                <li class="nav__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ItemList">
                                    <a class="nav__link" href="{{ $item->url }}" title="{{ $item->name }}"
                                       itemprop="url" {{ $item->alias === 'catalog' ? 'data-catalog-link' : null }}>{{ $item->name }}</a>
                                    <meta itemprop="name" content="{{ $item->name }}">
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
            @endif
            <div class="header__actions">
                <div class="header__action">
                    <a class="btn btn--accent btn--outlined" href="#contacts-extensible" title="Сделать заказ">
                        <span>Сделать заказ</span>
                    </a>
                </div>
                <div class="header__burger">
                    <button class="hamburger hamburger--spin" type="button" data-burger aria-label="Открыть меню">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
