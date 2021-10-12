<div class="popup-wrap" id="popup-wrap">
    <div class="bg-layer"></div>


    @include('includes.popups.call-back-popup')
    @include('includes.popups.write-message-popup')
    @include('includes.popups.tourists-mailing-popup')
    @include('includes.popups.agents-mailing-popup')
    @include('includes.popups.thanks-popup')
    @include('includes.popups.login-popup')
    @include('includes.popups.password-recovery-popup')
    {{--    @include('includes.popups.gallery-popup')--}}
    {{--    @include('includes.popups.one-click-popup')--}}

    @include('includes.popups.place-testimonial-popup')
    @include('includes.popups.guide-testimonial-popup')
    @include('includes.popups.manager-testimonial-popup')
    @include('includes.popups.tour-cancel-popup')

    @stack('popups', false)

</div>
<div v-is="'popup-gallery'"></div>
<div v-is="'header-voice-popup'"></div>
@stack('after-popups', false)

