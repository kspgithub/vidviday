import { TranslateResult } from 'vue-i18n'

declare global {

    type ReplaceProps = 'provider' | 'model'

    function __(key: string, named?: Record<ReplaceProps, string>): TranslateResult

    function $buttons(key: string, id: number): Record<string, string>

    interface Window {

    }
}

declare module '@vue/runtime-core' {
    export interface ComponentCustomProperties {
        __: typeof __
        $buttons: typeof $buttons
    }
}

export  {}
