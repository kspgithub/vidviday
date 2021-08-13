// Глобальные компоненты


export default {
    install: (app, options) => {
        app.component('lang-dropdown', require('./header/LangDropdown').default);

        app.component('sidebar-filter', require('./sidebar/SidebarFilter').default);

        app.component('tour-card', require('./tour/TourCard').default);

        app.component('tour-search', require('./tour/TourSearch').default);

    }
}
