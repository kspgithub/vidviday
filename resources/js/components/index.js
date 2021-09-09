// Глобальные компоненты


export default {
    install: (app, options) => {
        app.component('lang-dropdown', require('./header/LangDropdown').default);

        app.component('sidebar-filter', require('./sidebar/SidebarFilter').default);

        app.component('tour-card', require('./tour/TourCard').default);

        app.component('tour-search', require('./tour/TourSearch').default);
        app.component('tour-request-title', require('./tour/TourRequestTitle').default);
        app.component('tour-question-form', require('./tour/TourQuestionForm').default);
        app.component('tour-testimonial-form', require('./tour/TourTestimonialForm').default);
        app.component('tour-map', require('./tour/TourMap').default);
        app.component('tour-calc', require('./tour/TourCalc').default);

    }
}
