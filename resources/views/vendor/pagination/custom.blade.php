@if ($paginator->hasPages())
    <nav class="pagination">
        {{-- Tombol Sebelumnya --}}
        @if ($paginator->onFirstPage())
            <span class="pagination-btn disabled">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-btn">&laquo;</a>
        @endif

        {{-- Nomor Halaman --}}
        @foreach ($elements as $element)
            {{-- Tanda "..." --}}
            @if (is_string($element))
                <span class="pagination-ellipsis">{{ $element }}</span>
            @endif

            {{-- Link Halaman --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination-btn active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Tombol Selanjutnya --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-btn">&raquo;</a>
        @else
            <span class="pagination-btn disabled">&raquo;</span>
        @endif
    </nav>
@endif
