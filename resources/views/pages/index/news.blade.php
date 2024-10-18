<div class="row mb-5 justify-content-center" id="news">
    <div class="col-md-7 text-center">
        <div class="block-heading-1">
            <h2>новости</h2>
            @if($sub = S::get('news_subtitle'))
                <p>{{ $sub }}</p>
            @endif
        </div>
    </div>
</div>

@if(count($news))
    @foreach($news as $i => $chunks)
        <div class="ftco-service-image-1 pb-5">
            <div class="container">
                <div class="owl-carousel owl-all">
                    @foreach($chunks as $item)
                        <div class="service text-center">
                            <a href="{{ $item->url }}">
                                <img src="{{ $item->thumb(2) }}" alt="{{ $item->name }}" class="img-fluid">
                            </a>
                            <div class="px-md-3">
                                <h3><a href="{{ $item->url }}">{{ $item->name }}</a></h3>
                                <p>{{ $item->getAnnounce() }}</p>
                                <p><a href="{{ $item->url }}" class="text-primary">Читать дальше >>> </a></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
@endif