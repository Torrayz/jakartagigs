@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" style="display: flex; justify-content: center; align-items: center; gap: 1rem;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="btn btn-outline" style="opacity: 0.5; cursor: not-allowed;">
                <i class="fas fa-chevron-left"></i> Previous
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-outline">
                <i class="fas fa-chevron-left"></i> Previous
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div style="display: flex; gap: 0.5rem;">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span style="color: #ccc; padding: 0.5rem;">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="btn btn-primary" style="min-width: 40px;">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="btn btn-outline" style="min-width: 40px;">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-outline">
                Next <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <span class="btn btn-outline" style="opacity: 0.5; cursor: not-allowed;">
                Next <i class="fas fa-chevron-right"></i>
            </span>
        @endif
    </nav>
@endif
