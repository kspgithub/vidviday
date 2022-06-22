@extends('layout.app')

@section('title', 'Оплата замовлення')
@section('seo_description', 'Оплата замовлення')
@section('seo_keywords',  'Оплата замовлення')

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
                        <span id="tour-selection-btn" class="btn type-5 arrow-right text-left flex"><img
                                src="/img/preloader.png" data-img-src="/icon/filter-dark.svg" alt="filter-dark">Підбір туру</span>
                    </div>
                    <div class="spacer-xs"></div>
                    <!-- ORDER COMPLETE CONTENT -->
                    <div class="row">
                        <div class="col-xl-8 offset-xl-2 col-12">

                            <div class="spacer-xs"></div>
                            <h1 class="h2 text-center">Оплата замовлення</h1>

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
    {!! $wizard->getForm()->getWidgetExternalScript() !!}
    <script type="text/javascript">
        var purchaseStatus = 0;
        var purchaseOrder = '{{$wizard->getOrderReference()}}';

        function purchaseCallback(event) {

            if (event.data === 'WfpWidgetEventApproved') {
                // location.url = '...';
                purchaseStatus = 1;
                console.log('WfpWidgetEventApproved')
            }
            if (event.data === 'WfpWidgetEventDeclined') {
                // location.url = '...';
                console.log('WfpWidgetEventDeclined')
            }
            if (event.data === 'WfpWidgetEventPending') {
                // location.url = '...';
                console.log('WfpWidgetEventPending')
            }
            if (event.data === 'WfpWidgetEventClose') {
                // location.url = '...';
                console.log('WfpWidgetEventClose')
                if (purchaseStatus === 1) {
                    document.location = '{{$wizard->getReturnUrl()}}';
                } else {
                    document.location.reload();
                }

            }
        }

    </script>
    {!! $wizard->getForm()->getWidgetInitScript('purchaseCallback') !!}

@endpush

