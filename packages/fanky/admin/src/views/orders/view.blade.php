@extends('admin::template')

@section('scripts')
    <script type="text/javascript" src="/adminlte/interface_orders.js"></script>
@stop

@section('page_name')
    <h1>Заказ № {{ $order->id }}</h1>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('admin.orders') }}">Заказы</a></li>
        <li class="active">Заказ № {{ $order->id }}</li>
    </ol>
@stop

@section('content')
    <div class="box box-solid">
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4 text-bold">Дата заказа</div>
                        <div class="col-md-8">{{ $order->dateFormat('d.m.Y, H:i') }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-bold">Имя</div>
                        <div class="col-md-8">{{ $order->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-bold">Телефон</div>
                        <div class="col-md-8">{{ $order->phone }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-bold">Адрес</div>
                        <div class="col-md-8">{{ $order->address }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-bold">Комментарий</div>
                        <div class="col-md-8">{{ $order->text }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 text-bold">Оплата</div>
                        <div class="col-md-8">{{ $order->payment }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-solid">
        <div class="box-body">
            @if (count($items))
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th style="text-align: center;">N</th>
                        <th>Товар</th>
                        <th style="text-align: center;">Количество</th>
                        <th style="text-align: center;">Цена</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td width="10" style="text-align: center;">{{ $loop->iteration }}</td>
                            <td><a target="_blank"
                                   href="{{ route('admin.catalog.productEdit', [$item->id]) }}">{{ $item->name }}</a>
                            </td>
                            <td style="text-align: center;">{{ $item->pivot->count }} шт/м2</td>
                            <td style="text-align: center;">{{ $item->pivot->price }} ₽</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>Итого:</th>
                        <th style="text-align: center;">{{ $all_count }} шт/м2</th>
                        <th style="text-align: center;">{{ $all_summ }} ₽</th>
                    </tr>
                    </tfoot>
                </table>
            @else
                <p>Нет товаров в заказе!</p>
            @endif
        </div>
    </div>
@stop
