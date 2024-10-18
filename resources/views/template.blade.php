<!DOCTYPE html>
<html lang="ru">

@include('blocks.head')

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
{{--@if(isset($h1))--}}
{{--    <h1 class="v-hidden">{{ $h1 }}</h1>--}}
{{--@endif--}}

@include('blocks.header')

@if(Route::is(['news', 'news.item']))
    @include('blocks.search')
@endif

@yield('content')

@include('blocks.footer')

<div class="v-hidden" id="company" itemprop="branchOf" itemscope itemtype="https://schema.org/Corporation"
     aria-hidden="true" tabindex="-1">
    {!! Settings::get('schema.org') !!}
</div>

@if(isset($admin_edit_link) && strlen($admin_edit_link))
    <div class="adminedit">
        <div class="adminedit__ico"></div>
        <a href="{{ $admin_edit_link }}" class="adminedit__name" target="_blank">Редактировать</a>
    </div>
@endif

@if(!SiteHelper::isGooglePageSpeed())
    {!! Settings::get('counters') !!}
@endif
</body>
</html>
