<ul class="nav nav-pills mb-4">
    <li class="nav-item">
        <a class="nav-link {{routeActiveClass('admin.tour.edit')}}" href="{{route('admin.tour.edit', $tour)}}">@lang('Basic')</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{routeActiveClass('admin.tour.picture.*')}}" href="{{route('admin.tour.picture.index', $tour)}}">@lang('Pictures')</a>
    </li>
</ul>
