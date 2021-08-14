<div class="btn-group my-4">
    <a class="btn btn-outline-primary {{routeActiveClass('admin.home-page-banner.edit')}}" href="{{route('admin.home-page-banner.edit', $homePageBanner)}}">@lang('Basic')</a>
    <a class="btn btn-outline-primary {{routeActiveClass('admin.home-page-banner.picture.*')}}" href="{{route('admin.home-page-banner.picture.index', $homePageBanner)}}">@lang('Pictures')</a>
</div>
