<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()">
        <div class="popup-header">
            <div class="text-center">
                <span class="h2 title text-medium">{{ __('tours-section.write-testimonial') }}</span>
            </div>
        </div>
        <form method="post" :action="action" class="popup-align" enctype="multipart/form-data"
              @submit.prevent="onSubmit"
              ref="formRef"
        >
            <slot/>

            <div class="have-an-account text-center">
                <span class="text" v-if="!user">{{ __('auth.have-account') }}
                    <span class="open-popup" @click="closePopup()"
                          data-rel="login-popup">{{ __('auth.entrance') }}</span>
                </span>
                <div :style="[user ? { 'display': 'none' } : '']" class="img-input-wrap">
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
                                <seo-button code="testimonial.delete_avatar" class="btn-delete" @click="deleteAvatar()"></seo-button>
                            </div>

                            <span>{{ __('forms.avatar-success') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="errors.avatar" class="col-12">
                <div class="alert alert-danger">{{errors.avatar}}</div>
            </div>

            <div class="row">
                <div :style="[user ? { 'display': 'none' } : '']" class="col-md-6 col-12">
                    <form-input name="first_name" id="tt_first_name" v-model="data.first_name"
                                :label="__('forms.your-name')"/>
                </div>

                <div :style="[user ? { 'display': 'none' } : '']" class="col-md-6 col-12">
                    <form-input name="last_name" id="tt_last_name" v-model="data.last_name"
                                :label="__('forms.your-last-name')"
                                :tooltip="__('forms.required')"/>
                </div>

                <div :style="[user ? { 'display': 'none' } : '']" class="col-md-6 col-12">
                    <form-phone name="phone"
                                id="tt_phone"
                                v-model="data.phone" :label="__('forms.your-phone')"/>
                </div>

                <div :style="[user ? { 'display': 'none' } : '']" class="col-md-6 col-12">
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


                    <form-autocomplete
                        name="guide_id"
                        :placeholder="__('forms.enter-guide-name')"
                        :search="true"
                        ref="guideSelectRef"
                        v-model.number="data.guide_id"
                    >
                        <option :value="0" :selected="data.guide_id === 0" disabled>{{ __('forms.select-from-list') }}</option>
                        <option v-for="guide in guides" :value="guide.id" :data-img="guide.img">
                            {{ guide.title }}
                        </option>
                    </form-autocomplete>

                </div>

                <div class="col-12">
                    <form-textarea name="text" id="tt_text" v-model="data.text" class="smile"
                                   :label="__('forms.your-feedback')"/>

                </div>

                <div v-if="errors.images" class="col-12">
                    <div class="alert alert-danger">{{errors.images}}</div>
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
                            <seo-button code="testimonial.delete_image" class="btn-delete" @click.stop="deleteImage(idx)"></seo-button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12 text-right text-center-xs">
                    <vue-recaptcha v-if="useRecaptcha && popupOpen" :sitekey="sitekey"
                                   @verify="verify"
                                   @render="render"
                                   ref="recaptcha"
                    >
                        <button v-bind="$buttons('tour.testimonial')" type="submit" :disabled="invalid || request" class="btn type-1" @click="validateForm">
                            {{ __('forms.leave-feedback') }}
                        </button>
                    </vue-recaptcha>
                    <template v-if="!useRecaptcha">
                        <button v-bind="$buttons('tour.testimonial')" type="submit" :disabled="invalid || request" class="btn type-1" @click="validateForm">
                            {{ __('forms.leave-feedback') }}
                        </button>
                    </template>
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
import { computed, nextTick, onMounted, reactive, ref, watch } from "vue";
import FormStarRating from "../form/FormStarRating";
import FormInput from "../form/FormInput";
import FormTextarea from "../form/FormTextarea";
import Popup from "../popup/Popup";
import FormCustomSelect from "../form/FormCustomSelect";
import {useStore} from "vuex";
import useTestimonialForm from "../testimonial/useTestimonialForm";
import {useForm} from "vee-validate";
import { VueRecaptcha } from 'vue-recaptcha'
import FormSelect from '../form/FormSelect.vue'
import { __ } from '../../i18n/lang.js'
import FormAutocomplete from '../form/FormAutocomplete.vue'
import { fetchGuides } from '../../services/tour-service.js'
import FormPhone from "../form/FormPhone";

export default {
    name: "TourTestimonialForm",
    components: {FormPhone, FormAutocomplete, FormSelect, VueRecaptcha, FormCustomSelect, Popup, FormTextarea, FormInput, FormStarRating },
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
        const guides = ref([])
        const formRef = ref(null);
        const recaptcha = ref(null);
        const guideSelectRef = ref(null);

        const data = reactive({
            first_name: props.user && props.user.first_name ? props.user.first_name : '',
            last_name: props.user && props.user.last_name ? props.user.last_name : '',
            phone: props.user && props.user.mobile_phone ? props.user.mobile_phone : '',
            email: props.user && props.user.email ? props.user.email : '',
            rating: 5,
            guide_id: 0,
            text: '',
            'g-recaptcha-response': '',
        });

        const {validate, errors} = useForm({
            validationSchema: {
                first_name: 'required',
                last_name: 'required',
                phone: 'required|tel',
                email: 'required|email',
                text: 'required|max:5000',
                rating: 'required|numeric|min_value:1',
            }
        })

        const testimonialForm = useTestimonialForm(data, props.action)

        watch(data, () => testimonialForm.request.value && (testimonialForm.request.value = false))

        const onSubmit = async (response) => {
            await testimonialForm.submitForm()
        };

        const useRecaptcha = String(process.env.MIX_INVISIBLE_RECAPTCHA_ENABLED) === 'true'
        const sitekey = process.env.MIX_INVISIBLE_RECAPTCHA_SITEKEY

        const verify = (e) => {
            data['g-recaptcha-response'] = e
            onSubmit()
            recaptcha.value.reset()
        }

        const render = (e) => {
            setTimeout(() => {
                const htmlOffset = $('html').css('top')

                if (htmlOffset) {
                    const layout = $('iframe[title*="recaptcha"]')
                    layout.css('margin-top', htmlOffset.replace('-', ''))
                    layout.parent().css('overflow', 'visible')
                }
            }, 1000)
        }

        const validateForm = async (e) => {
            if(e.isTrusted) {
                e.stopImmediatePropagation()
                e.preventDefault()

                const result = await validate();
                if (!result.valid) {
                    return false
                } else {
                    e.target.dispatchEvent(new e.constructor(e.type, e))
                }
            }
        }

        onMounted(() => {
            guides.value = props.tour.guides.map(it => ({...it, img: it.avatar_url, title: it.name}))
            guideSelectRef.value.update(guides.value)
        })

        return {
            ...testimonialForm,
            onSubmit,
            formRef,
            data,
            popupOpen,
            useRecaptcha,
            sitekey,
            recaptcha,
            verify,
            render,
            validateForm,
            guideSelectRef,
            guides,
        }
    }
}
</script>

<style scoped>

</style>
