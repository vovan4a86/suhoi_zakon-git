@if(count($reviews))
    <div class="site-section bg-light block-13" id="reviews" data-aos="fade">
        <div class="container">
            <div class="text-center mb-5">
                <div class="block-heading-1"><br>
                    <h2>Отзывы </h2>
                </div>
            </div>
            <div class="owl-carousel nonloop-block-13">
                @foreach($reviews as $r)
                    <div>
                        <div class="block-testimony-1 text-center">

                            <blockquote class="mb-4">
                                {!! $r->text !!}
                            </blockquote>

                            @if($r->image)
                                <figure>
                                    <img src="{{ $r->thumb(1) }}" alt="{{ $r->name }}"
                                         class="img-fluid rounded-circle mx-auto">
                                </figure>
                            @endif
                            <h3 class="font-size-20 text-black" style="line-height:22px">{{ $r->name }}</h3>
                            @if($r->job)
                                <div class="mb-4" style="line-height:22px">
                                    <p>{!! $r->job !!}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif