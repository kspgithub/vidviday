<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{route('admin.dashboard')}}">
            <span class="align-middle">{{appName()}}</span>
        </a>

        <ul class="sidebar-nav">


            <li class="sidebar-header">
                @lang('Main')
            </li>

            <li class="sidebar-item {{routeActiveClass('admin.dashboard')}}">
                <a class="sidebar-link" href="{{route('admin.dashboard')}}">
                    <i class="align-middle" data-feather="sliders"></i> <span
                        class="align-middle">@lang('Dashboard')</span>
                </a>
            </li>
            @if(is_admin())
                <li class="sidebar-item {{routeActiveClass('admin.user*')}}">
                    <a data-bs-target="#users" data-bs-toggle="collapse"
                       class="sidebar-link {{routeActiveClass('admin.user*', '', 'collapsed')}}">
                        <i class="align-middle" data-feather="users"></i> <span
                            class="align-middle">@lang('Users')</span>
                    </a>
                    <ul id="users"
                        class="sidebar-dropdown list-unstyled collapse {{routeActiveClass('admin.user*', 'show', '')}}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{routeActiveClass('admin.user.index')}}">
                            <a class="sidebar-link"
                               href="{{route('admin.user.index')}}">@lang('Users List')</a>
                        </li>
                        <li class="sidebar-item {{routeActiveClass('admin.user.create')}}">
                            <a class="sidebar-link"
                               href="{{route('admin.user.create')}}">@lang('Create User')</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item {{routeActiveClass('admin.staff*')}}">
                    <a data-bs-target="#staff" data-bs-toggle="collapse"
                       class="sidebar-link {{routeActiveClass('admin.staff*', '', 'collapsed')}}">
                        <i class="align-middle" data-feather="user-plus"></i> <span
                            class="align-middle">@lang('Staff')</span>
                    </a>
                    <ul id="staff"
                        class="sidebar-dropdown list-unstyled collapse  {{routeActiveClass('admin.staff*', 'show', '')}}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{routeActiveClass('admin.staff.index')}}">
                            <a class="sidebar-link"
                               href="{{route('admin.staff.index')}}">@lang('Staff')</a>
                        </li>
                        <li class="sidebar-item {{routeActiveClass('admin.staff-type.index')}}">
                            <a class="sidebar-link"
                               href="{{route('admin.staff-type.index')}}">@lang('Staff Types')</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(is_tour_manager())
                <li class="sidebar-item {{routeActiveClass('admin.tour.*')}}">
                    <a class="sidebar-link"
                       href="{{route('admin.tour.index')}}">
                        <i class="align-middle" data-feather="map"></i>
                        <span class="align-middle">@lang('Tours')</span>
                    </a>
                </li>
            @endif

            @if(is_admin() || is_manager())

                <li class="sidebar-item {{routeActiveClass(['admin.tour*', 'admin.badge*', 'admin.direction*', 'admin.landing-place*'])}}">
                    <a data-bs-target="#tours" data-bs-toggle="collapse"
                       class="sidebar-link {{routeActiveClass('admin.tour*', '', 'collapsed')}}">
                        <i class="align-middle" data-feather="map"></i> <span class="align-middle">@lang('Tours')</span>
                    </a>
                    <ul id="tours"
                        class="sidebar-dropdown list-unstyled collapse {{routeActiveClass(['admin.tour*', 'admin.badge*', 'admin.direction*', 'admin.landing-place*'], 'show', '') }}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{routeActiveClass('admin.tour.*')}}">
                            <a class="sidebar-link"
                               href="{{route('admin.tour.index')}}">@lang('Tours')</a>
                        </li>
                        <li class="sidebar-item {{routeActiveClass('admin.badge.*')}}">
                            <a class="sidebar-link "
                               href="{{route('admin.badge.index')}}">@lang('Badges')</a>
                        </li>
                        <li class="sidebar-item {{routeActiveClass('admin.tour-group.*')}}">
                            <a class="sidebar-link"
                               href="{{route('admin.tour-group.index')}}">@lang('Categories')</a>
                        </li>
                        {{--                        <li class="sidebar-item {{routeActiveClass('admin.tour-subjects.*')}}">--}}
                        {{--                            <a class="sidebar-link "--}}
                        {{--                               href="{{route('admin.tour-subjects.index')}}">@lang('Subjects')</a>--}}
                        {{--                        </li>--}}
                        <li class="sidebar-item {{routeActiveClass('admin.direction.*')}}">
                            <a class="sidebar-link "
                               href="{{route('admin.direction.index')}}">@lang('Directions')</a>
                        </li>
                        <li class="sidebar-item {{routeActiveClass('admin.landing-place.*')}}">
                            <a class="sidebar-link "
                               href="{{route('admin.landing-place.index')}}">Місця посадки</a>
                        </li>
                        <li class="sidebar-item {{routeActiveClass('admin.tour-type.*')}}">
                            <a class="sidebar-link "
                               href="{{route('admin.tour-type.index')}}">@lang('Types')</a>
                        </li>
                        <li class="sidebar-item {{routeActiveClass('admin.popular-tours.*')}}">
                            <a class="sidebar-link "
                               href="{{route('admin.popular-tours.index')}}">@lang('Popular Tours')</a>
                        </li>
                    </ul>
                </li>
                <!-- -------------------------------------------------------------------------------------------------- --->
                <li class="sidebar-item {{routeActiveClass(['admin.country*', 'admin.region*', 'admin.district*', 'admin.city*'])}}">
                    <a data-bs-target="#location" data-bs-toggle="collapse"
                       class="sidebar-link {{routeActiveClass(['admin.country*', 'admin.region*', 'admin.district*', 'admin.city*'], '', 'collapsed')}}">
                        <i class="align-middle" data-feather="compass"></i> <span
                            class="align-middle">@lang('Cities')</span>
                    </a>
                    <ul id="location"
                        class="sidebar-dropdown list-unstyled collapse {{routeActiveClass(['admin.country*', 'admin.region*', 'admin.district*', 'admin.city*'], 'show', '')}}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{routeActiveClass('admin.country.*')}}">
                            <a class="sidebar-link"
                               href="{{route('admin.country.index')}}">@lang('Countries')</a>
                        </li>
                        <li class="sidebar-item {{routeActiveClass('admin.region.*')}}">
                            <a class="sidebar-link"
                               href="{{route('admin.region.index')}}">@lang('Regions')</a>
                        </li>
                        <li class="sidebar-item {{routeActiveClass('admin.district.*')}}">
                            <a class="sidebar-link"
                               href="{{route('admin.district.index')}}">@lang('Districts')</a>
                        </li>
                        <li class="sidebar-item {{routeActiveClass('admin.city.*')}}">
                            <a class="sidebar-link"
                               href="{{route('admin.city.index')}}">@lang('Cities')</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.place*')}}">
                    <a data-bs-target="#places" data-bs-toggle="collapse"
                       class="sidebar-link {{routeActiveClass('admin.place*', '', 'collapsed')}}">
                        <i class="align-middle" data-feather="map-pin"></i> <span
                            class="align-middle">@lang('Places')</span>
                    </a>
                    <ul id="places"
                        class="sidebar-dropdown list-unstyled collapse  {{routeActiveClass('admin.place*', 'show', '')}}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{routeActiveClass('admin.place.index')}}">
                            <a class="sidebar-link" href="{{route('admin.place.index')}}">@lang('List')</a>
                        </li>
                        <li class="sidebar-item {{routeActiveClass('admin.place.create')}}">
                            <a class="sidebar-link" href="{{route('admin.place.create')}}">@lang('Create')</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.event*')}}">
                    <a data-bs-target="#event" data-bs-toggle="collapse"
                       class="sidebar-link {{routeActiveClass('admin.event*', '', 'collapsed')}}">
                        <i class="align-middle" data-feather="calendar"></i> <span
                            class="align-middle">@lang('Events')</span>
                    </a>
                    <ul id="event"
                        class="sidebar-dropdown list-unstyled collapse  {{routeActiveClass('admin.event*', 'show', '')}}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{activeClass(routeActive('admin.event.*'))}}">
                            <a class="sidebar-link" href="{{route('admin.event.index')}}">
                                @lang('List')
                            </a>
                        </li>
                        <li class="sidebar-item {{activeClass(routeActive('admin.event-group.*'))}}">
                            <a class="sidebar-link" href="{{route('admin.event-group.index')}}">
                                @lang('Groups')
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.accommodation*')}}">
                    <a data-bs-target="#accommodation" data-bs-toggle="collapse"
                       class="sidebar-link {{routeActiveClass('admin.accommodation*', '', 'collapsed')}}">
                        <i class="align-middle" data-feather="home"></i> <span
                            class="align-middle">@lang('Accommodation')</span>
                    </a>
                    <ul id="accommodation"
                        class="sidebar-dropdown list-unstyled collapse  {{routeActiveClass('admin.accommodation*', 'show', '')}}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{routeActiveClass('admin.accommodation-type.*')}}">
                            <a class="sidebar-link"
                               href="{{route('admin.accommodation-type.index')}}">@lang('Room Types')</a>
                        </li>
                        <li class="sidebar-item {{routeActiveClass('admin.accommodation.*')}}">
                            <a class="sidebar-link"
                               href="{{route('admin.accommodation.index')}}">@lang('Accommodations')</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.food*')}}">
                    <a data-bs-target="#food" data-bs-toggle="collapse"
                       class="sidebar-link {{routeActiveClass('admin.food*', '', 'collapsed')}}">
                        <i class="align-middle" data-feather="coffee"></i> <span
                            class="align-middle">@lang('Food')</span>
                    </a>
                    <ul id="food"
                        class="sidebar-dropdown list-unstyled collapse  {{routeActiveClass('admin.food*', 'show', '')}}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{routeActiveClass('admin.food.index')}}">
                            <a class="sidebar-link" href="{{route('admin.food.index')}}">@lang('List')</a>
                        </li>
                        <li class="sidebar-item {{routeActiveClass('admin.food.create')}}">
                            <a class="sidebar-link" href="{{route('admin.food.create')}}">@lang('Create')</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item {{routeActiveClass('admin.ticket*')}}">
                    <a class="sidebar-link" href="{{route('admin.ticket.index')}}">
                        <i class="align-middle" data-feather="file"></i> <span
                            class="align-middle">@lang('Tickets')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.transport*')}}">
                    <a data-bs-target="#food" data-bs-toggle="collapse" class="sidebar-link">
                        <i class="align-middle" data-feather="truck"></i>
                        <span class="align-middle">@lang('Transport')</span>
                    </a>

                    <ul id="transport"
                        class="sidebar-dropdown list-unstyled collapse  {{routeActiveClass('admin.transport*', 'show', '')}}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{routeActiveClass('admin.transport.index')}}">
                            <a class="sidebar-link" href="{{route('admin.transport.index')}}">@lang('Transport')</a>
                        </li>
                        <li class="sidebar-item {{routeActiveClass('admin.transport_duration.index')}}">
                            <a class="sidebar-link" href="{{route('admin.transport_duration.index')}}">@lang('Transport durations')</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.vacancy*')}}">
                    <a class="sidebar-link" href="{{route('admin.vacancy.index')}}">
                        <i class="align-middle" data-feather="user-check"></i> <span
                            class="align-middle">@lang('Vacancies')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.practice*')}}">
                    <a class="sidebar-link" href="{{route('admin.practice.index')}}">
                        <i class="align-middle" data-feather="user-check"></i> <span
                            class="align-middle">@lang('Practices')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.course*')}}">
                    <a class="sidebar-link" href="{{route('admin.course.index')}}">
                        <i class="align-middle" data-feather="user-check"></i> <span
                            class="align-middle">@lang('Courses')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.finance*')}}">
                    <a data-bs-target="#finance" data-bs-toggle="collapse"
                       class="sidebar-link {{routeActiveClass('admin.finance*', '', 'collapsed')}}">
                        <i class="align-middle" data-feather="dollar-sign"></i> <span
                            class="align-middle">@lang('Finances')</span>
                    </a>
                    <ul id="finance"
                        class="sidebar-dropdown list-unstyled collapse  {{routeActiveClass('admin.finance*', 'show', '')}}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{activeClass(routeActive('admin.finance.index') && (int)request()->input('type_id', 1) === 1)}}">
                            <a class="sidebar-link" href="{{route('admin.finance.index', ['type_id'=>1])}}">У вартість
                                входять</a>
                        </li>
                        <li class="sidebar-item {{activeClass(routeActive('admin.finance.index') && (int)request()->input('type_id', 1) === 2)}}">
                            <a class="sidebar-link" href="{{route('admin.finance.index', ['type_id'=>2])}}">У вартість
                                не
                                входять</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item {{routeActiveClass('admin.discount*')}}">
                    <a class="sidebar-link" href="{{route('admin.discount.index')}}">
                        <i class="align-middle" data-feather="percent"></i> <span
                            class="align-middle">@lang('Discounts')</span>
                    </a>
                </li>

                <li class="sidebar-item {{routeActiveClass('admin.document*')}}">
                    <a class="sidebar-link" href="{{route('admin.document.index')}}">
                        <i class="align-middle" data-feather="file"></i> <span
                            class="align-middle">@lang('Documents')</span>
                    </a>
                </li>

                {{--            <li class="sidebar-item {{routeActiveClass('admin.order*')}}">--}}
                {{--                <a class="sidebar-link" href="{{route('admin.order.index')}}">--}}
                {{--                    <i class="align-middle" data-feather="shopping-cart"></i>--}}
                {{--                    <span class="align-middle">@lang('Orders')</span>--}}
                {{--                </a>--}}
                {{--            </li>--}}

            @endif

            @if(is_admin() || is_tour_manager() || is_duty_manager())
                <li class="sidebar-header">
                    @lang('CRM')
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.crm.client*')}}">
                    <a class="sidebar-link" href="{{route('admin.crm.client.index')}}">
                        <i class="align-middle" data-feather="users"></i>
                        <span class="align-middle">@lang('Clients')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.crm.schedule*')}}">
                    <a class="sidebar-link" href="{{route('admin.crm.schedule.index')}}">
                        <i class="align-middle" data-feather="calendar"></i>
                        <span class="align-middle">Виїзди</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.crm.order*')}}">
                    <a class="sidebar-link" href="{{route('admin.crm.order.index')}}">
                        <i class="align-middle" data-feather="shopping-cart"></i>
                        <span class="align-middle">Замовлення турів</span>
                        <x-alp.new-order-tours/>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.crm.corporate*')}}">
                    <a class="sidebar-link" href="{{route('admin.crm.corporate.index')}}">
                        <i class="align-middle" data-feather="shopping-cart"></i>
                        <span class="align-middle">Корпоративи</span>
                        <x-alp.new-corporates/>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.order-transport*')}}">
                    <a class="sidebar-link" href="{{route('admin.order-transport.index')}}">
                        <i class="align-middle" data-feather="truck"></i>
                        <span class="align-middle">@lang('Transport Rental')</span>
                        <x-alp.new-transport/>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.certificate*')}}">
                    <a class="sidebar-link" href="{{route('admin.certificate.index')}}">
                        <i class="align-middle" data-feather="shopping-cart"></i>
                        <span class="align-middle">@lang('Certificates')</span>
                        <x-alp.new-certificate/>
                    </a>
                </li>
            @endif
            <!-- CONTENT --------------------------------------------------------------------------------------- --->
            @if(is_admin() || is_manager())
                <li class="sidebar-header">
                    @lang('Content')
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.testimonial*')}}">
                    <a data-bs-target="#testimonials" data-bs-toggle="collapse"
                       class="sidebar-link {{routeActiveClass('admin.testimonial*', '', 'collapsed')}}">
                        <i class="align-middle" data-feather="message-square"></i> <span
                            class="align-middle">@lang('Testimonials')</span>
                    </a>
                    <ul id="testimonials"
                        class="sidebar-dropdown list-unstyled collapse  {{routeActiveClass('admin.testimonial*', 'show', '')}} {{routeActiveClass('admin.question_types*', 'show', '')}}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{routeActiveClass('admin.testimonial.index')}}">
                            <a class="sidebar-link"
                               href="{{route('admin.testimonial.index')}}">@lang('Testimonials')</a>
                        </li>
                        <li class="sidebar-item {{routeActiveClass('admin.question_types*')}}">
                            <a class="sidebar-link"
                               href="{{route('admin.question_types.index')}}">@lang('Question Types')</a>
                        </li>
                        <li class="sidebar-item {{routeActiveClass('admin.testimonial.questions')}}">
                            <a class="sidebar-link"
                               href="{{route('admin.testimonial.questions')}}">@lang('Questions')</a>
                        </li>
                        <li class="sidebar-item {{routeActiveClass('admin.testimonial.user_questions')}}">
                            <a class="sidebar-link"
                               href="{{route('admin.testimonial.user_questions')}}">@lang('User Questions')</a>
                        </li>
                        <li class="sidebar-item {{routeActiveClass('admin.testimonial.user_subscriptions')}}">
                            <a class="sidebar-link"
                               href="{{route('admin.testimonial.user_subscriptions')}}">@lang('User Subscriptions')</a>
                        </li>
                        <li class="sidebar-item {{routeActiveClass('admin.testimonial.agency_subscriptions')}}">
                            <a class="sidebar-link"
                               href="{{route('admin.testimonial.agency_subscriptions')}}">@lang('Agency Subscriptions')</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.wrong_requests*')}}">
                    <a class="sidebar-link" href="{{route('admin.wrong_requests.index')}}">
                        <i class="align-middle" data-feather="file-text"></i> <span
                            class="align-middle">@lang('Wrong requests')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.page*')}}">
                    <a class="sidebar-link" href="{{route('admin.page.index')}}">
                        <i class="align-middle" data-feather="file-text"></i> <span
                            class="align-middle">@lang('Site pages')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.site-menu*')}}">
                    <a class="sidebar-link" href="{{route('admin.site-menu.index')}}">
                        <i class="align-middle" data-feather="file-text"></i> <span
                            class="align-middle">@lang('Site menu')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.email-templates*')}}">
                    <a class="sidebar-link" href="{{route('admin.email-templates.index')}}">
                        <i class="align-middle" data-feather="file-text"></i> <span
                            class="align-middle">@lang('Email templates')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.contact.*')}}">
                    <a class="sidebar-link" href="{{route('admin.contact.edit')}}">
                        <i class="align-middle" data-feather="at-sign"></i> <span
                            class="align-middle">@lang('Contact')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.banner*')}}">
                    <a class="sidebar-link" href="{{route('admin.banner.index')}}">
                        <i class="align-middle" data-feather="image"></i> <span
                            class="align-middle">@lang('Banners')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.advertisement*')}}">
                    <a class="sidebar-link" href="{{route('admin.advertisement.index')}}">
                        <i class="align-middle" data-feather="rss"></i> <span
                            class="align-middle">@lang('Advertisements')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.popup_ads*')}}">
                    <a class="sidebar-link" href="{{route('admin.popup_ads.index')}}">
                        <i class="align-middle" data-feather="rss"></i> <span
                            class="align-middle">@lang('Popup Advertisements')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.faqitem.*')}}">
                    <a class="sidebar-link" href="{{route('admin.faqitem.index')}}">
                        <i class="align-middle" data-feather="help-circle"></i> <span
                            class="align-middle">@lang('FAQ')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.news.*')}}">
                    <a class="sidebar-link" href="{{route('admin.news.index')}}">
                        <i class="align-middle" data-feather="rss"></i> <span
                            class="align-middle">@lang('News')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.charity.*')}}">
                    <a class="sidebar-link" href="{{route('admin.charity.index')}}">
                        <i class="align-middle" data-feather="rss"></i> <span
                            class="align-middle">@lang('Charity')</span>
                    </a>
                </li>

                <li class="sidebar-item {{routeActiveClass('admin.post.*')}}">
                    <a class="sidebar-link" href="{{route('admin.post.index')}}">
                        <i class="align-middle" data-feather="rss"></i> <span
                            class="align-middle">@lang('Blog')</span>
                    </a>
                </li>

                <li class="sidebar-item {{routeActiveClass('admin.html-block.*')}}">
                    <a class="sidebar-link" href="{{route('admin.html-block.index')}}">
                        <i class="align-middle" data-feather="code"></i> <span
                            class="align-middle">@lang('Html Blocks')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.our-client.*')}}">
                    <a class="sidebar-link" href="{{route('admin.our-client.index')}}">
                        <i class="align-middle" data-feather="smile"></i> <span
                            class="align-middle">@lang('Our Clients')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.achievement.*')}}">
                    <a class="sidebar-link" href="{{route('admin.achievement.index')}}">
                        <i class="align-middle" data-feather="award"></i> <span
                            class="align-middle">@lang('Achievements')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.partner.*')}}">
                    <a class="sidebar-link" href="{{route('admin.partner.index')}}">
                        <i class="align-middle" data-feather="user-check"></i> <span
                            class="align-middle">@lang('Партнеры')</span>
                    </a>
                </li>
            @endif

            @if(is_admin())
                <li class="sidebar-header">
                    @lang('System')
                </li>

                <li class="sidebar-item {{routeActiveClass('admin.site-options*')}}">
                    <a class="sidebar-link" href="{{route('admin.site-options.index')}}">
                        <i class="align-middle" data-feather="settings"></i>
                        <span class="align-middle">@lang('Global settings')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.redirects*')}}">
                    <a class="sidebar-link" href="{{route('admin.redirects.index')}}">
                        <i class="align-middle" data-feather="settings"></i>
                        <span class="align-middle">@lang('Redirects')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('admin.translation*')}}">
                    <a class="sidebar-link" href="{{route('admin.translation.index')}}">
                        <i class="align-middle" data-feather="feather"></i>
                        <span class="align-middle">@lang('Translations')</span>
                    </a>
                </li>
                <li class="sidebar-item {{routeActiveClass('log-viewer*')}}">
                    <a href="#logs" data-bs-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle" data-feather="list"></i> <span
                            class="align-middle">@lang('Server Logs')</span>
                    </a>
                    <ul id="logs" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('log-viewer::dashboard')}}">@lang('Dashboard')</a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('log-viewer::logs.list')}}">@lang('Logs')</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>

        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                {{--                <strong class="d-inline-block mb-2">Upgrade to Pro</strong>--}}
                {{--                <div class="mb-3 text-sm">--}}
                {{--                    Are you looking for more components? Check out our premium version.--}}
                {{--                </div>--}}
                {{--                <div class="d-grid">--}}
                {{--                    <a href="upgrade-to-pro.html" class="btn btn-primary">Upgrade to Pro</a>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
</nav>
