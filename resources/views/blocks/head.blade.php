<head>
    <meta charset="utf-8">
    {!! SEOMeta::generate() !!}
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="cmsmagazine" content="18db2cabdd3bf9ea4cbca88401295164">
    <meta name="author" content="Fanky.ru">
    <meta property="og:type" content="website">
    <meta property="og:image" content="/static/images/favicon/og-image.png">
    {!! OpenGraph::generate() !!}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,700|Oswald:400,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ mix('static/css/all.css') }}" media="all">
    <script src="{{ mix('static/js/all.js') }}" defer></script>

    @if(isset($canonical))
        <link rel="canonical" href="{{ $canonical }}"/>
    @endif

{{--    @if(Route::is('contacts'))--}}
{{--        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>--}}
{{--    @endif--}}
</head>
