



@if ($paginator->hasPages())

    <div class="pagination-block">

        <nav aria-label="Page navigation example">
            <ul class="pagination">

                @if ($paginator->onFirstPage())
                    <li class="page-item prev disabled">
                        <a class="page-link">
                            <span class="iconify" data-icon="akar-icons:chevron-left" data-inline="false"></span>
                        </a>
                    </li>
                @else
                    <li class="page-item prev">
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link">
                            <span class="iconify" data-icon="akar-icons:chevron-left" data-inline="false"></span>
                        </a>
                    </li>
                @endif



                    @foreach ($elements as $element)

                        @if (is_string($element))
                            <li class="page-item disabled"><span>{{ $element }}</span></li>
                        @endif



                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="active page-item"><span>{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}" >{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                @if ($paginator->hasMorePages())
                    <li class="page-item next">
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"  class="page-link">
                            <span class="iconify" data-icon="akar-icons:chevron-right" data-inline="false"></span>
                        </a>
                    </li>
                @else
                    <li class="page-item next disabled">

                        <a class="disabled page-link">
                            <span class="iconify" data-icon="akar-icons:chevron-right" data-inline="false"></span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif

