// Глобальные компоненты

import { compile, createHydrationRenderer, createRenderer, defineAsyncComponent, h } from "vue";
import { createContext } from "@fullcalendar/core";


export default {
    install: (app) => {
        function asyncRouteComponent(path) {
            return defineAsyncComponent(() => import(`./${path}.vue`))
        }

        app.component('sign-up-form', asyncRouteComponent('auth/SignUpForm'));

        app.component('lang-dropdown', asyncRouteComponent('header/LangDropdown'));
        app.component('currency-dropdown', asyncRouteComponent('header/CurrencyDropdown'));
        app.component('header-search', asyncRouteComponent('header/HeaderSearch'));
        app.component('header-voice-popup', asyncRouteComponent('header/HeaderVoicePopup'));
        app.component('user-avatar', asyncRouteComponent('header/UserAvatar'));

        app.component('sidebar-filter', asyncRouteComponent('sidebar/SidebarFilter'));
        app.component('sidebar-more-text', asyncRouteComponent('sidebar/SidebarMoreText'));
        app.component('sidebar-recommendations', asyncRouteComponent('sidebar/SidebarRecommendations'));

        app.component('svg-icon', asyncRouteComponent('svg/SvgIcon'));

        app.component('swiper-slider', asyncRouteComponent('common/SwiperSlider'));
        app.component('slide-more', asyncRouteComponent('common/SlideMore'));
        app.component('show-more-text', asyncRouteComponent('common/ShowMoreText'));
        app.component('more-text', asyncRouteComponent('common/MoreText'));
        app.component('open-testimonial-form', asyncRouteComponent('common/OpenTestimonialForm'));
        app.component('open-tour-question-form', asyncRouteComponent('common/OpenTourQuestionForm'));
        app.component('feedback-form', asyncRouteComponent('common/FeedbackForm'));
        app.component('share-dropdown', asyncRouteComponent('common/ShareDropdown'));
        app.component('print-btn', asyncRouteComponent('common/PrintBtn'));
        app.component('map-route', asyncRouteComponent('common/MapRoute'));

        app.component('testimonial-list', asyncRouteComponent('testimonial/TestimonialList'));
        app.component('testimonial-popup-form', asyncRouteComponent('testimonial/TestimonialPopupForm'));


        app.component('popup-gallery', asyncRouteComponent('popup/PopupGallery'));
        app.component('popup-call-btn', asyncRouteComponent('popup/PopupCallBtn'));
        app.component('popup-call', asyncRouteComponent('popup/PopupCall'));
        app.component('popup-email-btn', asyncRouteComponent('popup/PopupEmailBtn'));
        app.component('popup-email', asyncRouteComponent('popup/PopupEmail'));
        app.component('popup-thanks', asyncRouteComponent('popup/PopupThanks'));
        app.component('popup-sub-btn', asyncRouteComponent('popup/PopupSubBtn'));
        app.component('popup-user-sub', asyncRouteComponent('popup/PopupUserSubscription'));
        app.component('popup-agent-sub', asyncRouteComponent('popup/PopupAgentSubscription'));

        app.component('tour-card', asyncRouteComponent('tour/TourCard'));

        app.component('tour-search', asyncRouteComponent('tour/TourSearch'));
        app.component('tour-request-title', asyncRouteComponent('tour/TourRequestTitle'));
        app.component('tour-question-form', asyncRouteComponent('tour/TourQuestionForm'));
        app.component('tour-question-popup-form', asyncRouteComponent('tour/TourQuestionPopupForm'));
        app.component('tour-testimonial-form', asyncRouteComponent('tour/TourTestimonialForm'));
        app.component('tour-map', asyncRouteComponent('tour/TourMap'));
        app.component('tour-calc', asyncRouteComponent('tour/TourCalc'));
        app.component('tour-carousel', asyncRouteComponent('tour/TourCarousel'));
        app.component('tour-order', asyncRouteComponent('tour/TourOrder'));
        app.component('tour-one-click-popup', asyncRouteComponent('tour/TourOneClickPopup'));
        app.component('tour-calendar-popup', asyncRouteComponent('tour/TourCalendarPopup'));
        app.component('tour-like-btn', asyncRouteComponent('tour/TourLikeBtn'));
        app.component('tour-voting-form', asyncRouteComponent('tour/TourVotingForm'));
        app.component('tour-order-schedule-button', asyncRouteComponent('tour/TourOrderScheduleButton'));
        app.component('tour-schedule-accordion', asyncRouteComponent('tour/TourScheduleAccordion'));


        app.component('order-form', asyncRouteComponent('order/OrderForm'));
        app.component('order-testimonial-btn', asyncRouteComponent('order/OrderTestimonialBtn'));
        app.component('order-cancel-btn', asyncRouteComponent('order/OrderCancelBtn'));
        app.component('order-cancel-popup', asyncRouteComponent('order/OrderCancelPopup'));
        app.component('order-notes', asyncRouteComponent('order/OrderNotes'));
        app.component('order-transport-form', asyncRouteComponent('order/OrderTransportForm'));
        app.component('order-broker-form', asyncRouteComponent('order/OrderBrokerForm'));

        app.component('place-testimonial-form', asyncRouteComponent('place/PlaceTestimonialForm'));
        app.component('places-accordion', asyncRouteComponent('place/PlacesAccordion'));

        app.component('staff-testimonial-form', asyncRouteComponent('staff/StaffTestimonialForm'));

        app.component('profile-info-form', asyncRouteComponent('profile/ProfileInfoForm'));
        app.component('profile-history', asyncRouteComponent('profile/ProfileHistory'));
        app.component('profile-favourite-link', asyncRouteComponent('profile/ProfileFavouriteLink'));
        app.component('profile-favourites', asyncRouteComponent('profile/ProfileFavourites'));
        app.component('profile-in-favourites', asyncRouteComponent('profile/ProfileInFavourites'));

        app.component('certificate-order-form', asyncRouteComponent('certificate/CertificateOrderForm'));
        app.component('vacancy-form', asyncRouteComponent('vacancy/VacancyForm'));

        app.component('mobile-search', asyncRouteComponent('mobile/MobileSearchDropdown'));
    }
}
