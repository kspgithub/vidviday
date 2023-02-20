require('./bootstrap');

window.$ = window.jQuery = require('jquery');

require('./libs/jquery-ui.min');

window.Swiper = require('./libs/swiper.min');

require('./libs/jquery.sumoselect.min');

require('./libs/jquery.inputmask.min');

// require('./libs/SmoothScroll');

require('./libs/datepicker.min');

// require('./libs/calendar');

require('./libs/global');

// require('./libs/markerclusterer');
// require('./libs/infobox');
// require('./libs/map');
require('./libs/toast');
require('./libs/sharer');
require('./libs/moreLess');

const { createVueApp } = require('./vue-app');

const { app } = createVueApp();

require('./validation/rules');

window.vm = app.mount('#app');
