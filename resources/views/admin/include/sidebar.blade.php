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


            <li class="sidebar-item {{routeActiveClass('admin.user*')}}">
                <a data-bs-target="#users" data-bs-toggle="collapse"
                   class="sidebar-link {{routeActiveClass('admin.user*', '', 'collapsed')}}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">@lang('Users')</span>
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


            <li class="sidebar-item {{routeActiveClass('admin.tour*')}}">
                <a data-bs-target="#tours" data-bs-toggle="collapse"
                   class="sidebar-link {{routeActiveClass('admin.tour*', '', 'collapsed')}}">
                    <i class="align-middle" data-feather="map"></i> <span class="align-middle">@lang('Tours')</span>
                </a>
                <ul id="tours"
                    class="sidebar-dropdown list-unstyled collapse {{routeActiveClass(['admin.tour*', 'admin.badge*', 'admin.direction*'], 'show', '') }}"
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
                           href="{{route('admin.tour-group.index')}}">@lang('Groups')</a>
                    </li>
                    <li class="sidebar-item {{routeActiveClass('admin.tour-subjects.*')}}">
                        <a class="sidebar-link "
                           href="{{route('admin.tour-subjects.index')}}">@lang('Subjects')</a>
                    </li>
                    <li class="sidebar-item {{routeActiveClass('admin.direction.*')}}">
                        <a class="sidebar-link "
                           href="{{route('admin.direction.index')}}">@lang('Directions')</a>
                    </li>
                    <li class="sidebar-item {{routeActiveClass('admin.tour-type.*')}}">
                        <a class="sidebar-link "
                           href="{{route('admin.tour-type.index')}}">@lang('Types')</a>
                    </li>
                </ul>
            </li>
            <!-- -------------------------------------------------------------------------------------------------- --->
            <li class="sidebar-item {{routeActiveClass('admin.location*')}}">
                <a data-bs-target="#location" data-bs-toggle="collapse"
                   class="sidebar-link {{routeActiveClass('admin.location*', '', 'collapsed')}}">
                    <i class="align-middle" data-feather="compass"></i> <span
                        class="align-middle">@lang('Cities')</span>
                </a>
                <ul id="location"
                    class="sidebar-dropdown list-unstyled collapse {{routeActiveClass('admin.location*', 'show', '')}}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item {{routeActiveClass('admin.country.index')}}">
                        <a class="sidebar-link"
                           href="{{route('admin.country.index')}}">@lang('Countries')</a>
                    </li>
                    <li class="sidebar-item {{routeActiveClass('admin.region.index')}}">
                        <a class="sidebar-link"
                           href="{{route('admin.region.index')}}">@lang('Regions')</a>
                    </li>
                    <li class="sidebar-item {{routeActiveClass('admin.city.index')}}">
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
                    <li class="sidebar-item {{routeActiveClass('admin.place.create')}}">
                        <a class="sidebar-link"
                           href="{{route('admin.place.create')}}">@lang('Create place')</a>
                    </li>
                    <li class="sidebar-item {{routeActiveClass('admin.place.index')}}">
                        <a class="sidebar-link"
                           href="{{route('admin.place.index')}}">@lang('Places List')</a>
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
                           href="{{route('admin.accommodation-type.index')}}">@lang('Accommodation Types')</a>
                    </li>
                    <li class="sidebar-item {{routeActiveClass('admin.accommodation.*')}}">
                        <a class="sidebar-link"
                           href="{{route('admin.accommodation.index')}}">@lang('Accommodations')</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item" {{routeActiveClass('admin.ticket*')}}>
                <a class="sidebar-link" href="{{route('admin.ticket.index')}}">
                    <i class="align-middle" data-feather="file"></i> <span
                        class="align-middle">@lang('Tickets')</span>
                </a>
            </li>
            <li class="sidebar-item" {{routeActiveClass('admin.transport*')}}>
                <a class="sidebar-link" href="{{route('admin.transport.index')}}">
                    <i class="align-middle" data-feather="truck"></i> <span
                        class="align-middle">@lang('Transport')</span>
                </a>
            </li>
            <li class="sidebar-item" {{routeActiveClass('admin.vacancy*')}}>
                <a class="sidebar-link" href="{{route('admin.vacancy.index')}}">
                    <i class="align-middle" data-feather="user-check"></i> <span
                        class="align-middle">@lang('Vacancies')</span>
                </a>
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

            <li class="sidebar-item d-none {{routeActiveClass('admin.event*')}}">
                <a data-bs-target="#events" data-bs-toggle="collapse"
                   class="sidebar-link {{routeActiveClass('admin.event*', '', 'collapsed')}}">
                    <i class="align-middle" data-feather="calendar"></i> <span
                        class="align-middle">@lang('Events')</span>
                </a>
                <ul id="events"
                    class="sidebar-dropdown list-unstyled collapse  {{routeActiveClass('admin.event*', 'show', '')}}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item {{routeActiveClass('admin.event.*')}}">
                        <a class="sidebar-link"
                           href="{{route('admin.event.index')}}">@lang('Events')</a>
                    </li>
                    <li class="sidebar-item {{routeActiveClass('admin.event-group.*')}}">
                        <a class="sidebar-link"
                           href="{{route('admin.event-group.index')}}">@lang('Event Groups')</a>
                    </li>
                    <li class="sidebar-item {{routeActiveClass('admin.direction.*')}}">
                        <a class="sidebar-link "
                           href="{{route('admin.direction.index')}}">@lang('Event Directions')</a>
                    </li>
                    <li class="sidebar-item {{routeActiveClass('admin.event-item.*')}}">
                        <a class="sidebar-link "
                           href="{{route('admin.event-item.index')}}">@lang('Event Items')</a>
                    </li>
                </ul>
            </li>

            <!-- CONTENT --------------------------------------------------------------------------------------- --->
            <li class="sidebar-header">
                @lang('Content')
            </li>
            <li class="sidebar-item {{routeActiveClass('admin.page*')}}">
                <a class="sidebar-link" href="{{route('admin.page.index')}}">
                    <i class="align-middle" data-feather="file-text"></i> <span
                        class="align-middle">@lang('Site pages')</span>
                </a>
            </li>
            <li class="sidebar-item {{routeActiveClass('admin.contact.*')}}">
                <a class="sidebar-link" href="{{('admin/contact/1/edit')}}">
                    <i class="align-middle" data-feather="at-sign"></i> <span
                        class="align-middle">@lang('Contact')</span>
                </a>
            </li>
            <li class="sidebar-item {{routeActiveClass('admin.home-page-banner*')}}">
                <a class="sidebar-link" href="{{route('admin.home-page-banner.index')}}">
                    <i class="align-middle" data-feather="image"></i> <span
                        class="align-middle">@lang('Banners')</span>
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
            <li class="sidebar-item {{routeActiveClass('admin.html-block.*')}}">
                <a class="sidebar-link" href="{{route('admin.html-block.index')}}">
                    <i class="align-middle" data-feather="code"></i> <span
                        class="align-middle">@lang('Html Blocks')</span>
                </a>
            </li>

            <li class="sidebar-header">
                @lang('System')
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
