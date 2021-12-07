@if ($paginator->hasPages())
    <div class="pagination">
        @if ($paginator->onFirstPage())
            <span class="btn btn-read-more left-arrow text-bold disabled">@lang('pagination.previous')</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="btn btn-read-more left-arrow text-bold">@lang('pagination.previous')</a>
        @endif
        <div>
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="text" aria-disabled="true">{{ $element }}</span>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="text active" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{$url}}" class="text">{{$page}}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-read-more text-bold">@lang('pagination.next')</a>
        @else
            <span class="btn btn-read-more text-bold disabled">@lang('pagination.next')</span>
        @endif

    </div>
@endif
