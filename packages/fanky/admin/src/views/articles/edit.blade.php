@extends('admin::template')

@section('scripts')
    <script type="text/javascript" src="/adminlte/plugins/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/adminlte/interface_article.js"></script>
@stop

@section('page_name')
    <h1>
        Статьи
        <small>{{ $article->id ? 'Редактировать' : 'Новая' }}</small>
    </h1>
@stop

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('admin.articles') }}">Статьи</a></li>
        <li class="active">{{ $article->id ? 'Редактировать' : 'Новая' }}</li>
    </ol>
@stop

@section('content')
    <form action="{{ route('admin.articles.save') }}" onsubmit="return articleSave(this, event)">
        <input type="hidden" name="id" value="{{ $article->id }}">

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Параметры</a></li>
                <li><a href="#tab_2" data-toggle="tab">Текст</a></li>
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
                        <input id="article-image" type="file" name="image" onchange="return newsImageAttache(this, event)">
                        <div id="article-image-block">
                            @if ($article->image)
                                <img class="img-polaroid" src="{{ $article->thumb(1) }}" height="100"
                                     data-image="{{ $article->image_src }}"
                                     onclick="return popupImage($(this).data('image'))" alt="thumb">
                                <a class="images_del" href="{{ route('admin.articles.delete-image', $article->id) }}"
                                   onclick="return articleImageDel(this, event)">
                                    <span class="glyphicon glyphicon-trash text-red"></span></a>
                            @else
                                <p class="text-yellow">Изображение не загружено.</p>
                            @endif
                        </div>
                    </div>

                    {!! Form::groupCheckbox('published', 1, $article->published, 'Показывать новость') !!}
                    {!! Form::groupCheckbox('on_main', 1, $article->on_main, 'Статья на главной') !!}
                </div>

                <div class="tab-pane" id="tab_2">
                    {!! Form::groupTextarea('announce', $article->announce, 'Краткое описание', ['rows' => 3]) !!}
                    {!! Form::groupRichtext('text', $article->text, 'Текст', ['rows' => 3]) !!}
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </form>
@stop