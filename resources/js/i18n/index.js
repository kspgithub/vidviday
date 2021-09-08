import {createI18n} from 'vue-i18n';

const i18n = createI18n({
    legacy: false,
    locale: document.documentElement.lang || 'uk', // set locale
    fallbackLocale: 'en',
});


export default i18n;
