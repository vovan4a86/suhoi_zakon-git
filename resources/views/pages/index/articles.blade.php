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
                            <div class="col-lg-6">
                                <div class="mb-5 d-flex blog-entry" data-aos="fade-right" data-aos-delay="">
                                    @if($article->image)
                                        <a href="#" class="blog-thumbnail">
                                            <img src="{{ $article->thumb(2) }}" alt="{{ $article->name }}"
                                                 class="img-fluid">
                                        </a>
                                    @endif
                                    <div class="blog-excerpt">
                                        <span class="d-block text-muted">Сентябрь 19, 2023</span>
                                        <h2 class="h4  mb-3">
                                            <a href="{{ $article->url }}">{{ $article->name }}</a>
                                        </h2>
                                        <p>{{ $article->getAnnounce() }}</p>
                                        <p><a href="{{ $article->url }}" class="text-primary">Читать больше</a></p>
                                    </div>
                                </div>
                            </div>
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
                            <div class="col-lg-6">
                                <div class="mb-5 d-flex blog-entry" data-aos="fade-right" data-aos-delay="">
                                    @if($article->image)
                                        <a href="#" class="blog-thumbnail">
                                            <img src="{{ $article->thumb(2) }}" alt="{{ $article->name }}"
                                                 class="img-fluid">
                                        </a>
                                    @endif
                                    <div class="blog-excerpt">
                                        <span class="d-block text-muted">Сентябрь 19, 2023</span>
                                        <h2 class="h4  mb-3">
                                            <a href="{{ $article->url }}">{{ $article->name }}</a>
                                        </h2>
                                        <p>{{ $article->getAnnounce() }}</p>
                                        <p><a href="{{ $article->url }}" class="text-primary">Читать больше</a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endif