<template>
    <form action="/" class="new-review">
        <template v-if="currentUser.id">
            <div class="review-img">
                <img v-if="currentUser.avatar || !currentUser.initials"
                     :src="currentUser.avatar_url"
                     :alt="currentUser.name">
                <div v-if="!currentUser.avatar && !!currentUser.initials" class="full-size h4">
                    {{ currentUser.initials }}
                </div>
            </div>

            <form-textarea v-model="text" :label="__('forms.leave-comment')" name="text" :id="'t-answer-'+item.id"/>

        </template>

        <template v-else>

            <div class="row">

                <div class="col-md-6 col-12">
                    <form-input name="first_name" id="tt_first_name" v-model="first_name"
                                :label="__('forms.your-name')"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input name="last_name" id="tt_last_name" v-model="last_name"
                                :label="__('forms.your-last-name')"
                                :tooltip="__('forms.required')"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-phone name="phone"
                                id="tt_phone"
                                v-model="phone" :label="__('forms.your-phone')"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input type="email" id="tt_email" name="email" v-model="email"
                                :label="__('forms.email')"/>
                </div>
            </div>
            <form-textarea v-model="text" :label="__('forms.leave-comment')" name="text" :id="'t-answer-'+item.id"/>

        </template>

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
import FormInput from "../form/FormInput";
import FormPhone from "../form/FormPhone";

export default {
    name: "TestimonialAnswer",
    components: {FormPhone, FormInput, FormTextarea},
    props: {
        item: Object,
        type: String,
    },
    emits: ['cancel', 'success'],
    setup(props, {emit}) {
        const store = useStore();
        const currentUser = computed(() => store.state.user.currentUser || {});
        const text = ref('');
        const email = ref('');
        const phone = ref('');
        const first_name = ref('');
        const last_name = ref('');
        const cancel = () => emit('cancel');
        const success = () => emit('success', {
            text: text.value,
            email: email.value,
            phone: phone.value,
            first_name: first_name.value,
            last_name: last_name.value,
        });

        return {
            currentUser,
            text,
            email,
            phone,
            first_name,
            last_name,
            cancel,
            success,
        }

    }
}
</script>

<style scoped>

</style>
