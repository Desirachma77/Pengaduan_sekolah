@if ($paginator->hasPages())
<div class="pagination">

    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <button disabled>&lt;</button>
    @else
        <a href="{{ $paginator->previousPageUrl() }}">
            <button>&lt;</button>
        </a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_array($element))
            @foreach ($element as $page => $url)
                <a href="{{ $url }}">
                    <button class="{{ $page == $paginator->currentPage() ? 'active' : '' }}">
                        {{ $page }}
                    </button>
                </a>
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}">
            <button>&gt;</button>
        </a>
    @else
        <button disabled>&gt;</button>
    @endif

</div>
@endif
