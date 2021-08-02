<div class="btn-group my-4">
    <a class="btn btn-outline-primary {{routeActiveClass('admin.news.edit')}}" href="{{route('admin.news.edit', $news)}}">@lang('Basic')</a>
    <a class="btn btn-outline-primary {{routeActiveClass('admin.news.picture.*')}}" href="{{route('admin.news.picture.index', $news)}}">@lang('Pictures')</a>
</div>
