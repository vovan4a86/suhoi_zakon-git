@if($about = S::get('main_about'))
    <div class="site-section" id="about">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-12 text-center">
                    <div class="block-heading-1" data-aos="fade-up" data-aos-delay=""><br>
                        @if($about['title'])
                            <h2>{{ $about['title'] }}</h2>
                        @endif
                        {!! $about['text'] !!}
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="site-section bg-light">
    <div class="container">
        @if($video = S::get('main_about_video'))
            <div class="row justify-content-center mb-4 block-img-video-1-wrap">
                <div class="col-md-12 mb-5">
                    @if($video['url'] && $video['img'])
                        <figure class="block-img-video-1" data-aos="fade">
                            <a href="{{ $video['url'] }}" data-fancybox data-ratio="2">
                                <span class="icon"><span class="icon-play"></span></span>
                                <img src="{{ S::fileSrc($video['img']) }}" alt="Image" class="img-fluid">
                            </a>
                        </figure>
                    @endif
                </div>
            </div>
        @endif

        @if($numbers = S::get('main_about_numbers'))
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        @foreach($numbers as $n)
                            <div class="col-6 col-md-6 mb-4 col-lg-0 col-lg-3" data-aos="fade-up" data-aos-delay="10">
                                <div class="block-counter-1">
                                    <span class="number"><span data-number="{{ $n['num'] }}">{{ $n['num'] }}</span>+</span>
                                    <p><span class="caption">{!! $n['text'] !!}</span></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>