<div class="btn-group my-4">
    <a class="btn btn-outline-primary {{routeActiveClass('admin.article.edit')}}" href="{{route('admin.article.edit', $article)}}">@lang('Basic')</a>
    <a class="btn btn-outline-primary {{routeActiveClass('admin.article.picture.*')}}" href="{{route('admin.article.picture.index', $article)}}">@lang('Pictures')</a>
</div>
