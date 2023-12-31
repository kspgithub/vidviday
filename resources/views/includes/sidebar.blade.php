<div class="left-sidebar">

    <div class="left-sidebar-inner">

       {{--  @env('production')
            <x-seo-button :code="'order.tour'" href="{{route('order.index', ['clear'=>1])}}" class="btn type-4 arrow-right only-desktop" v-is="'popup-email-btn'">
                {{svg('sidebar-tour')}} @lang('sidebar-section.order-tour')</x-seo-button>
        @endenv --}}

        
        <x-seo-button :code="'order.tour'" href="{{route('order.index', ['clear'=>1])}}" class="btn type-4 arrow-right only-desktop">
            {{svg('sidebar-tour')}} @lang('sidebar-section.order-tour')</x-seo-button>
       

        <x-seo-button :code="'download.schedule'" href="{{route('tour.download')}}" download class="btn type-5 arrow-right only-desktop">
            {{svg('excel')}} @lang('sidebar-section.download-schedules')</x-seo-button>

        <x-sidebar.filter/>

        <x-seo-button :code="'goto.calendar'" href="{{route('calendar.index')}}" class="btn type-4 arrow-right only-desktop">
            {{svg('sidebar-tour')}} @lang('tours-section.tours-calendar')
        </x-seo-button>

        <x-sidebar.ads/>

        <div class="sidebar-item overflow-hidden no-border">
            <div class="gift-certificate">
                <div class="bg" data-bg-src="{{$giftImage}}"
                     style="background-image: url('{{asset('/img/preloader.png')}}');"></div>
                <div class="gift-icon">
                    <img loading="lazy" data-src="{{asset('/icon/gift.svg')}}" alt="gift">
                </div>
                <div class="title h3 light">@lang('sidebar-section.gift-certificate')</div>
                <a href="{{pageUrlByKey('certificate')}}" class="full-size"></a>
            </div>
        </div>
        <x-sidebar.latest-news/>
        <x-sidebar.latest-testimonials :title="__('sidebar-section.testimonials')"
                                       :btn-text="__('sidebar-section.all-testimonials')"
                                       type="all"
        />

        <x-sidebar.mailing/>

    </div>

</div>
