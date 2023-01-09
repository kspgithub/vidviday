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
            <ul class="bread-crumbs" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ route('home') }}" itemprop="item">
                        <span itemprop="name">{{ __("Home") }}</span>
                    </a>
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="{{ pageUrlByKey('certificate') }}" itemprop="item">
                        <span itemprop="name">{{ __('Gift certificate') }}</span>
                    </a>
                </li>
                <li>
                    <span>—</span>
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name">{{ __('Payment') }}</span>
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

