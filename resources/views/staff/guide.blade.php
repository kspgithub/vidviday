@extends('layout.app')
@section('title', "$staff->first_name $staff->last_name - $staff->position")
@section('seo_description', "$staff->text")
@section('seo_keywords', "$staff->position")
@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="index.php">Головна</a>
                <span>—</span>
                <a href="tour-guides.php">Екскурсоводи</a>
                <span>—</span>
                <span>Христина Чорній (Дмитришин)</span>
            </div>
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

                        <x-page.social-share/>

                        <div class="text text-md">
                            {!! $staff->text !!}
                        </div>
                        <div class="spacer-xs"></div>
                    </div>
                    <!-- BANNER/INFO END -->


                    <!-- ACCORDIONS CONTENT -->
                    <x-page.testimonials-accordion :testimonials="$staff->testimonials"></x-page.testimonials-accordion>
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
