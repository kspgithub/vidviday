<div class="list-group">
    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.edit')}}"
       href="{{route('admin.tour.edit', $tour)}}">@lang('Basic Information')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.picture.*')}}"
       href="{{route('admin.tour.picture.index', $tour)}}">@lang('Pictures')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.places.*')}}"
       href="{{route('admin.tour.places.index', $tour)}}">@lang('Places')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.schedule.*')}}"
       href="{{route('admin.tour.schedule.index', $tour)}}">@lang('Schedule')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.include.*')}}"
       href="{{route('admin.tour.include.index', $tour)}}">@lang('Finance')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.plan.*')}}"
       href="{{route('admin.tour.plan.index', $tour)}}">@lang('Plan')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.food.*')}}"
       href="{{route('admin.tour.food.index', $tour)}}">@lang('Food')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.accomm.*')}}"
       href="{{route('admin.tour.accomm.index', $tour)}}">@lang('Accommodation')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.discount.*')}}"
       href="{{route('admin.tour.discount.index', $tour)}}">@lang('Discounts')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.calc')}}"
       href="{{route('admin.tour.calc', $tour)}}">@lang('Calculator')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.ticket.*')}}"
       href="{{route('admin.tour.ticket.index', $tour)}}">@lang('Tickets')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.faq')}}"
       href="{{route('admin.tour.faq', $tour)}}">@lang('Question about the tour')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.questions')}}"
       href="{{route('admin.tour.questions', $tour)}}">@lang('Users questions')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.testimonials')}}"
       href="{{route('admin.tour.testimonials', $tour)}}">@lang('Testimonials')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.hutsul-fun.*')}}"
       href="{{route('admin.tour.hutsul-fun.index', $tour)}}">@lang('Hutsul Fun')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.similar.*')}}"
       href="{{route('admin.tour.similar.index', $tour)}}">@lang('Similar Tours')</a>
</div>
