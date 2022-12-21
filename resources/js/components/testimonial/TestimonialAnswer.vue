<template>
    <form action="/" class="new-review">
        <div class="review-img">
            <img v-if="currentUser.avatar || !currentUser.initials"
                 :src="currentUser.avatar_url"
                 :alt="currentUser.name">
            <div v-if="!currentUser.avatar && !!currentUser.initials" class="full-size h4">
                {{ currentUser.initials }}
            </div>
        </div>
        <form-textarea v-model="text" :label="__('forms.leave-comment')" name="text" :id="'t-answer-'+item.id"/>
        <div class="text-right">
            <span class="btn type-3" @click="cancel()">{{ __('forms.cancel') }}</span>
            <span class="btn type-1" @click="success()">{{ __('forms.reply') }}</span>
        </div>
    </form>
</template>

<script>
import {useStore} from "vuex";
import {computed, ref} from "vue";
import FormTextarea from "../form/FormTextarea";

export default {
    name: "TestimonialAnswer",
    components: {FormTextarea},
    props: {
        item: Object,
        type: String,
    },
    emits: ['cancel', 'success'],
    setup(props, {emit}) {
        const store = useStore();
        const currentUser = computed(() => store.state.user.currentUser || {});
        const text = ref('');
        const cancel = () => emit('cancel');
        const success = () => emit('success', text.value);
        return {
            currentUser,
            text,
            cancel,
            success,
        }

    }
}
</script>

<style scoped>

</style>
