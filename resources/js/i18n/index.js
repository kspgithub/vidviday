import { createI18n } from 'vue-i18n'

export const locale = document.documentElement.lang || 'uk'
export const fallbackLocale = 'uk'

const i18n = createI18n({
    legacy: false,
    locale: locale, // set locale
    fallbackLocale: fallbackLocale,
})

export default i18n
