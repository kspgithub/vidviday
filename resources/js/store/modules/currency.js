import { locale } from '../../i18n'

export default {
    namespaced: true,
    state() {
        return {
            current: {
                iso: 'UAH',
                course: 1.0,
                symbol: '₴',
            },
        }
    },
    mutations: {
        SET_CURRENT(state, value) {
            state.current = value
        },
    },
    getters: {
        rate: state => state.current.course,
        symbol: state => state.current.symbol,
        iso: state => state.current.iso,
        title: state => state.current.title[locale] || state.current.title.uk,
    },
}
