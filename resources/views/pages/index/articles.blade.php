<div class="site-section py-5" id="articles">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <div class="block-heading-1" data-aos="fade-right" data-aos-delay="">
                    <h2>статьи</h2>
{{--                    @if($sub = S::get('articles_subtitle'))--}}
{{--                        <p>{{ $sub }}</p>--}}
{{--                    @endif--}}
                </div>
            </div>
        </div>
        @if(count($articles_chunks))
            <div class="row">
                @foreach($articles_chunks as $chunks)
                    @if($loop->first)
                        @foreach($chunks as $article)
                            @include('pages.index.article_item')
                        @endforeach
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>

@if(count($articles_chunks) > 1)
    @foreach($articles_chunks as $chunks)
        @if(!$loop->first)
            <div class="site-section py-5">
                <div class="container">
                    <div class="row">
                        @foreach($chunks as $article)
                            @include('pages.index.article_item')
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endif