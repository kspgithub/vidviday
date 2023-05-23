@extends('layout.app')


@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <ul class="bread-crumbs" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ route('home') }}" itemprop="item">
                        <span itemprop="name">{{ __("Home") }}</span>
                    </a>
                    <meta itemprop="position" content="1" />
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name">Сторінка не знайдена</span>
                    <meta itemprop="position" content="2" />
                </li>
            </ul>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="col-xl-3 col-12">
                    <!-- SIDEBAR -->
                    <div class="left-sidebar">
                        <div class="left-sidebar-inner">
                            <x-sidebar.filter/>
                        </div>
                    </div>
                    <!-- SIDEBAR END -->
                </div>

                <div class="col-xl-9 col-12">
                    <x-tour.mobile-search-btn/>
                    <!-- BANNER/INFO -->
                    <div class="section text-center">
                        <div class="spacer-xs"></div>
                        <span class="error">404</span>
                        <h1 class="h1 title">Нажаль, такої сторінки не існує</h1>
                        <div class="text text-md">
                            <p>Пропонуємо почати з головної сторінки</p>
                        </div>
                        <div class="spacer-xs"></div>
                        <a href="/" class="btn type-1">На головну</a>
                        <div class="spacer-lg"></div>
                        <hr>
                        <div class="spacer-xs"></div>
                    </div>
                    <!-- BANNER/INFO END -->

                    <!-- THUMBS CAROUSEL -->
                    <x-tour.popular />
                    <!-- THUMBS CAROUSEL END -->

                    <div class="whitespace-fix"></div>

                </div>
            </div>
        </div>
    </main>

@endsection
