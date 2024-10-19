<div class="site-section" id="redaction">
    <div class="container">
        @if($titles = S::get('main_red_title'))
            <div class="row mb-5 justify-content-center">
                <div class="col-md-7 text-center">
                    <div class="block-heading-1" data-aos="fade-up" data-aos-delay=""><br>
                        @if($titles['title'])
                            <h2>{{ $titles['title'] }}</h2>
                        @endif
                        @if($titles['subtitle'])
                            <p>{{ $titles['subtitle'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        @if($redaction = S::get('main_redaction'))
        <div class="owl-carousel owl-all">
            @foreach($redaction as $item)
                <div class="block-team-member-1 text-center rounded h-100">
                    @if($item['img'])
                        <figure>
                            <img src="{{ S::fileSrc($item['img']) }}" alt="Image" class="img-fluid rounded-circle">
                        </figure>
                    @endif
                    @if($item['name'])
                        <h3 class="font-size-20 text-black">{{ $item['name'] }}</h3>
                    @endif
                    @if($item['job'])
                        <span class="d-block font-gray-5 letter-spacing-1 text-uppercase font-size-12 mb-3">{{ $item['job'] }}</span>
                    @endif
                    @if($item['text'])
                        <p class="mb-4">{{ $item['text'] }}</p>
                    @endif
                </div>
            @endforeach
        </div>
        @endif

    </div>
</div>
<br>