import {createStore, createLogger} from "vuex";


const plugins = [];


if (process.env.NODE_ENV !== 'production') {
    const logger = createLogger();
    plugins.push(logger);
}

import createPersistedState from "vuex-persistedstate";


const psState = createPersistedState({
    paths: ['orderTour', 'orderCertificate', 'user']
});

plugins.push(psState);

import tourFilter from './modules/tour-filter';
import popupGallery from './modules/popup-gallery';
import testimonials from './modules/testimonials';
import orderTour from './modules/order-tour';
import orderCertificate from './modules/order-certificate';
import headerSearch from './modules/header-search';
import userQuestion from './modules/user-question';
import user from './modules/user';
import analytics from './modules/analytics';
import profileOrders from './modules/profile-orders';
import currency from './modules/currency';

const store = createStore({
    modules: {
        tourFilter,
        popupGallery,
        testimonials,
        orderTour,
        orderCertificate,
        headerSearch,
        userQuestion,
        user,
        analytics,
        profileOrders,
        currency,
    },
    plugins: plugins,
});

export default store;
