import {createApp} from 'vue';

const app = createApp({});


import store from "./store";

app.use(store);


import i18n from './i18n';

app.use(i18n);

import directives from "./directives";

app.use(directives);


import globalComponents from "./components";

app.use(globalComponents);


require('./validation/rules');

const vm = app.mount('#app');

window.vm = vm;
