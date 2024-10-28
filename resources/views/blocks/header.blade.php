<div id="overlayer"></div>
<div class="loader">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if($email = S::get('header_email'))
                    <a href="mailto:{{ $email }}" class=""><span class="mr-2  icon-envelope-open-o"></span> <span
                                class="d-none d-md-inline-block">{{ $email }}</span>
                    </a>
                @endif
                @if($phone = S::get('header_phone'))
                    <div class="float-right">
                        <span class="mx-md-2 d-inline-block"></span>
                        <a href="tel:{{ SiteHelper::clearPhone($phone) }}" class="">
                            <span class="mr-2  icon-phone"></span>
                            <span class="d-none d-md-inline-block">{{ $phone }}</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<header class="site-navbar js-sticky-header site-navbar-target" role="banner">
    <div class="container">
        <div class="row align-items-center position-relative">
            <div class="col-4">
                <div class="site-logo">
                    @if(Route::is('main'))
                        <span class="text-black"><span class="text-primary">СУХОЙ ЗАКОН</span></span>
                    @else
                        <a href="{{ route('main') }}" class="text-black"><span
                                    class="text-primary">СУХОЙ ЗАКОН</span></a>
                    @endif
                </div>
            </div>
            <div class="col-8">
                <nav class="site-navigation text-right ml-auto " role="navigation">
                    <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                        <li><a href="{{ route('main') }}" class="nav-link">Главная</a></li>
                        @foreach($header_menu as $item)
                            @if(!count($item->public_children))
                                <li>
                                    <a href="{{ $item->url }}" class="nav-link">{{ $item->name }}</a>
                                </li>
                            @else
                                <li class="has-children">
                                    <a href="{{ $item->url }}" class="nav-link">{{ $item->name }}</a>
                                    <ul class="dropdown arrow-top">
                                        @foreach($item->public_children as $child)
                                            <li><a href="{{ $child->url }}" class="nav-link">{{ $child->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                            @endif
                        @endforeach
                    </ul>
                </nav>
            </div>

            <div class="toggle-button d-inline-block d-lg-none">
                <a href="#" class="site-menu-toggle py-5 js-menu-toggle text-black">
                    <span class="icon-menu h3"></span>
                </a>
            </div>
        </div>
    </div>
</header>