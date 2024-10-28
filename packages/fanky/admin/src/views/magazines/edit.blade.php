@extends('admin::template')

@section('scripts')
    <script type="text/javascript" src="/adminlte/interface_magazines.js"></script>
@stop

@section('page_name')
    <h1>
        Журнал
        <small>{{ $magazine->id ? 'Редактировать' : 'Новый' }}</small>
    </h1>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('admin.magazines') }}">Журналы</a></li>
        <li class="active">{{ $magazine->id ? 'Редактировать' : 'Новый' }}</li>
    </ol>
@stop

@section('content')
    <form action="{{ route('admin.magazines.save') }}" onsubmit="return magazineSave(this, event)">
        <input type="hidden" name="id" value="{{ $magazine->id }}">

        <div class="box box-solid">
            <div class="box-body">
                @if($magazine->id)
                    <span class="pull-right">
                        <a href="{{ route('magazines.item', [$magazine->id]) }}" target="_blank">Посмотреть</a>
                    </span>
                @endif
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group" style="display: flex; column-gap: 30px;">
                            <div>
                                <label for="magazine-cover">Обложка</label>
                                <input id="magazine-cover" type="file" name="image"
                                       accept=".png,.jpg,.jpeg" onchange="return magazineCoverAttache(this, event)">
                                <div id="magazine-cover-block">
                                    @if ($magazine->image)
                                        <img class="img-polaroid"
                                             src="{{ $magazine->thumb(1) }}" data-image="{{ $magazine->image_src }}"
                                             onclick="return popupImage($(this).data('image'))" alt="image">
                                        <a class="images_del"
                                           href="{{ route('admin.magazines.deleteCover', [$magazine->id]) }}"
                                           onclick="return deleteCover(this, event)">
                                            <span class="glyphicon glyphicon-trash text-red"></span>
                                        </a>
                                    @else
                                        <p class="text-yellow">Изображение не загружено.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group" style="display: flex; column-gap: 30px;">
                            <div>
                                <label for="magazine-file">Файл журнала (.pdf)</label>
                                <input id="magazine-file" type="file" name="file"
                                       accept=".pdf" onchange="return magazineFileAttache(this, event)">
                                <div id="magazine-file-block">
                                    @if ($magazine->file)
                                        <a href="{{ $magazine->file_src }}" target="_blank" title="Открыть в новом окне">
                                            <img class="img-polaroid" src="{{ \Fanky\Admin\Models\Magazine::PDF_IMAGE }}"
                                                 height="100" alt="image">
                                        </a>
                                        <a class="images_del"
                                           href="{{ route('admin.magazines.deleteFile', [$magazine->id]) }}"
                                           onclick="return deleteFile(this, event)">
                                            <span class="glyphicon glyphicon-trash text-red"></span>
                                        </a>
                                    @else
                                        <p class="text-yellow">Журнал не загружен.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {!! Form::groupSelect('archive_id', $archive,
                        $magazine->archive_id, 'Год') !!}
                {!! Form::groupText('number_year', $magazine->number_year, 'Номер в году') !!}
                {!! Form::groupText('number_total', $magazine->number_total, 'Общий номер') !!}

                {!! Form::groupRichtext('announce', $magazine->announce, 'Анонс') !!}

                {!! Form::groupCheckbox('published', 1, $magazine->published, 'Показывать журнал') !!}
                {!! Form::groupCheckbox('on_main', 1, $magazine->on_main, 'На главной') !!}

            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </form>
@stop
