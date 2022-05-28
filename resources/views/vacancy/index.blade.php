@extends('layout.app')
@section('title', !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)
@section('seo_description', !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title)
@section('seo_keywords', !empty($pageContent->seo_keywords) ? $pageContent->seo_keywords : $pageContent->title)

@section('content')
    <main>
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="index.php">Головна</a>
                <span>—</span>
                <span>Вакансії</span>
            </div>
            <!-- BREAD CRUMBS END -->
            <div class="row">
                <div class="col-xl-8 col-12">
                    <!-- BANNER TABS -->
                @include('page.includes.banner-tabs', [
                    'pictures'=>$pageContent->getMedia(),
                    'video'=>$pageContent->video
                ])
                <!-- BANNER TABS END -->
                    <div class="spacer-xs"></div>
                    <!-- CAREER CONTENT -->
                    <h1 class="h1 title">{{!empty($pageContent->seo_h1) ? $pageContent->seo_h1 : $pageContent->title }}</h1>
                    <div class="spacer-xs"></div>
                    <div class="only-pad-mobile">
                        <x-page.social-share/>
                        <div class="spacer-xs"></div>
                    </div>
                    <div class="text text-md">
                        {!! $pageContent->text !!}
                    </div>
                    <div class="spacer-xs"></div>
                    <div>
                        @foreach($vacancies as  $vacancy)
                            <div class="bordered-box vacancy">
                                <h2 class="h3"><a href="{{$vacancy->url}}">{{$vacancy->title}}</a></h2>
                                <span class="text-sm">{{$vacancy->created_at}}</span>
                                <div class="text">
                                    <p>{{!empty($vacancy->short_text) ? $vacancy->short_text : str_limit(strip_tags($vacancy->text), 500)}}</p>
                                </div>
                                <a href="{{$vacancy->url}}" class="btn type-3 btn-more">Дізнатись Більше</a>
                            </div>
                        @endforeach
                    </div>
                    <!-- CAREER CONTENT END -->
                    <div class="only-pad-mobile">
                        <div class="spacer-sm"></div>
                    </div>
                </div>

                <div class="col-xl-4 col-12">
                    <!-- SIDEBAR -->
                    <x-page.right-sidebar :pageContent="$pageContent">
                        <div class="sidebar-item" v-is="'vacancy-form'"></div>
                    </x-page.right-sidebar>

                    <!-- SIDEBAR END -->
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>

        <!-- SEO TEXT -->
        <x-page.regulations :model="$pageContent"/>
        <!-- SEO TEXT END -->
    </main>


@endsection
