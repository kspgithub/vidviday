<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="/" class="nav-link">До сайту</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-align">
            @if(count(config('site-settings.locale.languages')) > 1)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        {{__(getLocaleName(app()->getLocale()))}}
                    </a>

                    @include('admin.include.lang')
                </li>
            @endif


            {{--            @include('admin.include.nav-notifications')--}}
            {{--            @include('admin.include.nav-messages')--}}

            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown" x-data='user({
                        user: @json(current_user()->asCrmUser()),
                    })'>
                    <img src="{{current_user()->avatar_url}}" class="avatar img-fluid rounded me-1" alt="Charles Hall"/>
                    <span class="text-dark">{{current_user()->name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    {{--                    <a class="dropdown-item" href="pages-profile.html"><i class="align-middle mr-1" data-feather="user"></i> @lang('Profile')</a>--}}
                    {{--                    <div class="dropdown-divider"></div>--}}
                    <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="align-middle mr-1" data-feather="log-out"></i>
                        @lang('Logout')</a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
