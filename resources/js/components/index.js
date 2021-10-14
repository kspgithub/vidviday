// Глобальные компоненты


export default {
    install: (app, options) => {
        app.component('sign-up-form', require('./auth/SignUpForm').default);

        app.component('lang-dropdown', require('./header/LangDropdown').default);
        app.component('header-search', require('./header/HeaderSearch').default);
        app.component('header-voice-popup', require('./header/HeaderVoicePopup').default);

        app.component('sidebar-filter', require('./sidebar/SidebarFilter').default);

        app.component('swiper-slider', require('./common/SwiperSlider').default);
        app.component('slide-more', require('./common/SlideMore').default);
        app.component('show-more-text', require('./common/ShowMoreText').default);
        app.component('open-testimonial-form', require('./common/OpenTestimonialForm').default);
        app.component('feedback-form', require('./common/FeedbackForm').default);

        app.component('testimonial-list', require('./testimonial/TestimonialList').default);
        app.component('testimonial-popup-form', require('./testimonial/TestimonialPopupForm').default);


        app.component('popup-gallery', require('./popup/PopupGallery').default);
        app.component('popup-call-btn', require('./popup/PopupCallBtn').default);
        app.component('popup-call', require('./popup/PopupCall').default);
        app.component('popup-email-btn', require('./popup/PopupEmailBtn').default);
        app.component('popup-email', require('./popup/PopupEmail').default);
        app.component('popup-thanks', require('./popup/PopupThanks').default);

        app.component('tour-card', require('./tour/TourCard').default);

        app.component('tour-search', require('./tour/TourSearch').default);
        app.component('tour-request-title', require('./tour/TourRequestTitle').default);
        app.component('tour-question-form', require('./tour/TourQuestionForm').default);
        app.component('tour-testimonial-form', require('./tour/TourTestimonialForm').default);
        app.component('tour-map', require('./tour/TourMap').default);
        app.component('tour-calc', require('./tour/TourCalc').default);
        app.component('tour-carousel', require('./tour/TourCarousel').default);
        app.component('tour-order', require('./tour/TourOrder').default);
        app.component('tour-one-click-popup', require('./tour/TourOneClickPopup').default);


        app.component('order-form', require('./order/OrderForm').default);

        app.component('place-testimonial-form', require('./place/PlaceTestimonialForm').default);

        app.component('staff-testimonial-form', require('./staff/StaffTestimonialForm').default);


    }
}
