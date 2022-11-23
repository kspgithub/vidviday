require('./bootstrap');

window.$ = window.jQuery = require('jquery');

require('./libs/jquery-ui.min');

window.Swiper = require('./libs/swiper.min');

require('./libs/jquery.sumoselect.min');

require('./libs/jquery.inputmask.min');

require('./libs/SmoothScroll');

require('./libs/datepicker.min');

// require('./libs/calendar');

require('./libs/global');

// require('./libs/markerclusterer');
// require('./libs/infobox');
// require('./libs/map');
// require('./libs/map-route');
require('./libs/toast');
require('./libs/sharer');
require('./libs/moreLess');

window.vm = require('./vue-app');

window.addEventListener('load', function (event) {
    console.log('Event: window.load')
})

if('moreLess' in window) {
    document.addEventListener('DOMContentLoaded', () => {
        console.log('Event: document.DOMContentLoaded')

        if (document.getElementById('seo-shorten-text')?.offsetHeight > 180) {
                moreLess('shorten-text', '150px', {
                    textMore: window.vm.__('Read more'),
                    textLess: window.vm.__('Hide text'),
                });
        }
    })
}
