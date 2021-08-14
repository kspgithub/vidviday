<template>
    <div class="text text-lg">
        <p>
            {{ t('found') }} <b class="text-bold">{{ totalTitle }}</b>
            <template v-if="requestTitle">&nbsp;{{ t('on_request') }} <b class="text-bold">{{ requestTitle }}</b>
            </template>
        </p>
    </div>
</template>

<script>
import {useI18nLocal} from "../../composables/useI18nLocal";
import {useStore} from "vuex";
import {computed} from "vue";
import {pluralizeValue} from "../../utils/string";

export default {
    name: "TourRequestTitle",
    setup() {
        const {t} = useI18nLocal({
            messages: {
                uk: {
                    found: 'Знайдено',
                    one_tour: 'тур',
                    two_tours: 'тура',
                    many_tours: 'турів',
                    on_request: 'по запиту:',
                },
                ru: {
                    found: 'Найдено',
                    one_tour: 'тур',
                    two_tours: 'тура',
                    many_tours: 'туров',
                    on_request: 'по запросу:',
                },
                en: {
                    found: 'Found',
                    one_tour: 'тур',
                    two_tours: 'тура',
                    many_tours: 'турів',
                    on_request: 'по запиту:',

                },
                pl: {
                    found: 'Знайдено',
                    one_tour: 'тур',
                    two_tours: 'тура',
                    many_tours: 'турів',
                    on_request: 'по запиту:',
                },
            }
        })
        const store = useStore();

        const total = computed(() => store.state.tourFilter.pagination.total);
        const requestTitle = computed(() => store.state.tourFilter.requestTitle);
        const totalTitle = computed(() => {
            return pluralizeValue(total.value, t('one_tour'), t('two_tours'), t('many_tours'));
        });

        return {
            t,
            total,
            requestTitle,
            totalTitle,
        }
    }
}
</script>

<style scoped>

</style>
