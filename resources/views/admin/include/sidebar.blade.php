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
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">@lang('Dashboard')</span>
                </a>
            </li>

            <li class="sidebar-item {{routeActiveClass('admin.discount*')}}">
                <a data-bs-target="#discount" data-bs-toggle="collapse" class="sidebar-link {{routeActiveClass('admin.discount*', '', 'collapsed')}}">
                    <i class="align-middle" data-feather="discount"></i> <span class="align-middle">@lang('Discounts')</span>
                </a>
                <ul id="discount" class="sidebar-dropdown list-unstyled collapse {{routeActiveClass('admin.discount*', 'show', '')}}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{routeActiveClass('admin.discount.index')}}"><a class="sidebar-link" href="{{route('admin.discount.index')}}">@lang('Discount List')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.discount.create')}}"><a class="sidebar-link" href="{{route('admin.discount.create')}}">@lang('Create Discount')</a></li>
                </ul>
            </li>

            <li class="sidebar-item {{routeActiveClass('admin.document*')}}">
                <a data-bs-target="#document" data-bs-toggle="collapse" class="sidebar-link {{routeActiveClass('admin.document*', '', 'collapsed')}}">
                    <i class="align-middle" data-feather="file"></i> <span class="align-middle">@lang('Documents')</span>
                </a>
                <ul id="document" class="sidebar-dropdown list-unstyled collapse {{routeActiveClass('admin.document*', 'show', '')}}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{routeActiveClass('admin.document.index')}}"><a class="sidebar-link" href="{{route('admin.document.index')}}">@lang('Document List')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.document.create')}}"><a class="sidebar-link" href="{{route('admin.document.create')}}">@lang('Create Document')</a></li>
                </ul>
            </li>

            <li class="sidebar-item {{routeActiveClass('admin.user*')}}">
                <a data-bs-target="#users" data-bs-toggle="collapse" class="sidebar-link {{routeActiveClass('admin.user*', '', 'collapsed')}}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">@lang('Users')</span>
                </a>
                <ul id="users" class="sidebar-dropdown list-unstyled collapse {{routeActiveClass('admin.user*', 'show', '')}}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{routeActiveClass('admin.user.index')}}"><a class="sidebar-link" href="{{route('admin.user.index')}}">@lang('Users List')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.user.create')}}"><a class="sidebar-link" href="{{route('admin.user.create')}}">@lang('Create User')</a></li>
                </ul>
            </li>

            <li class="sidebar-item {{routeActiveClass('admin.ticket*')}}">
                <a data-bs-target="#ticket" data-bs-toggle="collapse" class="sidebar-link {{routeActiveClass('admin.ticket*', '', 'collapsed')}}">
                    <i class="align-middle" data-feather="file"></i> <span class="align-middle">@lang('Tickets')</span>
                </a>
                <ul id="ticket" class="sidebar-dropdown list-unstyled collapse {{routeActiveClass('admin.ticket*', 'show', '')}}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{routeActiveClass('admin.ticket.index')}}"><a class="sidebar-link" href="{{route('admin.ticket.index')}}">@lang('List')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.ticket.create')}}"><a class="sidebar-link" href="{{route('admin.ticket.create')}}">@lang('Create')</a></li>
                </ul>
            </li>

            <li class="sidebar-item {{routeActiveClass('admin.tour*')}}">
                <a data-bs-target="#tours" data-bs-toggle="collapse" class="sidebar-link {{routeActiveClass('admin.tour*', '', 'collapsed')}}">
                    <i class="align-middle" data-feather="map"></i> <span class="align-middle">@lang('Tours')</span>
                </a>
                <ul id="tours" class="sidebar-dropdown list-unstyled collapse {{routeActiveClass(['admin.tour*', 'admin.badge*', 'admin.direction*'], 'show', '') }}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{routeActiveClass('admin.tour.*')}}"><a class="sidebar-link" href="{{route('admin.tour.index')}}">@lang('Tours')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.badge.*')}}"><a class="sidebar-link " href="{{route('admin.badge.index')}}">@lang('Badges')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.tour-group.*')}}"><a class="sidebar-link" href="{{route('admin.tour-group.index')}}">@lang('Groups')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.tour-subjects.*')}}"><a class="sidebar-link " href="{{route('admin.tour-subjects.index')}}">@lang('Subjects')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.direction.*')}}"><a class="sidebar-link " href="{{route('admin.direction.index')}}">@lang('Directions')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.tour-type.*')}}"><a class="sidebar-link " href="{{route('admin.tour-type.index')}}">@lang('Types')</a></li>
                </ul>
            </li>
            <!-- -------------------------------------------------------------------------------------------------- --->
            <li class="sidebar-item {{routeActiveClass('admin.location*')}}">
                <a data-bs-target="#location" data-bs-toggle="collapse" class="sidebar-link {{routeActiveClass('admin.location*', '', 'collapsed')}}">
                    <i class="align-middle" data-feather="compass"></i> <span class="align-middle">@lang('Cities')</span>
                </a>
                <ul id="location" class="sidebar-dropdown list-unstyled collapse {{routeActiveClass('admin.location*', 'show', '')}}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{routeActiveClass('admin.country.index')}}"><a class="sidebar-link" href="{{route('admin.country.index')}}">@lang('Countries')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.region.index')}}"><a class="sidebar-link" href="{{route('admin.region.index')}}">@lang('Regions')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.city.index')}}"><a class="sidebar-link" href="{{route('admin.city.index')}}">@lang('Cities')</a></li>
                </ul>
            </li>
            <li class="sidebar-item {{routeActiveClass('admin.place*')}}">
                <a data-bs-target="#places" data-bs-toggle="collapse" class="sidebar-link {{routeActiveClass('admin.place*', '', 'collapsed')}}">
                    <i class="align-middle" data-feather="map-pin"></i> <span class="align-middle">@lang('Places')</span>
                </a>
                <ul id="places" class="sidebar-dropdown list-unstyled collapse  {{routeActiveClass('admin.place*', 'show', '')}}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{routeActiveClass('admin.place.create')}}"><a class="sidebar-link" href="{{route('admin.place.create')}}">@lang('Create place')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.place.index')}}"><a class="sidebar-link" href="{{route('admin.place.index')}}">@lang('Places List')</a></li>
                </ul>
            </li>
            <li class="sidebar-item {{routeActiveClass('admin.accommodation*')}}">
                <a data-bs-target="#accommodation" data-bs-toggle="collapse" class="sidebar-link {{routeActiveClass('admin.accommodation*', '', 'collapsed')}}">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">@lang('Accommodation')</span>
                </a>
                <ul id="accommodation" class="sidebar-dropdown list-unstyled collapse  {{routeActiveClass('admin.accommodation*', 'show', '')}}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{routeActiveClass('admin.accommodation-type.*')}}"><a class="sidebar-link" href="{{route('admin.accommodation-type.index')}}">@lang('Accommodation Types')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.accommodation.*')}}"><a class="sidebar-link" href="{{route('admin.accommodation.index')}}">@lang('Accommodations')</a></li>
                </ul>
            </li>


            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.transport.index')}}">
                    <i class="align-middle" data-feather="truck"></i> <span class="align-middle">@lang('Transport')</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.vacancy.index')}}">
                    <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">@lang('Vacancies')</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.staff.index')}}">
                    <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">@lang('Staff')</span>
                </a>
            </li>

            <!-- -------------------------------------------------------------------------------------------------- --->
            <li class="sidebar-header">
                @lang('Content')
            </li>
            <li class="sidebar-item {{routeActiveClass('admin.page*')}}">
                <a class="sidebar-link" href="{{route('admin.page.index')}}">
                    <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">@lang('Site pages')</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.faqitem.index')}}">
                    <i class="align-middle" data-feather="help-circle"></i> <span class="align-middle">@lang('FAQ')</span>
                </a>
            </li>
            <li class="sidebar-item {{routeActiveClass('admin.news*')}}">
                <a data-bs-target="#news" data-bs-toggle="collapse" class="sidebar-link {{routeActiveClass('admin.news*', '', 'collapsed')}}">
                    <i class="align-middle" data-feather="rss"></i> <span class="align-middle">@lang('News')</span>
                </a>
                <ul id="news" class="sidebar-dropdown list-unstyled collapse {{routeActiveClass('admin.news*', 'show', '')}}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{routeActiveClass('admin.news.index')}}"><a class="sidebar-link" href="{{route('admin.news.index')}}">@lang('News List')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.news.create')}}"><a class="sidebar-link" href="{{route('admin.news.create')}}">@lang('Create News')</a></li>
                </ul>
            </li>
            <li class="sidebar-item {{routeActiveClass('admin.html-block*')}}">
                <a data-bs-target="#html-block" data-bs-toggle="collapse" class="sidebar-link {{routeActiveClass('admin.html-block*', '', 'collapsed')}}">
                    <i class="align-middle" data-feather="code"></i> <span class="align-middle">@lang('Html Block')</span>
                </a>
                <ul id="html-block" class="sidebar-dropdown list-unstyled collapse {{routeActiveClass('admin.html-block*', 'show', '')}}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{routeActiveClass('admin.html-block.index')}}"><a class="sidebar-link" href="{{route('admin.html-block.index')}}">@lang('Html Blocks List')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.html-block.create')}}"><a class="sidebar-link" href="{{route('admin.html-block.create')}}">@lang('Create Html Block')</a></li>
                </ul>
            </li>
            <li class="sidebar-header">
                @lang('System')
            </li>

            <li class="sidebar-item {{routeActiveClass('admin.translation*')}}">
                <a class="sidebar-link" href="{{route('admin.translation.index')}}">
                    <i class="align-middle" data-feather="feather"></i> <span class="align-middle">@lang('Translations')</span>
                </a>
            </li>
            <li class="sidebar-item {{routeActiveClass('log-viewer*')}}">
                <a href="#logs" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">@lang('Server Logs')</span>
                </a>
                <ul id="logs" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('log-viewer::dashboard')}}">@lang('Dashboard')</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('log-viewer::logs.list')}}">@lang('Logs')</a></li>
                </ul>
            </li>


