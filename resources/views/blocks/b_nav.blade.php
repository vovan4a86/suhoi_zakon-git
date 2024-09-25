@if(isset($catalog_menu) && count($catalog_menu))
    <div class="b-nav" data-catalog-nav="data-catalog-nav">
    <div class="b-nav__container container">
        <button class="b-nav__close btn-reset" type="button" data-catalog-close="data-catalog-close" aria-label="Закрыть меню">
            <span class="b-nav__close-icon iconify" data-icon="solar:close-square-bold-duotone" data-width="40"></span>
        </button>
        <nav class="b-nav__nav" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement" aria-label="Каталог">
            <ul class="b-nav__list list-reset" itemprop="about" itemscope="itemscope" itemtype="https://schema.org/ItemList">
                @foreach($catalog_menu as $item)
                    <li class="b-nav__item" itemprop="itemListElement" itemscope="itemscope" itemtype="https://schema.org/ItemList">
                        <a class="b-nav__link" href="{{ $item->url }}"
                           title="{{ $item->name }}" itemprop="url">{{ $item->name }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</div>
@endif