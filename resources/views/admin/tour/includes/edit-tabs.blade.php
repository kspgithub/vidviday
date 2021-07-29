<div class="btn-group my-4">
    <a class="btn btn-outline-primary {{routeActiveClass('admin.tour.edit')}}" href="{{route('admin.tour.edit', $tour)}}">@lang('Basic')</a>
    <a class="btn btn-outline-primary {{routeActiveClass('admin.tour.picture.*')}}" href="{{route('admin.tour.picture.index', $tour)}}">@lang('Pictures')</a>
    <a class="btn btn-outline-primary {{routeActiveClass('admin.tour.group.*')}}" href="{{route('admin.tour.group.index', $tour)}}">@lang('Groups')</a>
    <a class="btn btn-outline-primary {{routeActiveClass('admin.tour.subject.*')}}" href="{{route('admin.tour.subject.index', $tour)}}">@lang('Subjects')</a>
    <a class="btn btn-outline-primary {{routeActiveClass('admin.tour.type.*')}}" href="{{route('admin.tour.type.index', $tour)}}">@lang('Types')</a>
    <a class="btn btn-outline-primary {{routeActiveClass('admin.tour.direction.*')}}" href="{{route('admin.tour.direction.index', $tour)}}">@lang('Directions')</a>
    <a class="btn btn-outline-primary {{routeActiveClass('admin.tour.schedule.*')}}" href="{{route('admin.tour.schedule.index', $tour)}}">@lang('Schedules')</a>
</div>
