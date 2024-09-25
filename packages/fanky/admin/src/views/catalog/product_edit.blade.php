@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="{{ route('admin.catalog') }}"><i class="fa fa-list"></i> Каталог</a></li>
        @foreach($product->getParents(false, true) as $parent)
            <li><a href="{{ route('admin.catalog.products', [$parent->id]) }}">{{ $parent->name }}</a></li>
        @endforeach
        <li class="active">{{ $product->id ? $product->name : 'Новый товар' }}</li>
    </ol>
@stop
@section('page_name')
    <h1>Каталог
        <small style="max-width: 350px;">{{ $product->id ? $product->name : 'Новый товар' }}</small>
    </h1>
@stop

<form action="{{ route('admin.catalog.productSave') }}" onsubmit="return productSave(this, event)">
    {!! Form::hidden('id', $product->id) !!}

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Параметры</a></li>
            <li><a href="#tab_2" data-toggle="tab">Текст</a></li>
{{--            <li><a href="#tab_4" data-toggle="tab">Изображения ({{ count($product->images()->get()) }})</a></li>--}}
            <li class="pull-right">
                <a href="{{ route('admin.catalog.products', [$product->catalog_id]) }}"
                   onclick="return catalogContent(this)">К списку товаров</a>
            </li>
            @if($product->id)
                <li class="pull-right">
                    <a href="{{ $product->url }}" target="_blank">Посмотреть</a>
                </li>
            @endif
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">

                {!! Form::groupText('name', $product->name, 'Название') !!}
                {!! Form::groupText('h1', $product->h1, 'H1') !!}
                {!! Form::groupSelect('catalog_id', $catalogs, $product->catalog_id, 'Каталог') !!}
                {!! Form::groupText('alias', $product->alias, 'Alias') !!}
                {!! Form::groupText('title', $product->title, 'Title') !!}
                {!! Form::groupText('keywords', $product->keywords, 'keywords') !!}
                {!! Form::groupText('description', $product->description, 'description') !!}

                {!! Form::groupText('price', $product->price, 'Цена') !!}
                {!! Form::groupText('measure', $product->measure, 'Измерение') !!}
                {!! Form::groupTextarea('comment', $product->comment, 'Комментарий/Размер') !!}
                <hr>
                <div class="row">
                    <div class="form-group col-xs-3" style="display: flex; column-gap: 30px;">
                        <div>
                            <label for="product-image">Изображение товара (мин. 240x240)</label>
                            <input id="product-image" type="file" name="image" value=""
                                   onchange="return productImageAttache(this, event)">
                            <div id="product-image-block">
                                @if ($product->image)
                                    <img class="img-polaroid"
                                         src="{{ $product->image_src }}" height="100"
                                         data-image="{{ $product->image_src }}"
                                         onclick="return popupImage($(this).data('image'))" alt="">
                                    <a class="images_del" href="{{ route('admin.catalog.productImageDel', $product->id) }}"
                                       onclick="return productImageDel(this)">
                                        <span class="glyphicon glyphicon-trash text-red"></span>
                                    </a>
                                @else
                                    <p class="text-yellow">Изображение не загружено.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {!! Form::groupCheckbox('published', 1, $product->published, 'Показывать товар') !!}

            </div>

            <div class="tab-pane" id="tab_2">
                {!! Form::groupRichtext('announce', $product->announce, 'Анонс', ['rows' => 3]) !!}
                {!! Form::groupRichtext('text', $product->text, 'Текст', ['rows' => 3]) !!}
            </div>

{{--            <div class="tab-pane" id="tab_4">--}}
{{--                <input id="product-image" type="hidden" name="image" value="{{ $product->image }}">--}}
{{--                @if ($product->id)--}}
{{--                    <div class="form-group">--}}
{{--                        <label class="btn btn-success">--}}
{{--                            <input id="offer_imag_upload" type="file" multiple--}}
{{--                                   data-url="{{ route('admin.catalog.productImageUpload', $product->id) }}"--}}
{{--                                   style="display:none;" onchange="productImageUpload(this, event)">--}}
{{--                            Загрузить изображения--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                    <p>Размер изображения: 240x240</p>--}}

{{--                    <div class="images_list">--}}
{{--                        @foreach ($product->images()->get() as $image)--}}
{{--                            @include('admin::catalog.product_image', ['image' => $image, 'active' => $product->image])--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <p class="text-yellow">Изображения можно будет загрузить после сохранения товара!</p>--}}
{{--                @endif--}}
{{--            </div>--}}
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(".images_list").sortable({
        update: function (event, ui) {
            var url = "{{ route('admin.catalog.productImageOrder') }}";
            var data = {};
            data.sorted = $('.images_list').sortable("toArray", {attribute: 'data-id'});
            sendAjax(url, data);
            //console.log(data);
        },
    }).disableSelection();
</script>
