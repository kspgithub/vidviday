<div class="left-sidebar">

    <div class="left-sidebar-inner">

        <a href="{{route('order.index')}}" class="btn type-4 arrow-right only-desktop">
            {{svg('sidebar-tour')}} @lang('sidebar-section.order-tour')</a>

        <a href="{{route('tour.download')}}" download class="btn type-5 arrow-right only-desktop">
            {{svg('excel')}} @lang('sidebar-section.download-schedules')</a>

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
                <div class="title h3 light">@lang('sidebar-section.gift-certificate')</div>
                <a href="{{pageUrlByKey('certificate')}}" class="full-size"></a>
            </div>
        </div>
        <x-sidebar.latest-news/>
        <x-sidebar.latest-testimonials :title="__('sidebar-section.testimonials')"
                                       :btn-text="__('sidebar-section.all-testimonials')"/>

        <x-sidebar.mailing/>

    </div>

</div>
