<div class="mb-lg-0 col-lg-4 col-md-4 col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="">
    <div class="pricing">
        <div>
            <a href="{{ $item->url }}">
                <img src="{{ $item->thumb(2) }}" alt="N{{ $item->number_year }}" width="223"
                     height="270">
            </a>
        </div>
        <br>
        <div>
            <h3 class="text-center text-black">сухой закон</h3>
        </div>
        <div class="price text-center accordion">
            <span><span>N{{ $item->number_year }}({{ $item->number_total }})</span> / {{ $item->archive->year }}</span>
        </div>
        {!! $item->getAnnounce() !!}
        <p class="text-center">
            <a href="{{ $item->url }}" class="btn btn-secondary btn-md">Читать сейчас</a>
        </p>
    </div>
</div>