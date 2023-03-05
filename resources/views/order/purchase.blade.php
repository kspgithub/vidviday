@extends('layout.app')

@section('title', __('Order payment'))
@section('seo_description', __('Order payment'))
@section('seo_keywords',  __('Order payment'))

@push('meta-fields')

@endpush

@section('content')
    <main class="order-page">
        <div class="container">
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
                    <div class="only-pad-mobile">
                        <x-seo-button :code="'tour.select'" class="btn type-5 arrow-right text-left flex"><img
                                src="/img/preloader.png" data-img-src="{{ asset('icon/filter-dark.svg') }}" alt="filter-dark">{{__('sidebar-section.filter.tour-search')}}</x-seo-button>
                    </div>
                    <div class="spacer-xs"></div>
                    <!-- ORDER COMPLETE CONTENT -->
                    <div class="row">
                        <div class="col-xl-8 offset-xl-2 col-12">

                            <div class="spacer-xs"></div>
                            <h1 class="h2 text-center">{{__('Order payment')}}</h1>

                            <div class="spacer-xs"></div>
                            @if($type === 'tour')
                                @include('order.includes.box', ['order'=>$order])
                            @endif
                            @if($type === 'certificate')
                                @include('certificate.includes.box', ['order'=>$order])
                            @endif
                            <div class="spacer-xs"></div>
                            <div class="text-center">
                                {!! $wizard->getForm()->getWidgetButton(__('Сплатити'), 'btn type-1') !!}
                            </div>
                        </div>
                    </div>

                    <!-- ORDER COMPLETE CONTENT END -->
                    <div class="spacer-lg"></div>

                </div>
            </div>
            <div class="spacer-md"></div>
        </div>
    </main>

@endsection

@push('after-scripts')
    @include('purchase.includes.wizard-scripts')
@endpush

