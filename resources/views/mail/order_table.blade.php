<html>
<body>
<h1>Новый заказ № {{ $order->id }} от {{ $order->created_at->format('d.m.Y H:i:s') }}</h1>
<p><b>Заказчик:</b> {{ $order->name }}</p>
<p><b>Телефон:</b> {{ $order->phone }}</p>
<p><b>Адрес:</b> {{ $order->address ?: 'не указан' }}</p>
<p><b>Комментарий:</b> {{ $order->text }}</p>
<p><b>Сумма заказа:</b> {{ $order->summ }} ₽</p>
<p><b>Оплата:</b> {{ $order->payment }} </p>
<hr>

@if (count($items))
    <h2>Товары</h2>
    <table width="100%" border="1">
        <thead>
        <th style="text-align: left">#</th>
        <th style="text-align: left">Товар</th>
        <th style="text-align: left">Количество</th>
        <th style="text-align: left">Цена, ₽</th>
        <th style="text-align: left">Стоимость, ₽</th>
        </thead>
        <tbody>
        @foreach($items as $key => $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td><a target="_blank"
                       href="{{ route('admin.catalog.productEdit', $item->id) }}">{{ $item->name }}</a></td>
                <td>{{ $item->pivot->count }}</td>
                <td>{{ number_format($item->price, 0, '', ' ') }}</td>
                <td>{{ number_format($item->pivot->price, 0, '', ' ') }} </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th style="text-align: left">Итого:</th>
            <th style="text-align: left">{{ '' }}</th>
            <th style="text-align: left">{{ $all_count }}</th>
            <th style="text-align: left">{{ '' }}</th>
            <th style="text-align: left">{{ number_format($all_sum, 0, '', ' ') }}</th>
        </tr>
        </tfoot>
    </table>
@endif
</body>
</html>
