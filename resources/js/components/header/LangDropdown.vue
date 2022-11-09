<template>
    <div>
        <slot/>
    </div>
</template>

<script>
import {useI18n} from "vue-i18n";
import moment from "moment";
import {onMounted} from 'vue'

export default {
    name: "LangDropdown",
    props: {
        currentLocale: String,
    },
    setup(props) {
        const {locale} = useI18n({useScope: 'global'});
        moment.locale(locale.value);
        if (locale.value !== props.currentLocale) {
            locale.value = props.currentLocale;
        }
    }
}
</script>

<style scoped>

</style>
