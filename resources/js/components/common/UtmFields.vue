<template>
    <div>
        <input type="hidden" name="utm_campaign" :value="utm_campaign" />
        <input type="hidden" name="utm_content" :value="utm_content" />
        <input type="hidden" name="utm_medium" :value="utm_medium" />
        <input type="hidden" name="utm_source" :value="utm_source" />
        <input type="hidden" name="utm_term" :value="utm_term" />
    </div>
</template>

<script>
import * as UrlUtils from '../../utils/url'
import { useStore } from 'vuex'
import { computed } from 'vue'

export default {
    name: 'UtmFields',
    setup() {
        const store = useStore()

        const parameters = UrlUtils.parseQuery()
        const source = parameters.utm_source || ''

        if (source) {
            store.commit('analytics/SET_UTM_FIELDS', {
                utm_source: source,
                utm_campaign: parameters.utm_campaign || '',
                utm_content: parameters.utm_content || '',
                utm_medium: parameters.utm_medium || '',
                utm_term: parameters.utm_term || '',
            })
        }

        const utm_source = computed(() => store.state.analytics.utm.utm_source)
        const utm_campaign = computed(() => store.state.analytics.utm.utm_campaign)
        const utm_content = computed(() => store.state.analytics.utm.utm_content)
        const utm_medium = computed(() => store.state.analytics.utm.utm_medium)
        const utm_term = computed(() => store.state.analytics.utm.utm_term)

        return {
            utm_campaign,
            utm_content,
            utm_medium,
            utm_source,
            utm_term,
        }
    },
}
</script>

<style scoped></style>
