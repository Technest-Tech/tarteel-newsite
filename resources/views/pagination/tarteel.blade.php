@if ($paginator->hasPages())
    <nav class="admin-pagination" aria-label="Pagination">
        <p>
            Showing {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} of {{ $paginator->total() }}
        </p>

        {{-- Links keep the current search and status via withQueryString() on the paginator. --}}
        <ul>
            @if ($paginator->onFirstPage())
                <li class="is-disabled"><span aria-hidden="true">‹</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous page">‹</a></li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="is-disabled"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="is-active"><span aria-current="page">{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}" aria-label="Page {{ $page }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next page">›</a></li>
            @else
                <li class="is-disabled"><span aria-hidden="true">›</span></li>
            @endif
        </ul>
    </nav>
@endif
