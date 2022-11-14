import { createStore, createLogger } from 'vuex'

const plugins = []

const isProd = window.APP_ENV === 'production'
const isDev = window.APP_ENV === 'development'
const isLocal = window.APP_ENV === 'local'

if (isProd && false) {
    const logger = createLogger()
    plugins.push(logger)
}

import createPersistedState from 'vuex-persistedstate'

const psState = createPersistedState({
    paths: ['orderTour'],
})

plugins.push(psState)

import tourFilter from './modules/tour-filter'
import tourQuestion from './modules/tour-question'
import popupGallery from './modules/popup-gallery'
import testimonials from './modules/testimonials'
import orderTour from './modules/order-tour'
import orderCertificate from './modules/order-certificate'
import headerSearch from './modules/header-search'
import userQuestion from './modules/user-question'
import user from './modules/user'
import analytics from './modules/analytics'
import profileOrders from './modules/profile-orders'
import currency from './modules/currency'

const store = createStore({
    state: {
        isProd,
        isDev,
        isLocal,
    },
    modules: {
        tourFilter,
        tourQuestion,
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
})

export default store
