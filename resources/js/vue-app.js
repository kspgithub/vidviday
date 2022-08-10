import {createApp} from 'vue';

const app = createApp({});

import store from "./store";

app.use(store);

app.config.globalProperties.$isProd = store.state.isProd
app.config.globalProperties.$isDev = store.state.isDev
app.config.globalProperties.$isLocal = store.state.isLocal

import i18n from './i18n';

app.use(i18n);

import {Lang} from './i18n/lang';

// Register the plugin
app.use(Lang, {
    locale: document.documentElement.lang || 'uk',
    fallback: 'uk',
});

import directives from "./directives";

app.use(directives);


import globalComponents from "./components";

app.use(globalComponents);

require('./validation/rules');

const vm = app.mount('#app');

window.vm = vm;
