<template>
    <div id="tour-voting-form" class="sidebar-item testimonials vote">
        <div class="top-part b-border">
            <div class="title h3 title-icon">
                <img src="/img/preloader.png" data-src="icon/done.svg" alt="done">
                <span>{{ __('tours-section.voting') }}</span>
            </div>
            <div class="spacer-xs"></div>
            <hr>
            <div class="spacer-xs"></div>
            <div class="text">
                {{ __('tours-section.want-to-vote') }} - <b>{{tour.votings_count}} {{ $lang().choice('tours-section.persons', tour.votings_count) }}</b>
             </div>
            <div class="spacer-xs"></div>
            <form @submit.prevent="onSubmit">

                <form-input name="name" v-model="form.name"
                            :label="__('forms.your-name')"/>

                <form-input name="tel" v-model="form.phone" mask="+38 (999) 999-99-99"
                            :label="__('forms.your-phone')"/>

                <form-input name="email" v-model="form.email"
                            :label="__('forms.your-email')"/>

                <seo-button code="tour.vote" type="submit" class="btn type-1 btn-block" :disabled="submitted">
                    {{ __('tours-section.vote') }}
                </seo-button>

            </form>
        </div>
    </div>
</template>

<script>
import { useStore } from 'vuex'
import { computed, reactive, ref } from 'vue'
import { getError } from '../../services/api.js'
import FormInput from '../form/FormInput.vue'
import SeoButton from '../common/SeoButton.vue'

export default {
    name: 'TourVotingForm',
    components: {SeoButton, FormInput },
    props: {
        tour: Object,
    },
    setup(props) {
        const store = useStore()
        const submitted = ref(false)
        const user = store.state.user.currentUser

        const form = reactive({
            name: user ? (user.first_name + ' ' + user.last_name) : '',
            phone: user ? user.mobile_phone : '',
            email: user ? user.email : '',
        })

        const onSubmit = async () => {
            const response = await axios.post(`/tour/${props.tour.id}/vote`, form)
                .catch(error => {
                    const message = getError(error);
                    toast.error(message);
                });

            if(response) {
                submitted.value = true;

                if (response.data.result === 'success') {
                    props.tour.votings_count++

                    if (window._functions) {
                        window._functions.showPopup('thanks-popup');
                    } else {
                        toast.success(response.data.message);
                    }
                } else {
                    toast.error(response.data.message);
                }
            }
        }

        return {
            submitted,
            form,
            onSubmit,
        }
    }
}
</script>
