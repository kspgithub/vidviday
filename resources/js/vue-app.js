import {createApp} from 'vue';
import store from "./store";
import i18n from './i18n';

import {Lang} from './i18n/lang';

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

    app.config.globalProperties.$isProd = store.state.isProd
    app.config.globalProperties.$isDev = store.state.isDev
    app.config.globalProperties.$isLocal = store.state.isLocal

    app.use(i18n);

    app.component('test-component', {
        template: '<div>Test me! {{$props}}</div>',
        props: {
            foo: {}
        }
    })

    // Register the plugin
    app.use(Lang, {
        locale: document.documentElement.lang || 'uk',
        fallback: 'uk',
    });

    app.use(directives);

    app.use(globalComponents);

    return {
        app
    }
}
