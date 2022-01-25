@extends('layout.app')

@section('title', !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)
@section('seo_description', !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title)
@section('seo_keywords', !empty($pageContent->seo_keywords) ? $pageContent->seo_keywords : $pageContent->title)

@section('content')

    <main class="certificate-order-page">
        <div class="container">
            <!-- BREAD CRUMBS -->
            <div class="bread-crumbs">
                <a href="/">@lang('Home')</a>
                <span>—</span>
                <a href="{{pageUrlByKey('certificate')}}">{{$pageContent->title}}</a>
                <span>—</span>
                <span>{{$pageContent->title}}</span>
            </div>
            <!-- BREAD CRUMBS END -->
            <div class="container bg-white">
                <div class="row">
                    <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-12">
                        <div class="text-center">
                            <div class="text text-md">
                                <h1>{{$pageContent->seo_h1 ?? $pageContent->title}}</h1>
                                {!! $pageContent->text !!}
                            </div>
                            <div class="spacer-xs"></div>
                        </div>

                        <form v-is="'certificate-order-form'"
                              action="{{route('certificate.order.store')}}"
                              :step='{{request()->input('step', 1)}}'
                              :packings='@json($packings)'
                              :payment-types='@json($paymentTypes)'
                              back-url='{{pageUrlByKey('certificate')}}'
                        >
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>
    </main>
@endsection

