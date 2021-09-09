import {createStore, createLogger} from "vuex";


const plugins = [];

console.log(process.env.NODE_ENV);

if (process.env.NODE_ENV !== 'production') {
    const logger = createLogger();
    plugins.push(logger);
}

// import createPersistedState from "vuex-persistedstate";
//
//
// const psState = createPersistedState({
//     paths: []
// });
//
// plugins.push(psState);

import tourFilter from './modules/tour-filter';
import popupGallery from './modules/popup-gallery';
import testimonials from './modules/testimonials';

const store = createStore({
    modules: {
        tourFilter,
        popupGallery,
        testimonials,
    },
    plugins: plugins,
});

export default store;
