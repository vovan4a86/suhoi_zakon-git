<!DOCTYPE html>
<html lang="ru-RU">

@include('blocks.head')

<body class="no-scroll">
@if(isset($h1))

    <h1 class="v-hidden">{{ $h1 }}</h1>
@endif
<div class="preloader">
    <div class="preloader__loader"></div>
    <div class="preloader__lobel">Загрузка</div>
    <script type="text/javascript">
        const preloader=document.querySelector(".preloader"),body=document.querySelector("body");preloader&&window.addEventListener("load",(()=>{body.classList.remove("no-scroll"),preloader.classList.add("unactive")}));
    </script>
</div>

@include('blocks.header')
@include('blocks.mob_nav')
@include('blocks.b_nav')

@yield('content')

@include('blocks.footer')
@include('blocks.popups')

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
