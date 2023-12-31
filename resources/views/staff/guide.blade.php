@extends('layout.app')

@section('title', "$staff->first_name $staff->last_name - $staff->position")
@section('seo_description', "$staff->text")
@section('seo_keywords', "$staff->position")

@push('meta-fields')
    {{--    <meta property="fb:app_id" content="">--}}
    {{--    <meta property="og:admins" content="">--}}
    <meta property="og:title" content="{{ $staff->first_name . '' . $staff->last_name . '-' . $staff->position }}">
    <meta property="og:description" content="{{ $staff->text }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($pageImage = $staff->getFirstMedia() ?: App\Models\Page::where('key', 'home')->first()?->getFirstMedia())
<meta property="og:image" content="{{ $pageImage->getFullUrl() }}">
    @endif
<meta property="og:type" content="product">
    <meta property="og:site_name" content="{{ route('home') }}">
@endpush

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
                    <a href="{{ pageUrlByKey('guides') }}" itemprop="item">
                        <span itemprop="name">{{ __("Екскурсоводи") }}</span>
                    </a>
                    <meta itemprop="position" content="2" />
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name">{{$staff->first_name}} {{$staff->last_name}}</span>
                    <meta itemprop="position" content="3" />
                </li>
            </ul>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="order-xl-1 order-2 col-xl-3 col-12">
                    <!-- SIDEBAR -->
                @include('includes.sidebar')
                <!-- SIDEBAR END -->
                </div>

                <div class="order-xl-2 order-1 col-xl-9 col-12">
                    <!-- BANNER/INFO -->
                    <div class="section">
                        @include('page.includes.banner-tabs', [
                           'pictures'=>$staff->getMedia(),
                           'video'=>$staff->video
                         ])
                        <h1 class="h1 title">{{$staff->first_name}} {{$staff->last_name}}</h1>

                        <x-page.social-share :share-url="$staff->url" :share-title="$staff->first_name . '' . $staff->last_name . '-' . $staff->position"/>

                        <div class="text text-md">
                            {!! $staff->text !!}
                        </div>
                        <div class="spacer-xs"></div>
                    </div>
                    <!-- BANNER/INFO END -->


                    <!-- ACCORDIONS CONTENT -->
                    <div class="accordion type-4">
                        <hr>
                        <x-page.testimonials-accordion
                            :testimonials="$testimonials"></x-page.testimonials-accordion>
                        <div class="spacer-sm"></div>
                    </div>
                    <!-- ACCORDIONS CONTENT END -->


                    <!-- ACCORDIONS CONTENT END -->

                    <!-- THUMBS CAROUSEL -->
                    <x-tour.carousel :tours="$tours"
                                     :section-title="'Тури які проводить '.$staff->first_name.' '.$staff->last_name"></x-tour.carousel>
                    <!-- THUMBS CAROUSEL END -->
                </div>
            </div>
        </div>
    </main>

@endsection

@push('after-popups')
    <div v-is="'staff-testimonial-form'"
         :type='@json('guide')'
         :staff='@json($staff)'
         :user='@json(current_user())'
         action='{{route('staff.testimonial', $staff->id)}}'
         :data-parent="0"
         :tours='@json($tours->map->shortInfo())'
    >
        @csrf
    </div>

@endpush
