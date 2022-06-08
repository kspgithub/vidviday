<ul class="bread-crumbs">
    <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
        <a href="{{ route('home') }}" itemprop="url">
            <span itemprop="title">{{ __("Home") }}</span>
        </a>
    </li>
    <li>
        <span>—</span>
    </li>
    @if(isset($title))
        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
            <a href="{{ route('news.index') }}" itemprop="url">
                <span itemprop="title">{{ __("Новини") }}</span>
            </a>
        </li>
        <li>
            <span>—</span>
        </li>
        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
            <span itemprop="title">{{ $title }}</span>
        </li>
    @else
        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
            <span itemprop="title">{{ __("Новини") }}</span>
        </li>
    @endif
</ul>
