@extends('admin::template')

@section('content')
    <div class="box box-primary box-solid">
        <div class="box-header"><h2 class="box-title">Подписчики</h2></div>
        <div class="box-body">
            <table class="table table-striped table-hover">
                <thead>
                <th>Дата</th>
                <th>Email</th>
                </thead>
                <tbody>
                @foreach($subscribers as $item)
                    <tr>
                        <td>{{ $item->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $item->email }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            {!! $subscribers->render() !!}
        </div>
    </div>
@stop