{{--            <li class="sidebar-item">--}}
{{--                <a class="sidebar-link" href="pages-profile.html">--}}
{{--                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="sidebar-item">--}}
{{--                <a class="sidebar-link" href="pages-sign-in.html">--}}
{{--                    <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Sign In</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="sidebar-item">--}}
{{--                <a class="sidebar-link" href="pages-sign-up.html">--}}
{{--                    <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Sign Up</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="sidebar-item">--}}
{{--                <a class="sidebar-link" href="pages-blank.html">--}}
{{--                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Blank</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="sidebar-header">--}}
{{--                Tools & Components--}}
{{--            </li>--}}

{{--            <li class="sidebar-item">--}}
{{--                <a class="sidebar-link" href="ui-buttons.html">--}}
{{--                    <i class="align-middle" data-feather="square"></i> <span class="align-middle">Buttons</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="sidebar-item">--}}
{{--                <a class="sidebar-link" href="ui-forms.html">--}}
{{--                    <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Forms</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="sidebar-item">--}}
{{--                <a class="sidebar-link" href="ui-cards.html">--}}
{{--                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Cards</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="sidebar-item">--}}
{{--                <a class="sidebar-link" href="ui-typography.html">--}}
{{--                    <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Typography</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="sidebar-item">--}}
{{--                <a class="sidebar-link" href="icons-feather.html">--}}
{{--                    <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="sidebar-header">--}}
{{--                Plugins & Addons--}}
{{--            </li>--}}

{{--            <li class="sidebar-item">--}}
{{--                <a class="sidebar-link" href="charts-chartjs.html">--}}
{{--                    <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="sidebar-item">--}}
{{--                <a class="sidebar-link" href="maps-google.html">--}}
{{--                    <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>--}}
{{--                </a>--}}
{{--            </li>--}}
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
