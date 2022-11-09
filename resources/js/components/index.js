// Глобальные компоненты
import { defineAsyncComponent } from 'vue'


export default {
    install: (app) => {
        app.component('sign-up-form', defineAsyncComponent(() => import('./auth/SignUpForm')));

        app.component('lang-dropdown', defineAsyncComponent(() => import('./header/LangDropdown')));
        app.component('currency-dropdown', defineAsyncComponent(() => import('./header/CurrencyDropdown')));
        app.component('header-search', defineAsyncComponent(() => import('./header/HeaderSearch')));
        app.component('header-voice-popup', defineAsyncComponent(() => import('./header/HeaderVoicePopup')));
        app.component('user-avatar', defineAsyncComponent(() => import('./header/UserAvatar')));

        app.component('sidebar-filter', defineAsyncComponent(() => import('./sidebar/SidebarFilter')));
        app.component('sidebar-more-text', defineAsyncComponent(() => import('./sidebar/SidebarMoreText')));
        app.component('sidebar-recommendations', defineAsyncComponent(() => import('./sidebar/SidebarRecommendations')));

        app.component('svg-icon', defineAsyncComponent(() => import('./svg/SvgIcon')));

        app.component('swiper-slider', defineAsyncComponent(() => import('./common/SwiperSlider')));
        app.component('slide-more', defineAsyncComponent(() => import('./common/SlideMore')));
        app.component('show-more-text', defineAsyncComponent(() => import('./common/ShowMoreText')));
        app.component('more-text', defineAsyncComponent(() => import('./common/MoreText')));
        app.component('open-testimonial-form', defineAsyncComponent(() => import('./common/OpenTestimonialForm')));
        app.component('open-tour-question-form', defineAsyncComponent(() => import('./common/OpenTourQuestionForm')));
        app.component('feedback-form', defineAsyncComponent(() => import('./common/FeedbackForm')));
        app.component('share-dropdown', defineAsyncComponent(() => import('./common/ShareDropdown')));
        app.component('print-btn', defineAsyncComponent(() => import('./common/PrintBtn')));
        app.component('map-route', defineAsyncComponent(() => import('./common/MapRoute')));

        app.component('testimonial-list', defineAsyncComponent(() => import('./testimonial/TestimonialList')));
        app.component('testimonial-popup-form', defineAsyncComponent(() => import('./testimonial/TestimonialPopupForm')));


        app.component('popup-gallery', defineAsyncComponent(() => import('./popup/PopupGallery')));
        app.component('popup-call-btn', defineAsyncComponent(() => import('./popup/PopupCallBtn')));
        app.component('popup-call', defineAsyncComponent(() => import('./popup/PopupCall')));
        app.component('popup-email-btn', defineAsyncComponent(() => import('./popup/PopupEmailBtn')));
        app.component('popup-email', defineAsyncComponent(() => import('./popup/PopupEmail')));
        app.component('popup-thanks', defineAsyncComponent(() => import('./popup/PopupThanks')));
        app.component('popup-sub-btn', defineAsyncComponent(() => import('./popup/PopupSubBtn')));
        app.component('popup-user-sub', defineAsyncComponent(() => import('./popup/PopupUserSubscription')));
        app.component('popup-agent-sub', defineAsyncComponent(() => import('./popup/PopupAgentSubscription')));

        app.component('tour-card', defineAsyncComponent(() => import('./tour/TourCard')));

        app.component('tour-search', defineAsyncComponent(() => import('./tour/TourSearch')));
        app.component('tour-request-title', defineAsyncComponent(() => import('./tour/TourRequestTitle')));
        app.component('tour-question-form', defineAsyncComponent(() => import('./tour/TourQuestionForm')));
        app.component('tour-question-popup-form', defineAsyncComponent(() => import('./tour/TourQuestionPopupForm')));
        app.component('tour-testimonial-form', defineAsyncComponent(() => import('./tour/TourTestimonialForm')));
        app.component('tour-map', defineAsyncComponent(() => import('./tour/TourMap')));
        app.component('tour-calc', defineAsyncComponent(() => import('./tour/TourCalc')));
        app.component('tour-carousel', defineAsyncComponent(() => import('./tour/TourCarousel')));
        app.component('tour-order', defineAsyncComponent(() => import('./tour/TourOrder')));
        app.component('tour-one-click-popup', defineAsyncComponent(() => import('./tour/TourOneClickPopup')));
        app.component('tour-calendar-popup', defineAsyncComponent(() => import('./tour/TourCalendarPopup')));
        app.component('tour-like-btn', defineAsyncComponent(() => import('./tour/TourLikeBtn')));
        app.component('tour-voting-form', defineAsyncComponent(() => import('./tour/TourVotingForm')));
        app.component('tour-order-schedule-button', defineAsyncComponent(() => import('./tour/TourOrderScheduleButton')));


        app.component('order-form', defineAsyncComponent(() => import('./order/OrderForm')));
        app.component('order-testimonial-btn', defineAsyncComponent(() => import('./order/OrderTestimonialBtn')));
        app.component('order-cancel-btn', defineAsyncComponent(() => import('./order/OrderCancelBtn')));
        app.component('order-cancel-popup', defineAsyncComponent(() => import('./order/OrderCancelPopup')));
        app.component('order-notes', defineAsyncComponent(() => import('./order/OrderNotes')));
        app.component('order-transport-form', defineAsyncComponent(() => import('./order/OrderTransportForm')));

        app.component('place-testimonial-form', defineAsyncComponent(() => import('./place/PlaceTestimonialForm')));
        app.component('places-accordion', defineAsyncComponent(() => import('./place/PlacesAccordion')));

        app.component('staff-testimonial-form', defineAsyncComponent(() => import('./staff/StaffTestimonialForm')));

        app.component('profile-info-form', defineAsyncComponent(() => import('./profile/ProfileInfoForm')));
        app.component('profile-history', defineAsyncComponent(() => import('./profile/ProfileHistory')));
        app.component('profile-favourite-link', defineAsyncComponent(() => import('./profile/ProfileFavouriteLink')));
        app.component('profile-favourites', defineAsyncComponent(() => import('./profile/ProfileFavourites')));
        app.component('profile-in-favourites', defineAsyncComponent(() => import('./profile/ProfileInFavourites')));

        app.component('certificate-order-form', defineAsyncComponent(() => import('./certificate/CertificateOrderForm')));
        app.component('vacancy-form', defineAsyncComponent(() => import('./vacancy/VacancyForm')));

        app.component('mobile-search', defineAsyncComponent(() => import('./mobile/MobileSearchDropdown')));
    }
}
