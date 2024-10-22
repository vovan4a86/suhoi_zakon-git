<div class="site-section bg-light" id="archive">
    <div class="container">
        <div class="row mb-5 justify-content-center text-center">
            <div class="col-md-10">
                <div class="block-heading-1" data-aos="fade-up" data-aos-delay=""><br>
                    <h2>архив номеров</h2>
                    <p>
                        @foreach($years as $year)
                            @if(!$loop->last)
                                <a href="{{ $year->url }}">{{ $year->year }}</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                            @else
                                <a href="{{ $year->url }}">{{ $year->year }}</a>
                            @endif
                        @endforeach
                    </p>
                </div>
            </div>
        </div>

        @if(count($magazines_chunks))
            @foreach($magazines_chunks as $chunk)
                @if($loop->first)
                    <div class="row mb-4">
                        @foreach($chunk as $item)
                            @include('archive.magazine_item')
                        @endforeach
                    </div>
                    @if(count($magazines_chunks) == 1)
                        <br><br>
                        <div class="catside" align="center">
                            <h3><a href="{{ route('archive') }}">смотреть весь архив >>> </a></h3>
                        </div>
                    @endif
                @endif
            @endforeach
        @endif
    </div>
</div>

@if(count($magazines_chunks) > 1)
    @foreach($magazines_chunks as $chunk)
        <div class="site-section bg-light">
            <div class="container">
                <div class="row mb-4">
                    @foreach($chunk as $item)
                        @if(!$loop->first)
                            <div class="mb-lg-0 col-lg-4 col-md-4 col-md-6 col-xl-3" data-aos="fade-up"
                                 data-aos-delay="">
                                @include('archive.magazine_item')
                            </div>
                        @endif
                    @endforeach
                </div>

                @if($loop->last)
                    <br><br>
                    <div class="catside" align="center">
                        <h3><a href="{{ route('archive') }}">смотреть весь архив >>> </a></h3>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
@endif