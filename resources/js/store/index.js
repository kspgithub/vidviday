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

const store = createStore({
    modules: {
        tourFilter,
    },
    plugins: plugins,
});

export default store;
