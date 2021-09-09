import {createI18n} from 'vue-i18n';

const i18n = createI18n({
    legacy: false,
    locale: document.documentElement.lang || 'uk', // set locale
    fallbackLocale: 'uk',
});


export default i18n;
