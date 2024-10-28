@extends('admin::template')

@section('scripts')
    <script type="text/javascript" src="/adminlte/plugins/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/adminlte/interface_news.js"></script>
@stop

@section('page_name')
    <h1>
        Новости
        <small>{{ $article->id ? 'Редактировать' : 'Новая' }}</small>
    </h1>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('admin.news') }}">Новости</a></li>
        <li class="active">{{ $article->id ? 'Редактировать' : 'Новая' }}</li>
    </ol>
@stop

@section('content')
    <form action="{{ route('admin.news.save') }}" onsubmit="return newsSave(this, event)">
        <input type="hidden" name="id" value="{{ $article->id }}">

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Параметры</a></li>
                <li><a href="#tab_2" data-toggle="tab">Текст</a></li>
                <li><a href="#tab_3" data-toggle="tab">Галерея</a></li>
                @if($article->id)
                    <li class="pull-right">
                        <a href="{{ route('news.item', [$article->alias]) }}" target="_blank">Посмотреть</a>
                    </li>
                @endif
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">

                    {!! Form::groupDate('date', $article->date, 'Дата') !!}
                    {!! Form::groupText('name', $article->name, 'Название') !!}
                    {!! Form::groupText('alias', $article->alias, 'Alias') !!}
                    {!! Form::groupText('title', $article->title, 'Title') !!}
                    {!! Form::groupText('keywords', $article->keywords, 'keywords') !!}
                    {!! Form::groupText('description', $article->description, 'description') !!}

                    {!! Form::groupText('og_title', $article->og_title, 'OpenGraph Title') !!}
                    {!! Form::groupText('og_description', $article->og_description, 'OpenGraph description') !!}

                    <div class="form-group">
                        <label for="article-image">Изображение</label>
                        <input id="article-image" type="file" name="image"
                               accept=".jpg,.jpeg,.png"
                               onchange="return newsImageAttache(this, event)">
                        <div id="article-image-block">
                            @if ($article->image)
                                <img class="img-polaroid" src="{{ $article->thumb(1) }}" height="100"
                                     data-image="{{ $article->image_src }}"
                                     onclick="return popupImage($(this).data('image'))">
                                <a class="images_del" href="{{ route('admin.news.delete-image', $article->id) }}"
                                   onclick="return newsImageDel(this, event)">
                                    <span class="glyphicon glyphicon-trash text-red"></span></a>
                            @else
                                <p class="text-yellow">Изображение не загружено.</p>
                            @endif
                        </div>
                    </div>

                    {!! Form::groupCheckbox('published', 1, $article->published, 'Показывать новость') !!}
{{--                    {!! Form::groupCheckbox('on_main', 1, $article->on_main, 'Новость на главной') !!}--}}
                </div>

                <div class="tab-pane" id="tab_2">
                    {!! Form::groupTextarea('announce', $article->announce, 'Краткое описание/вступление', ['rows' => 3]) !!}
                    {!! Form::groupText('video', $article->video, 'Ссылка на You Tube видео') !!}
                    {!! Form::groupRichtext('text', $article->text, 'Текст', ['rows' => 3]) !!}
                </div>

                <div class="tab-pane" id="tab_3">
                    <input id="news-image" type="hidden" name="image" value="{{ $article->image }}">
                    @if ($article->id)
                        <div class="form-group">
                            <label class="btn btn-success">
                                <input id="offer_imag_upload" type="file" multiple
                                       accept=".jpg,.jpeg,.png"
                                       data-url="{{ route('admin.news.newsImageUpload', $article->id) }}"
                                       style="display:none;" onchange="newsImageUpload(this, event)">
                                Загрузить изображения
                            </label>
                        </div>

                        <div class="images_list">
                            @foreach ($article->images as $image)
                                @include('admin::news.news_image', ['image' => $image])
                            @endforeach
                        </div>
                    @else
                        <p class="text-yellow">Изображения в галерею можно будет загрузить после сохранения новости!</p>
                    @endif
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </form>
    <script type="text/javascript">
        $(".images_list").sortable({
            update: function (event, ui) {
                var url = "{{ route('admin.news.newsImageOrder') }}";
                var data = {};
                data.sorted = $('.images_list').sortable("toArray", {attribute: 'data-id'});
                sendAjax(url, data);
            },
        }).disableSelection();
    </script>
@stop