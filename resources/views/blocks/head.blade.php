<head>
    <meta charset="utf-8">
    {!! SEOMeta::generate() !!}
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="apple-touch-icon" sizes="120x120" href="/static/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/static/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/static/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/static/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="/static/images/favicon/safari-pinned-tab.svg" color="#fc8817">
    <link rel="shortcut icon" href="/static/images/favicon/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="name">
    <meta name="application-name" content="name">
    <meta name="cmsmagazine" content="18db2cabdd3bf9ea4cbca88401295164">
    <meta name="author" content="Fanky.ru">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-config" content="/static/images/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <meta property="og:type" content="website">
    <meta property="og:image" content="/static/images/favicon/og-image.png">
    {!! OpenGraph::generate() !!}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="/static/fonts/OpenSans-Regular.woff2" rel="preload" as="font" type="font/woff2" crossorigin="anonymous">
    <link href="/static/fonts/OpenSans-Bold.woff2" rel="preload" as="font" type="font/woff2" crossorigin="anonymous">
    <link href="/static/fonts/Ubuntu-Regular.woff2" rel="preload" as="font" type="font/woff2" crossorigin="anonymous">
    <link href="/static/fonts/DINPro-CondensedBold.woff2" rel="preload" as="font" type="font/woff2" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ mix('static/css/all.css') }}" media="all">
    <script src="{{ mix('static/js/all.js') }}" defer></script>

    <style>
        .preloader{position:fixed;display:-webkit-box;display:-ms-flexbox;display:flex;flex-direction:column;gap: calc(5px + 5 * (100vw / 1920));color:var(--smooth);font-size:12px;font-weight:600;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;top:0;left:0;right:0;bottom:0;z-index:999;background-color:var(--black);-webkit-transition:var(--transition);transition:var(--transition)}.preloader.unactive{opacity:0;visibility:hidden}.preloader__loader,.preloader__loader:after{border-radius:50%;width:3em;height:3em}.preloader__loader{font-size:10px;position:relative;text-indent:-9999em;border-top:.3em solid var(--grey);border-right:.3em solid var(--grey);border-bottom:.3em solid var(--grey);border-left:.3em solid var(--accent);-webkit-transform:translateZ(0);transform:translateZ(0);-webkit-animation:1.5s linear infinite load8;animation:1.5s linear infinite load8}@-webkit-keyframes load8{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes load8{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}
    </style>

    @if(isset($canonical))
        <link rel="canonical" href="{{ $canonical }}"/>
    @endif

{{--    @if(Route::is('contacts'))--}}
{{--        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>--}}
{{--    @endif--}}
</head>
