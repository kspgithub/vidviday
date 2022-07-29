<div class="popup-wrap" id="popup-wrap">
    <div class="bg-layer"></div>


    {{--    @include('includes.popups.call-back-popup')--}}
    {{--    @include('includes.popups.write-message-popup')--}}
    {{--    @include('includes.popups.tourists-mailing-popup')--}}
    {{--    @include('includes.popups.agents-mailing-popup')--}}
    @include('includes.popups.thanks-popup')

    @guest()
        @include('includes.popups.login-popup')
        @include('includes.popups.password-recovery-popup')
    @endguest()

    {{--    @include('includes.popups.gallery-popup')--}}
    {{--    @include('includes.popups.one-click-popup')--}}

    @include('includes.popups.place-testimonial-popup')
    @include('includes.popups.guide-testimonial-popup')
    @include('includes.popups.manager-testimonial-popup')
    @include('includes.popups.tour-cancel-popup')

    @include('includes.popups.popup_ads')

    @stack('popups', false)

</div>

<div v-is="'popup-gallery'"></div>
<div v-is="'popup-user-sub'"></div>
<div v-is="'popup-agent-sub'"></div>
<div v-is="'popup-call'" :question-types='@json(App\Helpers\Types\QuestionTypes::toSelectBox())'></div>
<div v-is="'popup-email'" :question-types='@json(App\Helpers\Types\QuestionTypes::toSelectBox())'></div>
<div v-is="'popup-thanks'"></div>
<div v-is="'header-voice-popup'"></div>

<div class="video-popup">
    <div class="video-popup-overlay"></div>
    <div class="video-popup-content">
        <div class="video-popup-layer"></div>
        <div class="video-popup-container">
            <div class="video-popup-align">
                <div class="embed-responsive embed-responsive-16by9">
                    <div class="video"></div>
                </div>
            </div>
            <div class="video-popup-close btn-close"><span></span></div>
        </div>
    </div>
</div>

@stack('after-popups', false)

