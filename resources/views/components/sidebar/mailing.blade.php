<div class="sidebar-item">
    <div class="top-part b-border">
        <div class="title h3 title-icon">
            <img src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/email.svg')}}"
                 alt="mailing">
            <span>{{__('sidebar-section.mailing.title')}}</span>
        </div>
    </div>
    <div class="bottom-part">
        <div class="subscribe-block">
            <a href="https://static.mailerlite.com/webforms/popup/a1x1b5?" target="_blank"
{{--               v-is="'popup-sub-btn'"--}}
               class="btn type-2"
               type="tourist">{{__('sidebar-section.mailing.tourist')}}</a>
            <a href="https://static.mailerlite.com/webforms/popup/h0l6i5?"  target="_blank"
{{--               v-is="'popup-sub-btn'"--}}
               class="btn type-2"
               type="tour-agent">{{__('sidebar-section.mailing.tour-agent')}}
            </a>
        </div>
    </div>
</div>
