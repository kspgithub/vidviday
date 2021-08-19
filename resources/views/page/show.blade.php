@extends('layout.app')

@section('title', !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)
@section('seo_description', !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title)
@section('seo_keywords', !empty($pageContent->seo_keywords) ? $pageContent->seo_keywords : $pageContent->title)


@section('content')
    <div class="container">
        <div class="bread-crumbs">
            <a href="/">@lang('Home')</a>
            <span>—</span>
            <span>{{$pageContent->title}}</span>
        </div>

        <h1 class="h1 title">{{$pageContent->seo_h1 ?? $pageContent->title}}</h1>
        <div class="text text-md">
            {!! $pageContent->text !!}
        </div>

        <div class="spacer-lg"></div>

        @include('includes.regulations')
    </div>

@endsection

