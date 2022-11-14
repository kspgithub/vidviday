import { useI18n } from 'vue-i18n'

export const useI18nLocal = options => {
    const { locale } = useI18n({ useScope: 'global' })

    const t = (key, count = '') => {
        return options.messages[locale.value][key].replace('{count}', count)
    }

    return {
        t,
        locale,
    }
}
