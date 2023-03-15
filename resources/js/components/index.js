// Глобальные компоненты

import { defineAsyncComponent } from "vue";

const lazyLoad = true;

export default {
    install: (app) => {
        function lazyLoadComponent(component) {
            if(lazyLoad) {
                return defineAsyncComponent(() => import(`./${component}.vue`))
            } else {
                return require(`./${component}.vue`).default
            }
        }

        app.component('sign-up-form', lazyLoadComponent('auth/SignUpForm'));

        app.component('lang-dropdown', lazyLoadComponent('header/LangDropdown'));
        app.component('currency-dropdown', lazyLoadComponent('header/CurrencyDropdown'));
        app.component('header-search', lazyLoadComponent('header/HeaderSearch'));
        app.component('header-voice-popup', lazyLoadComponent('header/HeaderVoicePopup'));
        app.component('user-avatar', lazyLoadComponent('header/UserAvatar'));

        app.component('sidebar-filter', lazyLoadComponent('sidebar/SidebarFilter'));
        app.component('sidebar-more-text', lazyLoadComponent('sidebar/SidebarMoreText'));
        app.component('sidebar-recommendations', lazyLoadComponent('sidebar/SidebarRecommendations'));

        app.component('svg-icon', lazyLoadComponent('svg/SvgIcon'));

        app.component('swiper-slider', lazyLoadComponent('common/SwiperSlider'));
        app.component('slide-more', lazyLoadComponent('common/SlideMore'));
        app.component('show-more-text', lazyLoadComponent('common/ShowMoreText'));
        app.component('more-text', lazyLoadComponent('common/MoreText'));
        app.component('open-testimonial-form', lazyLoadComponent('common/OpenTestimonialForm'));
        app.component('open-tour-question-form', lazyLoadComponent('common/OpenTourQuestionForm'));
        app.component('feedback-form', lazyLoadComponent('common/FeedbackForm'));
        app.component('share-dropdown', lazyLoadComponent('common/ShareDropdown'));
        app.component('print-btn', lazyLoadComponent('common/PrintBtn'));
        app.component('map-route', lazyLoadComponent('common/MapRoute'));
        app.component('seo-button', lazyLoadComponent('common/SeoButton'));

        app.component('testimonial-list', lazyLoadComponent('testimonial/TestimonialList'));
        app.component('testimonial-popup-form', lazyLoadComponent('testimonial/TestimonialPopupForm'));


        app.component('popup-gallery', lazyLoadComponent('popup/PopupGallery'));
        app.component('popup-call-btn', lazyLoadComponent('popup/PopupCallBtn'));
        app.component('popup-call', lazyLoadComponent('popup/PopupCall'));
        app.component('popup-email-btn', lazyLoadComponent('popup/PopupEmailBtn'));
        app.component('popup-email', lazyLoadComponent('popup/PopupEmail'));
        app.component('popup-thanks', lazyLoadComponent('popup/PopupThanks'));
        app.component('popup-sub-btn', lazyLoadComponent('popup/PopupSubBtn'));
        app.component('popup-user-sub', lazyLoadComponent('popup/PopupUserSubscription'));
        app.component('popup-agent-sub', lazyLoadComponent('popup/PopupAgentSubscription'));

        app.component('tour-card', lazyLoadComponent('tour/TourCard'));

        app.component('tour-search', lazyLoadComponent('tour/TourSearch'));
        app.component('tour-request-title', lazyLoadComponent('tour/TourRequestTitle'));
        app.component('tour-question-form', lazyLoadComponent('tour/TourQuestionForm'));
        app.component('tour-question-popup-form', lazyLoadComponent('tour/TourQuestionPopupForm'));
        app.component('tour-testimonial-form', lazyLoadComponent('tour/TourTestimonialForm'));
        app.component('tour-map', lazyLoadComponent('tour/TourMap'));
        app.component('tour-calc', lazyLoadComponent('tour/TourCalc'));
        app.component('tour-carousel', lazyLoadComponent('tour/TourCarousel'));
        app.component('tour-order', lazyLoadComponent('tour/TourOrder'));
        app.component('tour-one-click-popup', lazyLoadComponent('tour/TourOneClickPopup'));
        app.component('tour-calendar-popup', lazyLoadComponent('tour/TourCalendarPopup'));
        app.component('tour-view-calendar', lazyLoadComponent('tour/TourViewCalendar'));
        app.component('tour-like-btn', lazyLoadComponent('tour/TourLikeBtn'));
        app.component('tour-voting-form', lazyLoadComponent('tour/TourVotingForm'));
        app.component('tour-order-schedule-button', lazyLoadComponent('tour/TourOrderScheduleButton'));
        app.component('tour-schedule-accordion', lazyLoadComponent('tour/TourScheduleAccordion'));


        app.component('order-form', lazyLoadComponent('order/OrderForm'));
        app.component('order-testimonial-btn', lazyLoadComponent('order/OrderTestimonialBtn'));
        app.component('order-cancel-btn', lazyLoadComponent('order/OrderCancelBtn'));
        app.component('order-cancel-popup', lazyLoadComponent('order/OrderCancelPopup'));
        app.component('order-notes', lazyLoadComponent('order/OrderNotes'));
        app.component('order-transport-form', lazyLoadComponent('order/OrderTransportForm'));
        app.component('order-broker-form', lazyLoadComponent('order/OrderBrokerForm'));

        app.component('place-testimonial-form', lazyLoadComponent('place/PlaceTestimonialForm'));
        app.component('places-accordion', lazyLoadComponent('place/PlacesAccordion'));

        app.component('staff-testimonial-form', lazyLoadComponent('staff/StaffTestimonialForm'));

        app.component('profile-info-form', lazyLoadComponent('profile/ProfileInfoForm'));
        app.component('profile-history', lazyLoadComponent('profile/ProfileHistory'));
        app.component('profile-favourite-link', lazyLoadComponent('profile/ProfileFavouriteLink'));
        app.component('profile-favourites', lazyLoadComponent('profile/ProfileFavourites'));
        app.component('profile-in-favourites', lazyLoadComponent('profile/ProfileInFavourites'));

        app.component('certificate-order-form', lazyLoadComponent('certificate/CertificateOrderForm'));
        app.component('vacancy-form', lazyLoadComponent('vacancy/VacancyForm'));

        app.component('mobile-search', lazyLoadComponent('mobile/MobileSearchDropdown'));
    }
}
