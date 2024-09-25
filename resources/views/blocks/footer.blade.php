<footer class="footer">
    <div class="footer__container container">
        <div class="footer__info">
            <div class="footer__brand">СДВ-СТРОЙ</div>
            <div class="footer__text">{{ Settings::get('footer_text') }}</div>
            <div class="footer__copy">ООО «СДВ-СТРОЙ» © {{ date('Y') }}</div>
        </div>
        @if(count($footer_menu))
            <nav class="footer__nav">
                <ul class="footer__nav-list list-reset">
                    <li class="footer__nav-item">
                        <a class="footer__mav-link" href="{{ route('main') }}">Главная</a>
                    </li>
                    @foreach($header_menu as $item)
                        <li class="footer__nav-item">
                            <a class="footer__mav-link" href="{{ $item->url }}">{{ $item->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        @endif
        <div class="footer__data">
            @if($phones = Settings::get('footer_phones'))
                <div class="footer__data-item">
                    <div class="footer__phones">
                        @foreach($phones as $phone)
                            <a class="footer__phone" href="tel:{{ preg_replace('/[^\d+]/', '', $phone) }}">{{ $phone }}</a>
                        @endforeach
                    </div>
                    <div class="footer__time">{{ Settings::get('footer_schedule') }}</div>
                </div>
            @endif
            <div class="footer__data-item">
                <div class="footer__data-label">Адрес</div>
                <address class="footer__addr">{{ Settings::get('footer_address') }}</address>
            </div>
        </div>
    </div>
</footer>
