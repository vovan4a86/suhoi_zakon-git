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

    <script src="/static/js/jquery-3.3.1.min.js" defer></script>
    <script src="/static/js/popper.min.js" defer></script>
    <script src="/static/js/bootstrap.min.js" defer></script>
    <script src="/static/js/owl.carousel.min.js" defer></script>
    <script src="/static/js/jquery.sticky.js" defer></script>
    <script src="/static/js/jquery.waypoints.min.js" defer></script>
    <script src="/static/js/jquery.animateNumber.min.js" defer></script>
    <script src="/static/js/jquery.fancybox.min.js" defer></script>
    <script src="/static/js/jquery.easing.1.3.js" defer></script>
    <script src="/static/js/aos.js" defer></script>

    <link rel="stylesheet" type="text/css" href="{{ mix('static/css/all.css') }}" media="all">
    <script src="{{ mix('static/js/all.js') }}" defer></script>



    @if(isset($canonical))
        <link rel="canonical" href="{{ $canonical }}"/>
    @endif

    @if(Route::is('magazines.item'))
            <script src="/static/js/dflip.min.js" type="text/javascript" defer></script>
    @endif
</head>
