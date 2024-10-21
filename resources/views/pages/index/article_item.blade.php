<div class="col-lg-6">
    <div class="mb-5 d-flex blog-entry" data-aos="fade-right" data-aos-delay="">
        @if($article->image)
            <a href="{{ $article->url }}" class="blog-thumbnail">
                <img src="{{ $article->thumb(2) }}" alt="{{ $article->name }}"
                     class="img-fluid">
            </a>
        @endif
        <div class="blog-excerpt">
            <span class="d-block text-muted">{{ $article->dateFormat('F d, Y'), }}</span>
            <h2 class="h4  mb-3">
                <a href="{{ $article->url }}">{{ $article->name }}</a>
            </h2>
            <p>{{ $article->getAnnounce() }}</p>
            <p><a href="{{ $article->url }}" class="text-primary">Читать больше</a></p>
        </div>
    </div>
</div>