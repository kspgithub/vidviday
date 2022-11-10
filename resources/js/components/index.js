// Глобальные компоненты
import { defineAsyncComponent } from 'vue'

// const resolveComponent = (component) => defineAsyncComponent(() => import(/* webpackChunkName: "[request]" */ `./${component}.vue`))
export const resolveComponent = (component) => defineAsyncComponent(() => import(/* webpackChunkName: "[request]" */`./${component}.vue`))

export default {
    install: (app) => {
        app.component('test-component', resolveComponent('test-component'));
        app.component('test-component2', resolveComponent('test-component2'));
        app.component('sign-up-form', resolveComponent('auth/SignUpForm'));

        app.component('lang-dropdown', resolveComponent('header/LangDropdown'));
        app.component('currency-dropdown', resolveComponent('header/CurrencyDropdown'));
        app.component('header-search', resolveComponent('header/HeaderSearch'));
        app.component('header-voice-popup', resolveComponent('header/HeaderVoicePopup'));
        app.component('user-avatar', resolveComponent('header/UserAvatar'));

        app.component('sidebar-filter', resolveComponent('sidebar/SidebarFilter'));
        app.component('sidebar-more-text', resolveComponent('sidebar/SidebarMoreText'));
        app.component('sidebar-recommendations', resolveComponent('sidebar/SidebarRecommendations'));

        app.component('svg-icon', resolveComponent('svg/SvgIcon'));

        app.component('swiper-slider', resolveComponent('common/SwiperSlider'));
        app.component('slide-more', resolveComponent('common/SlideMore'));
        app.component('show-more-text', resolveComponent('common/ShowMoreText'));
        app.component('more-text', resolveComponent('common/MoreText'));
        app.component('open-testimonial-form', resolveComponent('common/OpenTestimonialForm'));
        app.component('open-tour-question-form', resolveComponent('common/OpenTourQuestionForm'));
        app.component('feedback-form', resolveComponent('common/FeedbackForm'));
        app.component('share-dropdown', resolveComponent('common/ShareDropdown'));
        app.component('print-btn', resolveComponent('common/PrintBtn'));
        app.component('map-route', resolveComponent('common/MapRoute'));

        app.component('testimonial-list', resolveComponent('testimonial/TestimonialList'));
        app.component('testimonial-popup-form', resolveComponent('testimonial/TestimonialPopupForm'));


        app.component('popup-gallery', resolveComponent('popup/PopupGallery'));
        app.component('popup-call-btn', resolveComponent('popup/PopupCallBtn'));
        app.component('popup-call', resolveComponent('popup/PopupCall'));
        app.component('popup-email-btn', resolveComponent('popup/PopupEmailBtn'));
        app.component('popup-email', resolveComponent('popup/PopupEmail'));
        app.component('popup-thanks', resolveComponent('popup/PopupThanks'));
        app.component('popup-sub-btn', resolveComponent('popup/PopupSubBtn'));
        app.component('popup-user-sub', resolveComponent('popup/PopupUserSubscription'));
        app.component('popup-agent-sub', resolveComponent('popup/PopupAgentSubscription'));

        app.component('tour-card', resolveComponent('tour/TourCard'));

        app.component('tour-search', resolveComponent('tour/TourSearch'));
        app.component('tour-request-title', resolveComponent('tour/TourRequestTitle'));
        app.component('tour-question-form', resolveComponent('tour/TourQuestionForm'));
        app.component('tour-question-popup-form', resolveComponent('tour/TourQuestionPopupForm'));
        app.component('tour-testimonial-form', resolveComponent('tour/TourTestimonialForm'));
        app.component('tour-map', resolveComponent('tour/TourMap'));
        app.component('tour-calc', resolveComponent('tour/TourCalc'));
        app.component('tour-carousel', resolveComponent('tour/TourCarousel'));
        app.component('tour-order', resolveComponent('tour/TourOrder'));
        app.component('tour-one-click-popup', resolveComponent('tour/TourOneClickPopup'));
        app.component('tour-calendar-popup', resolveComponent('tour/TourCalendarPopup'));
        app.component('tour-like-btn', resolveComponent('tour/TourLikeBtn'));
        app.component('tour-voting-form', resolveComponent('tour/TourVotingForm'));
        app.component('tour-order-schedule-button', resolveComponent('tour/TourOrderScheduleButton'));


        app.component('order-form', resolveComponent('order/OrderForm'));
        app.component('order-testimonial-btn', resolveComponent('order/OrderTestimonialBtn'));
        app.component('order-cancel-btn', resolveComponent('order/OrderCancelBtn'));
        app.component('order-cancel-popup', resolveComponent('order/OrderCancelPopup'));
        app.component('order-notes', resolveComponent('order/OrderNotes'));
        app.component('order-transport-form', resolveComponent('order/OrderTransportForm'));

        app.component('place-testimonial-form', resolveComponent('place/PlaceTestimonialForm'));
        app.component('places-accordion', resolveComponent('place/PlacesAccordion'));

        app.component('staff-testimonial-form', resolveComponent('staff/StaffTestimonialForm'));

        app.component('profile-info-form', resolveComponent('profile/ProfileInfoForm'));
        app.component('profile-history', resolveComponent('profile/ProfileHistory'));
        app.component('profile-favourite-link', resolveComponent('profile/ProfileFavouriteLink'));
        app.component('profile-favourites', resolveComponent('profile/ProfileFavourites'));
        app.component('profile-in-favourites', resolveComponent('profile/ProfileInFavourites'));

        app.component('certificate-order-form', resolveComponent('certificate/CertificateOrderForm'));
        app.component('vacancy-form', resolveComponent('vacancy/VacancyForm'));

        app.component('mobile-search', resolveComponent('mobile/MobileSearchDropdown'));
    }
}
