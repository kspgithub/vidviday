import {createApp} from 'vue';
import store from "./store";
import i18n from './i18n';
import {Lang} from './i18n/lang';
import SvgVue from 'svg-vue3';

import directives from "./directives";

import globalComponents from "./components";

export function createVueApp(options = {}) {
    const app = createApp({
        mounted() {
            window.dispatchEvent(new CustomEvent('vueMounted', {
                detail: this,
            }))
        },
        ...options,
    });

    app.use(store);

    window.$isProd = app.config.globalProperties.$isProd = store.state.isProd
    window.$isDev = app.config.globalProperties.$isDev = store.state.isDev
    window.$isLocal = app.config.globalProperties.$isLocal = store.state.isLocal
    window.$buttons = app.config.globalProperties.$buttons = (key) => {
        return window.seoButtons[key] || {}
    }

    app.use(i18n);

    // Register the plugin
    app.use(Lang, {
        locale: document.documentElement.lang || 'uk',
        fallback: 'uk',
    });

    app.use(SvgVue);

    app.use(directives);

    app.use(globalComponents);

    app.mixin({
        methods: {
            log(...data) {
                console.log(...data)
            }
        }
    })

    return {
        app
    }
}
