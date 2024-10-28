@if($paginator instanceof \Illuminate\Pagination\LengthAwarePaginator
    && $paginator->hasPages()
    && $paginator->lastPage() > 1)
        <?
        /** @var \Illuminate\Pagination\LengthAwarePaginator $paginator */ ?>

        <?php
        // config
        $link_limit = 7; // maximum number of links (a little bit inaccurate, but will be ok for now)
        $half_total_links = floor($link_limit / 2);
        $from = $paginator->currentPage() - $half_total_links;
        $to = $paginator->currentPage() + $half_total_links;
        if ($paginator->currentPage() < $half_total_links) {
            $to += $half_total_links - $paginator->currentPage();
        }
        if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
            $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
        }
        ?>

    @if ($paginator->lastPage() > 1)
        <ul class="pagination justify-content-center">
            @if ($paginator->currentPage() > 1)
                <li class="page-item {{ $paginator->previousPageUrl() ? '' : 'disabled' }}">
                    <a href="{{ $paginator->previousPageUrl() }}" class="page-link" aria-label="Назад">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            @endif

            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                @if ($from < $i && $i < $to)
                    <li class="page-item {{ $i == $paginator->currentPage() ? 'active' : '' }}">
                        <a class="page-link"
                           href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor

            @if($to < $paginator->lastPage())
                <li class="page-item">
                    <a class="page-link"
                       href="{{ $paginator->url($paginator->lastPage()) }}" title="Последняя страница">...</a>
                </li>
            @endif

            @if ($paginator->currentPage() < $paginator->lastPage())
                <li class="page-item {{ $paginator->nextPageUrl() ? '' : 'disabled' }}" aria-label="Next">
                    <a href="{{ $paginator->nextPageUrl() }}" class="page-link" aria-label="Вперёд">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            @endif
        </ul>
    @endif
@endif


