@extends('layout.app')
@section('title', "$staff->first_name $staff->last_name - $staff->position")
@section('seo_description', "$staff->text")
@section('seo_keywords', "$staff->position")
@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="{{('/')}}">Головна</a>
                <span>—</span>
                <a href="{{pageUrlByKey('office-workers')}}">Офісні працівники</a>
                <span>—</span>
                <span>{{$staff->first_name}} {{$staff->last_name}}</span>
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

                        <div class="row justify-content-between align-items-center my-12">
                            <div class="col-auto">
                                <span class="staff-label btn type-4">{{$staff->label}}</span>
                            </div>
                            <div class="col-auto">
                                <x-page.social-share class="drop-right"/>
                            </div>
                        </div>

                        <div class="text">
                            <p>{{$staff->position}}</p>
                        </div>
                        <div class="spacer-xs"></div>
                        <div class="text text-md">
                            {!! $staff->text !!}
                        </div>
                        <div class="spacer-xs"></div>
                    </div>
                    <!-- BANNER/INFO END -->

                    <!-- ACCORDIONS CONTENT -->
                    <div class="section">
                        <div class="accordion-all-expand">
                            <div class="expand-all-button">
                                <div class="expand-all open">Розгорнути все</div>
                                <div class="expand-all close">Згорнути все</div>
                            </div>
                            <!-- ACCORDIONS CONTENT -->
                            <div class="accordion type-4">
                                @include('staff.includes.contacts')

                                <x-page.testimonials-accordion
                                    :testimonials="$staff->testimonials"></x-page.testimonials-accordion>
                                <div class="spacer-sm"></div>
                            </div>
                            <!-- ACCORDIONS CONTENT END -->

                            <div class="expand-all-button">
                                <div class="expand-all open">Розгорнути все</div>
                                <div class="expand-all close">Згорнути все</div>
                            </div>
                        </div>
                        <div class="spacer-sm"></div>
                    </div>
                    <!-- ACCORDIONS CONTENT END -->


                    <!-- THUMBS CAROUSEL -->
                    <x-tour.carousel :tours="$tours"
                                     :section-title="'Тури, які організовує '.$staff->first_name.' '.$staff->last_name"></x-tour.carousel>
                    <!-- THUMBS CAROUSEL END -->

                </div>
            </div>

            <div class="spacer-lg"></div>
        </div>
    </main>
@endsection
