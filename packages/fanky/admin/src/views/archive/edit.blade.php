@extends('admin::template')

@section('scripts')
    <script type="text/javascript" src="/adminlte/interface_archive.js"></script>
    <script type="text/javascript" src="/adminlte/interface_magazines.js"></script>
@stop

@section('page_name')
    <h1>
        Архив
        <small>{{ $arc->id ? 'Редактировать' : 'Новый' }}</small>
    </h1>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('admin.reviews') }}">Архив</a></li>
        <li class="active">{{ $arc->id ? 'Редактировать' : 'Новый' }}</li>
    </ol>
@stop

@section('content')
    <form action="{{ route('admin.archive.save') }}" onsubmit="return archiveSave(this, event)">
        <input type="hidden" name="id" value="{{ $arc->id }}">

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#params" data-toggle="tab">Параметры</a></li>
{{--                <li><a href="#magazines" data-toggle="tab">Номера</a></li>--}}

                @if($arc->id)
                    <li class="pull-right">
                        <a href="{{ $arc->url }}" target="_blank">Посмотреть</a>
                    </li>
                @endif
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="params">
                    {!! Form::groupText('year', $arc->year, 'Год') !!}
                    {!! Form::groupCheckbox('published', 1, $arc->published, 'Показывать год') !!}

                    <hr>
                    <h3 style="text-decoration: underline">Номера</h3>

                    @if ($arc->id)
                        <div class="magazines_list">
                            @foreach ($arc->magazines as $item)
                                @include('admin::archive.magazine_item', ['item' => $item])
                            @endforeach
                        </div>
                    @else
                        <p class="text-yellow">Журналы можно будет загрузить после сохранения архива!</p>
                    @endif
                </div>

{{--                <div class="tab-pane" id="magazines"></div>--}}
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </form>
@stop
