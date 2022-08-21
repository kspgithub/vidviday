<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()">
        <div class="popup-header">
            <div class="text-center">
                <span class="h2 title text-medium">Написати відгук про тур</span>
            </div>
        </div>
        <form method="post" :action="action" class="popup-align" enctype="multipart/form-data"
              @submit.prevent="onSubmit"
              ref="formRef">
            <slot/>

            <div class="have-an-account text-center">
                <span class="text" v-if="!user">{{ __('auth.have-account') }}
                    <span class="open-popup" data-rel="login-popup">{{ __('auth.entrance') }}</span>
                </span>
                <div class="img-input-wrap">
                    <div class="img-input img-input-avatar"
                         :class="{uploaded: !!selectedAvatar}"
                         @dragleave="onDragleave"
                         @dragover="onDragover"
                         @drop="onDrop">
                        <input type="file" class="vue-action" name="avatar_upload" ref="avatarRef"
                               accept=".jpg,.jpeg,.png"
                               @change.stop="onAvatarChange()">
                        <div class="text" v-if="!selectedAvatar">
                            <span><b>{{ __('forms.avatar-title') }}</b> {{ __('forms.avatar-note') }}</span>
                            <br>
                            <span v-html="__('forms.avatar-requirements')"></span>
                        </div>

                        <div class="text" v-if="selectedAvatar">
                            <div class="loaded-img">
                                <img :src="selectedAvatar.preview" alt="img">
                                <div class="btn-delete" @click="deleteAvatar()"></div>
                            </div>

                            <span>{{ __('forms.avatar-success') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <form-input name="first_name" id="tt_first_name" v-model="data.first_name" rules="required"
                                :label="__('forms.your-name')"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input name="last_name" id="tt_last_name" v-model="data.last_name" rules="required"
                                :label="__('forms.your-last-name')"
                                :tooltip="__('forms.required')"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input mask="+38 (099) 999-99-99"
                                name="phone"
                                id="tt_phone"
                                rules="tel"
                                v-model="data.phone" :label="__('forms.your-phone')"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input type="email" id="tt_email" name="email" v-model="data.email"
                                :label="__('forms.email')"/>

                </div>


                <div class="col-md-6 col-12">
					    <span class="text text-sm">
                            <b>{{ __('forms.evaluate-tour') }}</b>
                        </span>
                    <form-star-rating v-model="data.rating"/>
                </div>

                <div class="col-md-6 col-12">
                        <span class="text text-sm">
                            <b>{{ __('forms.your-guide') }}</b>
                        </span>
                    <form-custom-select name="guide_id" id="tt_guide_id" search search-text="Введіть ім'я гіда"
                                        v-model.number="data.guide_id"
                                        :placeholder="__('forms.select-from-list')">
                        <option v-for="guide in tour.guides" :value="guide.id" :data-img="guide.avatar_url">
                            {{ guide.name }}
                        </option>
                    </form-custom-select>

                </div>

                <div class="col-12">
                    <form-textarea name="text" id="tt_text" v-model="data.text" class="smile"
                                   :label="__('forms.your-feedback')"
                                   rules="required"
                                   :tooltip="__('forms.required')"/>

                </div>

                <div class="col-md-6 col-12">
                    <div class="img-input-wrap text-center-xs">
                        <div class="img-input tooltip-wrap">
                            <div class="tooltip">
                                <span class="text-medium">{{ __('forms.add-tour-photo') }}</span>
                                <div class="text text-sm">
                                    <ul>
                                        <li>{{ __('forms.max-image-size-3') }}</li>
                                        <li>{{ __('forms.max-image-count-5') }}</li>
                                    </ul>
                                </div>
                            </div>
                            <input class="vue-action" type="file" ref="imagesRef" multiple name="images_upload[]"
                                   accept=".jpg,.jpeg,.png"
                                   @change.stop="previewImages()">
                        </div>

                        <div class="loaded-img" v-for="(sImage, idx) in selectedImages">
                            <img :src="sImage.preview" alt="img">
                            <div class="btn-delete" @click="deleteImage(idx)"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12 text-right text-center-xs">
                    <vue-recaptcha v-if="popupOpen" :sitekey="sitekey"
                                   @verify="verify"
                                   ref="recaptcha"
                    >
                        <button type="submit" :disabled="invalid || request" class="btn type-1">
                            {{ __('forms.leave-feedback') }}
                        </button>
                    </vue-recaptcha>
                </div>

                <div class="text-center-xs col-12">
                    <div class="only-mobile spacer-sm"></div>
                    <span class="text-sm">{{ __('forms.required-fields') }}</span>
                </div>
            </div>
            <div class="btn-close" @click="closePopup()">
                <span></span>
            </div>
        </form>

    </popup>


</template>

<script>
import {computed, reactive, ref} from "vue";
import FormStarRating from "../form/FormStarRating";
import FormInput from "../form/FormInput";
import FormTextarea from "../form/FormTextarea";
import Popup from "../popup/Popup";
import FormCustomSelect from "../form/FormCustomSelect";
import {useStore} from "vuex";
import useTestimonialForm from "../testimonial/useTestimonialForm";
import {useForm} from "vee-validate";
import { VueRecaptcha } from 'vue-recaptcha'

export default {
    name: "TourTestimonialForm",
    components: { VueRecaptcha, FormCustomSelect, Popup, FormTextarea, FormInput, FormStarRating},
    props: {
        tour: Object,
        user: Object,
        captcha: Boolean,
        action: String,
        dataParent: Number,
    },
    setup(props) {
        const store = useStore();
        const popupOpen = computed(() => store.state.testimonials.popupOpen);
        const parentId = computed(() => store.state.testimonials.parentId);

        const formRef = ref(null);
        const recaptcha = ref(null);

        const data = reactive({
            first_name: props.user && props.user.first_name ? props.user.first_name : '',
            last_name: props.user && props.user.last_name ? props.user.last_name : '',
            phone: props.user && props.user.phone ? props.user.phone : '',
            email: props.user && props.user.email ? props.user.email : '',
            rating: 0,
            guide_id: 0,
            text: '',
            'g-recaptcha-response': '',
        });

        const {validate, errors} = useForm({
            validationSchema: {
                first_name: 'required',
                last_name: 'required',
                phone: 'tel',
                email: 'email',
            }
        })

        const testimonialForm = useTestimonialForm(data, props.action)

        const onSubmit = async (response) => {
            await testimonialForm.submitForm()
        };

        const sitekey = process.env.MIX_INVISIBLE_RECAPTCHA_SITEKEY

        const verify = (e) => {
            data['g-recaptcha-response'] = e
            onSubmit()
            recaptcha.value.reset()
        }

        return {
            ...testimonialForm,
            onSubmit,
            formRef,
            data,
            popupOpen,
            sitekey,
            recaptcha,
            verify,
        }
    }
}
</script>

<style scoped>

</style>
