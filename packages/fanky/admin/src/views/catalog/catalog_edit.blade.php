@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('admin.catalog') }}"><i class="fa fa-list"></i> Каталог</a></li>
        @foreach($catalog->getParents(false, true) as $parent)
            <li><a href="{{ route('admin.catalog.products', [$parent->id]) }}">{{ $parent->name }}</a></li>
        @endforeach
        <li class="active">{{ $catalog->id ? $catalog->name : 'Новый раздел' }}</li>

    </ol>
@stop
@section('page_name')
    <h1>Каталог
        <small>{{ $catalog->id ? $catalog->name : 'Новый раздел' }}</small>
    </h1>
@stop

<form action="{{ route('admin.catalog.catalogSave') }}" onsubmit="return catalogSave(this, event)">
    <input type="hidden" name="id" value="{{ $catalog->id }}">

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Параметры</a></li>
            @if($catalog->id && $catalog->parent_id == 0)
                <li><a href="#tab_icons" data-toggle="tab">Иконки преимуществ</a></li>
            @endif
            <li><a href="#tab_2" data-toggle="tab">Тексты</a></li>
            <li><a href="#tab_gallery" data-toggle="tab">Галерея</a></li>

            @if($catalog->id)
                <li class="pull-right">
                    <a href="{{ $catalog->parent_id == 0 ? $catalog->url : $catalog->parent->url }}" target="_blank">Посмотреть</a>
                </li>
            @endif
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">

                @if(request('parent') && $catalog->parent_id !== 0 )
                    {!! Form::groupText('name', $catalog->name, 'Название') !!}
                    {!! Form::groupText('h1', $catalog->h1, 'H1') !!}
                    {!! Form::groupText('h2', $catalog->h2, 'H2') !!}
                    <input type="hidden" name="parent_id" value="{{ $catalog->parent_id }}">
                    {!! Form::hidden('published', 0) !!}
                    {!! Form::groupCheckbox('published', 1, $catalog->published, 'Показывать раздел') !!}
                @else
                    {!! Form::groupText('name', $catalog->name, 'Название') !!}
                    {!! Form::groupText('h1', $catalog->h1, 'H1') !!}
                    {!! Form::groupText('h2', $catalog->h2, 'H2') !!}

                    {!! Form::groupSelect('parent_id', ['0' => '---корень---'] + $catalogs->pluck('name', 'id')->all(),
                        $catalog->parent_id, 'Родительский раздел') !!}
                    {!! Form::groupText('alias', $catalog->alias, 'Alias') !!}
                    {!! Form::groupText('title', $catalog->title, 'Title') !!}
                    {!! Form::groupText('keywords', $catalog->keywords, 'keywords') !!}
                    {!! Form::groupText('description', $catalog->description, 'description') !!}
                    {!! Form::groupText('og_title', $catalog->og_title, 'OpenGraph title') !!}
                    {!! Form::groupText('og_description', $catalog->og_description, 'OpenGraph description') !!}

                    <div class="row">
                        <div class="form-group col-xs-3" style="display: flex; column-gap: 30px;">
                            <div>
                                <label for="article-image">Изображение раздела (мин. 240x240)</label>
                                <input id="article-image" type="file" name="image" value=""
                                       accept=".png,.jpeg,.jpg"
                                       onchange="return catalogImageAttache(this, event)">
                                <div id="article-image-block">
                                    @if ($catalog->image)
                                        <img class="img-polaroid"
                                             src="{{ $catalog->image_src }}" height="100"
                                             data-image="{{ $catalog->image_src }}"
                                             onclick="return popupImage($(this).data('image'))" alt="">
                                        <a class="images_del"
                                           href="{{ route('admin.catalog.catalogImageDel', [$catalog->id]) }}"
                                           onclick="return catalogImageDel(this)">
                                            <span class="glyphicon glyphicon-trash text-red"></span>
                                        </a>
                                    @else
                                        <p class="text-yellow">Изображение не загружено.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {!! Form::hidden('published', 0) !!}
                    {!! Form::groupCheckbox('published', 1, $catalog->published, 'Показывать раздел') !!}
                    {!! Form::hidden('request_only', 0) !!}
                    @if($catalog->id && $catalog->parent_id == 0 )
                    {!! Form::groupCheckbox('request_only', 1, $catalog->request_only, 'Кнопка "Оставить заявку" для раздела') !!}
                    @endif
                @endif
            </div>

            @if($catalog->parent_id == 0)
                <div class="tab-pane" id="tab_icons">
                    @if ($catalog->id)
                        <div class="form-group">
                            <label class="btn btn-success">
                                <input id="offer_imag_upload" type="file" multiple
                                       accept=".png,.jpg,.jpeg"
                                       data-url="{{ route('admin.catalog.catalogFeaturesUpload', $catalog->id) }}"
                                       style="display:none;" onchange="catalogFeaturesUpload(this, event)">
                                Загрузить иконки
                            </label>
                        </div>
                        <p>Размер изображения: мин. 40x40</p>

                        <div class="features_list">
                            @foreach ($catalog->features as $feature)
                                @include('admin::catalog.catalog_feature', ['image' => $feature])
                            @endforeach
                        </div>
                    @else
                        <p class="text-yellow">Преимущества можно будет загрузить после сохранения каталога!</p>
                    @endif
                </div>
            @endif

            <div class="tab-pane" id="tab_2">
                {!! Form::groupRichtext('text', $catalog->text, 'Основной текст') !!}
                {!! Form::groupRichtext('text_after', $catalog->text_after, 'Дополнительный текст') !!}
            </div>

            <div class="tab-pane" id="tab_gallery">
                @if ($catalog->id)
                    @if($catalog->parent_id == 0)
                        {!! Form::hidden('gallery_template', 0) !!}
                        {!! Form::groupCheckbox('gallery_template', 1, $catalog->gallery_template, 'Галерея под шаблоны') !!}
                    @endif
                    {!! Form::groupRichtext('gallery_text', $catalog->gallery_text, 'Текст перед галереей') !!}
                    <div class="form-group">
                        <label class="btn btn-success">
                            <input id="offer_imag_upload" type="file" multiple
                                   accept=".png,.jpg,.jpeg"
                                   data-url="{{ route('admin.catalog.catalogGalleryUpload', $catalog->id) }}"
                                   style="display:none;" onchange="catalogGalleryUpload(this, event)">
                            Загрузить изображения
                        </label>
                    </div>
                    <p>Размер изображения: мин. 335x478</p>

                    <div class="images_list">
                        @foreach ($catalog->images as $image)
                            @include('admin::catalog.catalog_image', ['image' => $image])
                        @endforeach
                    </div>
                @else
                    <p class="text-yellow">Изображения можно будет загрузить после сохранения каталога!</p>
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
            const url = "{{ route('admin.catalog.catalogGalleryOrder') }}";
            let data = {};
            data.sorted = $('.images_list').sortable("toArray", {attribute: 'data-id'});
            sendAjax(url, data);
        },
    }).disableSelection();
</script>
<script type="text/javascript">
    $(".features_list").sortable({
        update: function (event, ui) {
            const url = "{{ route('admin.catalog.catalogFeaturesOrder') }}";
            let data = {};
            data.sorted = $('.features_list').sortable("toArray", {attribute: 'data-id'});
            sendAjax(url, data);
        },
    }).disableSelection();
</script>
