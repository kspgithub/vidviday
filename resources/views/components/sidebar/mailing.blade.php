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
            <a href="#" class="btn type-2" v-is="'popup-sub-btn'"
               type="tourist">{{__('sidebar-section.mailing.tourist')}}</a>
            <a href="#" class="btn type-2" v-is="'popup-sub-btn'"
               type="tour-agent">{{__('sidebar-section.mailing.tour-agent')}}</a>
        </div>
    </div>
</div>
