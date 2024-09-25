<div class="cart-item" data-id="{{ $item['id'] }}">
    <a class="cart-item__view" href="{{ $item['url'] }}" title="{{ $item['name'] }}">
        @if($item['image'])
            <img class="cart-item__pic no-select" src="{{ $item['image'] }}" width="120"
                 height="120" alt="{{ $item['name'] }}"/>
        @endif
    </a>
    <div class="cart-item__body">
        <div class="cart-item__title">{{ $item['name'] }}</div>
        <div class="cart-item__counter">
            <div class="counter" data-counter="data-counter">
                <button class="counter__btn counter__btn--prev btn-reset" type="button"
                        aria-label="Меньше">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="2"
                         fill="currentColor">
                        <path fill-opacity=".56"
                              d="M0 1C0 .527.384.143.857.143h10.286a.857.857 0 0 1 0 1.714H.857A.857.857 0 0 1 0 1Z"/>
                    </svg>
                </button>
                <input class="counter__input input-reset" type="number" name="count" value="{{ $item['count'] }}"
                       data-id="{{ $item['id'] }}" data-count="data-count"/>
                <button class="counter__btn counter__btn--next btn-reset" type="button"
                        aria-label="Больше">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                         fill="currentColor">
                        <path fill-opacity=".56" fill-rule="evenodd"
                              d="M6 0a.857.857 0 0 0-.857.857v4.286H.857a.857.857 0 0 0 0 1.714h4.286v4.286a.857.857 0 0 0 1.714 0V6.857h4.286a.857.857 0 0 0 0-1.714H6.857V.857A.857.857 0 0 0 6 0Z"
                              clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    @include('cart.basket_item_data')
    <div class="cart-item__delete">
        <button class="cart-item__btn btn-reset" type="button" aria-label="Удалить из заказа">
            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="14" fill="none">
                <path fill="currentColor" fill-opacity=".56" fill-rule="evenodd"
                      d="M3.998 3H6V2H3.99c.004 0 .007.5.008 1ZM8 3V1.999A1.992 1.992 0 0 0 6.01 0H3.99A2 2 0 0 0 2 1.999V3H.875C.392 3 0 3.448 0 4s.392 1 .875 1h8.25C9.608 5 10 4.552 10 4s-.392-1-.875-1H8ZM.005 7.1l.495 4c.162 1.617 1.375 2.9 3 2.9h3c1.622 0 2.838-1.28 3-2.9l.495-4a1 1 0 1 0-1.99-.2l-.5 4.1c-.06.599-.412 1-1.005 1h-3c-.594 0-.945-.403-1.005-1l-.5-4.1a1 1 0 1 0-1.99.2Z"
                      clip-rule="evenodd"/>
            </svg>
        </button>
    </div>
</div>