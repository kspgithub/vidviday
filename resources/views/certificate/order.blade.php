@extends('layout.app')

@section('title', !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title)
@section('seo_description', !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title)
@section('seo_keywords', !empty($pageContent->seo_keywords) ? $pageContent->seo_keywords : $pageContent->title)

@push('meta-fields')
    {{--    <meta property="fb:app_id" content="">--}}
    {{--    <meta property="og:admins" content="">--}}
    <meta property="og:title" content="{{ !empty($pageContent->seo_title) ? $pageContent->seo_title : $pageContent->title }}">
    <meta property="og:description" content="{{ !empty($pageContent->seo_description) ? $pageContent->seo_description : $pageContent->title }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($pageImage = $pageContent->getFirstMedia() ?: App\Models\Page::where('key', 'home')->first()?->getFirstMedia())
<meta property="og:image" content="{{ $pageImage->getFullUrl() }}">
    @endif
<meta property="og:type" content="product">
    <meta property="og:site_name" content="{{ route('home') }}">
@endpush

@section('content')

    <main class="certificate-order-page">
        <div class="container">
            <!-- BREAD CRUMBS -->
            <ul class="bread-crumbs">
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="{{ route('home') }}" itemprop="url">
                        <span itemprop="title">{{ __("Home") }}</span>
                    </a>
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="{{ pageUrlByKey('certificate') }}" itemprop="url">
                        <span itemprop="title">{{ $pageContent->title }}</span>
                    </a>
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <span itemprop="title">{{ $pageContent->title }}</span>
                </li>
            </ul>
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

