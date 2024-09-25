@extends('admin::template')

@section('scripts')
    <script type="text/javascript" src="/adminlte/interface_orders.js"></script>
@stop

@section('page_name')
    <h1>Заказы</h1>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Заказы</li>
    </ol>
@stop

@section('content')
    <div class="box box-solid">
        <div class="box-body">
            @if (count($orders))
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th width="200">Дата заказа</th>
                        <th>Имя</th>
                        <th>Телефон</th>
                        <th>Адрес</th>
                        <th>Оплата</th>
                        <th>Сумма</th>
                        <th width="50"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $item)
                        <tr>
                            <td>{{ $item->dateFormat('d.m.Y, H:i') }} @if($item->new)<span class="label label-danger">NEW</span>@endif</td>
                            <td><a href="{{ route('admin.orders.view', [$item->id]) }}">{{ $item->name }}</a></td>
                            <td><a href="{{ route('admin.orders.view', [$item->id]) }}">{{ $item->phone }}</a></td>
                            <td><a href="{{ route('admin.orders.view', [$item->id]) }}">{{ $item->address }}</a></td>
                            <td><a href="{{ route('admin.orders.view', [$item->id]) }}">{{ $item->payment }}</a></td>
                            <td><a href="{{ route('admin.orders.view', [$item->id]) }}">{{ $item->total_sum }} ₽</a></td    >
                            <td>
                                <a class="glyphicon glyphicon-trash" href="{{ route('admin.orders.del', [$item->id]) }}" style="font-size:20px; color:red;" title="Удалить" onclick="return orderDel(this)"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $orders->render() !!}
            @else
                <p>Нет заказов!</p>
            @endif
        </div>
    </div>
@stop
