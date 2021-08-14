<div class="btn-group my-4">
    <a class="btn btn-outline-primary {{routeActiveClass('admin.event.edit')}}" href="{{route('admin.event.edit', $event)}}">@lang('Basic')</a>
    <a class="btn btn-outline-primary {{routeActiveClass('admin.event.picture.*')}}" href="{{route('admin.event.picture.index', $event)}}">@lang('Pictures')</a>
    <a class="btn btn-outline-primary {{routeActiveClass('admin.event.group.*')}}" href="{{route('admin.event.group.index', $event)}}">@lang('Groups')</a>
    <a class="btn btn-outline-primary {{routeActiveClass('admin.event.direction.*')}}" href="{{route('admin.event.direction.index', $event)}}">@lang('Directions')</a>
</div>
