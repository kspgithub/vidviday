import { TranslateResult } from 'vue-i18n'

declare global {

    function __(key: string, named?: Record<string, unknown>): TranslateResult

    interface Window {

    }
}

declare module '@vue/runtime-core' {
    export interface ComponentCustomProperties {
        __: typeof __
    }
}

export  {}
