<div class="cart-item__data">
    <div class="cart-item__price">{{ $item['price'] }} ₽</div>
    @if($item['count'] == 1)
        <div class="cart-item__label">Цена за {{ $item['measure'] ?? 'шт' }}</div>
    @else
        <div class="cart-item__label">{{ $item['count'] }} {{ $item['measure'] ?? 'шт' }} x {{ $item['price'] }} ₽</div>
    @endif
</div>
