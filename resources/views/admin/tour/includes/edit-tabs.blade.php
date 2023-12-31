<div class="list-group mb-2">
    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.edit')}}"
       href="{{route('admin.tour.edit', $tour)}}">@lang('Basic Information')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.voting.index')}}"
       href="{{route('admin.tour.voting.index', $tour)}}">@lang('Voting')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.corporate_includes.index')}}"
       href="{{route('admin.tour.corporate_includes.index', $tour)}}">@lang('Corporate includes')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.picture.*')}}"
       href="{{route('admin.tour.picture.index', $tour)}}">@lang('Pictures')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.plan.*')}}"
       href="{{route('admin.tour.plan.index', $tour)}}">@lang('Plan')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.landing.*')}}"
       href="{{route('admin.tour.landing.index', $tour)}}">@lang('Місця посадки')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.places.*')}}"
       href="{{route('admin.tour.places.index', $tour)}}">@lang('Places')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.schedule.*')}}"
       href="{{route('admin.tour.schedule.index', $tour)}}">@lang('Schedule')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.finance.*')}}"
       href="{{route('admin.tour.finance.index', $tour)}}">@lang('Finance')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.discount.*')}}"
       href="{{route('admin.tour.discount.index', $tour)}}">@lang('Discounts')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.ticket.*')}}"
       href="{{route('admin.tour.ticket.index', $tour)}}">@lang('Tickets')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.hutsul-fun.*')}}"
       href="{{route('admin.tour.hutsul-fun.index', $tour)}}">@lang('Hutsul Fun')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.transport.*')}}"
       href="{{route('admin.tour.transport.index', $tour)}}">@lang('Transport')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.accomm.*')}}"
       href="{{route('admin.tour.accomm.index', $tour)}}">@lang('Accommodation')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.food.*')}}"
       href="{{route('admin.tour.food.index', $tour)}}">@lang('Food')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.calc')}}"
       href="{{route('admin.tour.calc', $tour)}}">@lang('Calculator')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.faq')}}"
       href="{{route('admin.tour.faq', $tour)}}">@lang('Question about the tour')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.questions')}}"
       href="{{route('admin.tour.questions', $tour)}}">@lang('Users questions')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.testimonials')}}"
       href="{{route('admin.tour.testimonials', $tour)}}">@lang('Testimonials')</a>

    <a class="list-group-item list-group-item-action {{routeActiveClass('admin.tour.similar.*')}}"
       href="{{route('admin.tour.similar.index', $tour)}}">@lang('Similar Tours')</a>
</div>

@if(!empty($tour->url))
    <div class="list-group">
        <a class="list-group-item list-group-item-action d-flex align-items-center" target="_blank"
           href="{{$tour->url}}">
            <span>Переглянути</span>
            <i class="fas fa-external-link-alt ms-auto"></i>
        </a>
    </div>
@endif
