@extends('admin::template')

@section('scripts')
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/adminlte/interface_magazines.js"></script>
@stop

@section('page_name')
    <h1>Журналы
        <small><a href="{{ route('admin.magazines.edit') }}">Добавить журнал</a></small>
    </h1>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Журналы</li>
    </ol>
@stop

@section('content')
    <div class="box box-solid">
        <div class="box-body">
            @if (count($magazines))
                <table class="table table-striped table-v-middle">
                    <tbody id="reviews-list">
                    @foreach ($magazines as $item)
                        <tr data-id="{{ $item->id }}">
                            <td width="60" style="text-align: center; font-size:20px;">
                                {{ $item->archive->year }}</td>
                            <td width="100">
                                @if ($item->image)
                                    <img src="{{ $item->thumb(1) }}" alt="image" height="100">
                                @else
                                    <img src="{{ \Fanky\Admin\Models\Magazine::PDF_IMAGE }}" alt="image">
                                @endif
                            </td>
                            <td>
                                <a class="glyphicon"
                                   href="{{ route('admin.magazines.edit', [$item->id]) }}"
                                   style="font-size:20px; color:orange;">
                                    {{ $item->number_year }} ({{ $item->number_total }})
                                </a>
                            </td>
                            <td width="100">{{ $item->on_main ? 'На главной' : '' }}</td>
                            <td width="60">
                                <a class="glyphicon glyphicon-trash"
                                   href="{{ route('admin.magazines.delete', [$item->id]) }}"
                                   style="font-size:20px; color:red;" onclick="magazineDel(this, event)"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>Нет журналов!</p>
            @endif
        </div>
    </div>
@stop
