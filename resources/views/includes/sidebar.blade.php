<div class="left-sidebar">

    <div class="left-sidebar-inner">

        <a href="{{route('order.index')}}" class="btn type-4 arrow-right only-desktop">
            {{svg('sidebar-tour')}} @lang('Order tour')</a>

        <a href="{{asset('documents/test-document.pdf')}}" download class="btn type-5 arrow-right only-desktop">
            {{svg('excel')}} @lang('Download tour schedules')</a>

        <x-sidebar.filter/>

        <div class="spacer-xl only-mobile"></div>

        <x-sidebar.ads/>

        <div class="sidebar-item overflow-hidden no-border">
            <div class="gift-certificate">
                <div class="bg" data-bg-src="{{asset('/img/gift-certificate.jpg')}}"
                     style="background-image: url('{{asset('/img/preloader.png')}}');"></div>
                <div class="gift-icon">
                    <img src="{{asset('/icon/gift.svg')}}" alt="gift">
                </div>
                <div class="title h3 light">@lang('Gift<br> certificate')</div>
                <a href="{{pageUrlByKey('certificate')}}" class="full-size"></a>
            </div>
        </div>
        <x-sidebar.latest-news/>
        <x-sidebar.latest-testimonials/>

        <x-sidebar.mailing/>

    </div>

</div>
