<ul class="bread-crumbs" itemscope itemtype="https://schema.org/BreadcrumbList">
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="{{ route('home') }}" itemprop="item">
            <span itemprop="name">{{ __("Home") }}</span>
        </a>
    </li>
    <li>
        <span>—</span>
    </li>
    @if(isset($title))
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a href="{{ route('blog.index') }}" itemprop="item">
                <span itemprop="name">{{ __("Blog") }}</span>
            </a>
        </li>
        <li>
            <span>—</span>
        </li>
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <span itemprop="name">{{ $title }}</span>
        </li>
    @else
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <span itemprop="name">{{ __("Blog") }}</span>
        </li>
    @endif
</ul>
