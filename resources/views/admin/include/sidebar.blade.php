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
            <li class="sidebar-item {{routeActiveClass('admin.user*')}}">
                <a data-bs-target="#users" data-bs-toggle="collapse" class="sidebar-link {{routeActiveClass('admin.user*', '', 'collapsed')}}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">@lang('Users')</span>
                </a>
                <ul id="users" class="sidebar-dropdown list-unstyled collapse {{routeActiveClass('admin.user*', 'show', '')}}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{routeActiveClass('admin.user.index')}}"><a class="sidebar-link" href="{{route('admin.user.index')}}">@lang('Users List')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.user.create')}}"><a class="sidebar-link" href="{{route('admin.user.create')}}">@lang('Create User')</a></li>
                </ul>
            </li>
            <li class="sidebar-item {{routeActiveClass('admin.tour*')}}">
                <a data-bs-target="#tours" data-bs-toggle="collapse" class="sidebar-link {{routeActiveClass('admin.tour*', '', 'collapsed')}}">
                    <i class="align-middle" data-feather="map"></i> <span class="align-middle">@lang('Tours')</span>
                </a>
                <ul id="tours" class="sidebar-dropdown list-unstyled collapse  {{routeActiveClass('admin.tour*', 'show', '')}}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{routeActiveClass('admin.tour.*')}}"><a class="sidebar-link" href="{{route('admin.tour.index')}}">@lang('Tours')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.tour-group.*')}}"><a class="sidebar-link" href="{{route('admin.tour-group.index')}}">@lang('Tour Groups')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.tour-subjects.*')}}"><a class="sidebar-link " href="{{route('admin.tour-subjects.index')}}">@lang('Tour Subjects')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.direction.*')}}"><a class="sidebar-link " href="{{route('admin.direction.index')}}">@lang('Tour Directions')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.tour-type.*')}}"><a class="sidebar-link " href="{{route('admin.tour-type.index')}}">@lang('Tour Types')</a></li>
                </ul>
            </li>
            <li class="sidebar-item {{routeActiveClass('admin.place*')}}">
                <a data-bs-target="#places" data-bs-toggle="collapse" class="sidebar-link {{routeActiveClass('admin.place*', '', 'collapsed')}}">
                    <i class="align-middle" data-feather="map-pin"></i> <span class="align-middle">@lang('Places')</span>
                </a>
                <ul id="places" class="sidebar-dropdown list-unstyled collapse  {{routeActiveClass('admin.place*', 'show', '')}}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{routeActiveClass('admin.place.*')}}"><a class="sidebar-link" href="{{route('admin.place.index')}}">@lang('Places List')</a></li>
                </ul>
            </li>
            <!-- -------------------------------------------------------------------------------------------------- --->
            <li class="sidebar-item {{routeActiveClass('admin.location*')}}">
                <a data-bs-target="#location" data-bs-toggle="collapse" class="sidebar-link {{routeActiveClass('admin.location*', '', 'collapsed')}}">
                    <i class="align-middle" data-feather="compass"></i> <span class="align-middle">@lang('Locations')</span>
                </a>
                <ul id="location" class="sidebar-dropdown list-unstyled collapse {{routeActiveClass('admin.location*', 'show', '')}}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{routeActiveClass('admin.country.index')}}"><a class="sidebar-link" href="{{route('admin.country.index')}}">@lang('Countries')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.region.index')}}"><a class="sidebar-link" href="{{route('admin.region.index')}}">@lang('Regions')</a></li>
                    <li class="sidebar-item {{routeActiveClass('admin.city.index')}}"><a class="sidebar-link" href="{{route('admin.city.index')}}">@lang('Cities')</a></li>
                </ul>
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
