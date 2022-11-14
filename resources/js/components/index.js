// Глобальные компоненты
import { defineAsyncComponent } from 'vue'

export const resolveComponent = ctx => {
    const component = () => import(/* webpackChunkName: "chunks/[request]" */ `./${ctx.component}`)

    return defineAsyncComponent(component)
}

export default {
    install: app => {
        app.component('TestComponent', resolveComponent('test-component'))
        app.component('TestComponent2', resolveComponent('test-component2'))
        app.component('SignUpForm', resolveComponent('auth/SignUpForm'))

        app.component('LangDropdown', resolveComponent('header/LangDropdown'))
        app.component('CurrencyDropdown', resolveComponent('header/CurrencyDropdown'))
        app.component('HeaderSearch', resolveComponent('header/HeaderSearch'))
        app.component('HeaderVoicePopup', resolveComponent('header/HeaderVoicePopup'))
        app.component('UserAvatar', resolveComponent('header/UserAvatar'))

        app.component('SidebarFilter', resolveComponent('sidebar/SidebarFilter'))
        app.component('SidebarMoreText', resolveComponent('sidebar/SidebarMoreText'))
        app.component('SidebarRecommendations', resolveComponent('sidebar/SidebarRecommendations'))

        app.component('SvgIcon', resolveComponent('svg/SvgIcon'))

        app.component('SwiperSlider', resolveComponent('common/SwiperSlider'))
        app.component('SlideMore', resolveComponent('common/SlideMore'))
        app.component('ShowMoreText', resolveComponent('common/ShowMoreText'))
        app.component('MoreText', resolveComponent('common/MoreText'))
        app.component('OpenTestimonialForm', resolveComponent('common/OpenTestimonialForm'))
        app.component('OpenTourQuestionForm', resolveComponent('common/OpenTourQuestionForm'))
        app.component('FeedbackForm', resolveComponent('common/FeedbackForm'))
        app.component('ShareDropdown', resolveComponent('common/ShareDropdown'))
        app.component('PrintBtn', resolveComponent('common/PrintBtn'))
        app.component('MapRoute', resolveComponent('common/MapRoute'))

        app.component('TestimonialList', resolveComponent('testimonial/TestimonialList'))
        app.component('TestimonialPopupForm', resolveComponent('testimonial/TestimonialPopupForm'))

        app.component('PopupGallery', resolveComponent('popup/PopupGallery'))
        app.component('PopupCallBtn', resolveComponent('popup/PopupCallBtn'))
        app.component('PopupCall', resolveComponent('popup/PopupCall'))
        app.component('PopupEmailBtn', resolveComponent('popup/PopupEmailBtn'))
        app.component('PopupEmail', resolveComponent('popup/PopupEmail'))
        app.component('PopupThanks', resolveComponent('popup/PopupThanks'))
        app.component('PopupSubBtn', resolveComponent('popup/PopupSubBtn'))
        app.component('PopupUserSub', resolveComponent('popup/PopupUserSubscription'))
        app.component('PopupAgentSub', resolveComponent('popup/PopupAgentSubscription'))

        app.component('TourCard', resolveComponent('tour/TourCard'))

        app.component('TourSearch', resolveComponent('tour/TourSearch'))
        app.component('TourRequestTitle', resolveComponent('tour/TourRequestTitle'))
        app.component('TourQuestionForm', resolveComponent('tour/TourQuestionForm'))
        app.component('TourQuestionPopupForm', resolveComponent('tour/TourQuestionPopupForm'))
        app.component('TourTestimonialForm', resolveComponent('tour/TourTestimonialForm'))
        app.component('TourMap', resolveComponent('tour/TourMap'))
        app.component('TourCalc', resolveComponent('tour/TourCalc'))
        app.component('TourCarousel', resolveComponent('tour/TourCarousel'))
        app.component('TourOrder', resolveComponent('tour/TourOrder'))
        app.component('TourOneClickPopup', resolveComponent('tour/TourOneClickPopup'))
        app.component('TourCalendarPopup', resolveComponent('tour/TourCalendarPopup'))
        app.component('TourLikeBtn', resolveComponent('tour/TourLikeBtn'))
        app.component('TourVotingForm', resolveComponent('tour/TourVotingForm'))
        app.component('TourOrderScheduleButton', resolveComponent('tour/TourOrderScheduleButton'))

        app.component('OrderForm', resolveComponent('order/OrderForm'))
        app.component('OrderTestimonialBtn', resolveComponent('order/OrderTestimonialBtn'))
        app.component('OrderCancelBtn', resolveComponent('order/OrderCancelBtn'))
        app.component('OrderCancelPopup', resolveComponent('order/OrderCancelPopup'))
        app.component('OrderNotes', resolveComponent('order/OrderNotes'))
        app.component('OrderTransportForm', resolveComponent('order/OrderTransportForm'))

        app.component('PlaceTestimonialForm', resolveComponent('place/PlaceTestimonialForm'))
        app.component('PlacesAccordion', resolveComponent('place/PlacesAccordion'))

        app.component('StaffTestimonialForm', resolveComponent('staff/StaffTestimonialForm'))

        app.component('ProfileInfoForm', resolveComponent('profile/ProfileInfoForm'))
        app.component('ProfileHistory', resolveComponent('profile/ProfileHistory'))
        app.component('ProfileFavouriteLink', resolveComponent('profile/ProfileFavouriteLink'))
        app.component('ProfileFavourites', resolveComponent('profile/ProfileFavourites'))
        app.component('ProfileInFavourites', resolveComponent('profile/ProfileInFavourites'))

        app.component('CertificateOrderForm', resolveComponent('certificate/CertificateOrderForm'))
        app.component('VacancyForm', resolveComponent('vacancy/VacancyForm'))

        app.component('MobileSearch', resolveComponent('mobile/MobileSearchDropdown'))
    },
}
