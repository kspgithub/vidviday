import {createStore, createLogger} from "vuex";


const plugins = [];


if (process.env.NODE_ENV !== 'production') {
    const logger = createLogger();
    plugins.push(logger);
}

import createPersistedState from "vuex-persistedstate";


const psState = createPersistedState({
    paths: ['orderTour']
});

plugins.push(psState);

import tourFilter from './modules/tour-filter';
import popupGallery from './modules/popup-gallery';
import testimonials from './modules/testimonials';
import orderTour from './modules/order-tour';
import headerSearch from './modules/header-search';
import userQuestion from './modules/user-question';

const store = createStore({
    modules: {
        tourFilter,
        popupGallery,
        testimonials,
        orderTour,
        headerSearch,
        userQuestion,
    },
    plugins: plugins,
});

export default store;
