@extends('layout.app')

@section('title', __('Order payment'))
@section('seo_description', __('Order payment'))
@section('seo_keywords',  __('Order payment'))

@push('meta-fields')

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
                        <span itemprop="title">{{ __('Gift certificate') }}</span>
                    </a>
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <span itemprop="title">{{ __('Payment') }}</span>
                </li>
            </ul>
            <!-- BREAD CRUMBS END -->
            <div class="container bg-white">
                <div class="row">
                    <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-12">
                        <div class="text-center">
                            <div class="text text-md">
                                <h1>{{__('Order payment')}}</h1>

                            </div>
                            <div class="spacer-xs"></div>
                        </div>

                        <!-- ORDER COMPLETE CONTENT -->
                        @include('certificate.includes.box', ['order'=>$order])
                        <div class="spacer-xs"></div>
                        <div class="text-center">
                            {!! $wizard->getForm()->getWidgetButton(__('Сплатити'), 'btn type-1') !!}
                        </div>
                        <!-- ORDER COMPLETE CONTENT END -->
                    </div>
                </div>
            </div>
            <div class="spacer-lg"></div>
        </div>
    </main>

@endsection

@push('after-scripts')
    @include('purchase.includes.wizard-scripts')
@endpush

