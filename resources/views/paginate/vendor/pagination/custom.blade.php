

@if ($paginator->hasPages())

    <div class="post-pagination">

        <nav aria-label="Page navigation example">
            <ul class="pagination">

                @if ($paginator->onFirstPage())

                    <a  class="btn btn-read-more left-arrow text-bold">{{ __("Назад") }}</a>

                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-read-more left-arrow text-bold">{{ __("Назад") }}</a>
                @endif


                    @foreach ($elements as $element)

                        @if (is_string($element))
                            <li class="text disabled"><span>{{ $element }}</span></li>
                        @endif



                        @if (is_array($element))
                            @foreach ($element as $page => $url)

                                @if ($page == $paginator->currentPage())

                                    <li class="active text"><span>{{ $page }}</span></li>
                                @else
                                    @if($loop->first)<span class="text">...</span>@endif
                                    <a class="text" href="{{ $url }}" >{{ $page }}</a>
                                    <a class="text" href="{{ $url }}" >{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach


                @if ($paginator->hasMorePages())

                   <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-read-more text-bold">{{ __("Вперед") }}</a>

                @else
                   <a  class="btn btn-read-more text-bold">{{ __("Вперед") }}</a>
                @endif
            </ul>
        </nav>
    </div>
@endif
