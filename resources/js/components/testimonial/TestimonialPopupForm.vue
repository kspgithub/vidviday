<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()">
        <div class="popup-header">
            <div class="text-center">
                <span class="h2 title text-medium">{{ __('common.write-review') }}</span>
            </div>
        </div>
        <form method="post" :action="action" class="popup-align" enctype="multipart/form-data"
              @submit.prevent="onSubmit"
              ref="formRef">
            <slot/>

            <div class="have-an-account text-center">
                <span class="text" v-if="!user">{{ __('auth.have-account') }}
                    <span class="open-popup" @click="closePopup()"
                          data-rel="login-popup">{{ __('auth.entrance') }}</span>
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

            <div v-if="errors.avatar" class="col-12">
                <div class="alert alert-danger">{{ errors.avatar }}</div>
            </div>

            <div class="row">
                <div class="col-md-6 col-12">
                    <form-input v-model="data.first_name"
                                name="first_name"
                                :label="__('forms.your-name')"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input v-model="data.last_name"
                                name="last_name"
                                :label="__('forms.your-last-name')"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-phone name="phone"
                                id="testimonial_phone"
                                v-model="data.phone"
                                :label="__('forms.your-phone')"
                    />
                </div>

                <div class="col-md-6 col-12">
                    <form-input type="email" name="email" id="testimonial_email" v-model="data.email"
                                :label="__('forms.email')"/>

                </div>
                <div class="col-12">
					    <span class="text text-sm">
                            <b>{{ __('forms.evaluate-tour') }}</b>
                        </span>
                    <form-star-rating v-model="data.rating"/>
                </div>


                <div class="col-12 col-md-6">
                    <span class="text text-sm">
                        <b>{{ __('forms.tour-where-on') }} *</b>
                    </span>

                    <form-autocomplete
                        name="tour_id"
                        :placeholder="__('forms.enter-tour-name')"
                        :search="true"
                        ref="tourSelectRef"
                        v-model.number="data.tour_id"
                        @search="searchTours"
                    >
                        <option :value="0" :selected="data.tour_id === 0" disabled>
                            {{ __('forms.select-from-list') }}
                        </option>
                        <option v-if="tour" :value="tour.id" :selected="data.tour_id === tour.id" :data-img="tour.img">
                            {{ tour.title }}
                        </option>
                        <option v-for="option in tours" :value="option.id" :data-img="option.img">{{ option.title }}</option>
                    </form-autocomplete>


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
                        @search="searchGuides"
                    >
                        <option :value="0" :selected="data.guide_id === 0" disabled>{{ __('forms.select-from-list') }}</option>
                        <option v-for="guide in guides" :value="guide.id" :data-img="guide.img">
                            {{ guide.title }}
                        </option>
                    </form-autocomplete>


                </div>
                <div class="col-12">
                    <form-textarea name="text" v-model="data.text" :label="__('forms.your-feedback')" />
                </div>

                <div v-if="errors.images" class="col-12">
                    <div class="alert alert-danger">{{ errors.images }}</div>
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
                    <vue-recaptcha v-if="useRecaptcha && popupOpen" :sitekey="sitekey"
                                   @verify="verify"
                                   @render="render"
                                   ref="recaptcha"
                    >
                        <button type="submit" :disabled="invalid || request" class="btn type-1" @click="validateForm">
                            {{ __('forms.leave-feedback') }}
                        </button>
                    </vue-recaptcha>
                    <template v-if="!useRecaptcha">
                        <button type="submit" :disabled="invalid || request" class="btn type-1" @click="validateForm">
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
import useTestimonialForm from "./useTestimonialForm";
import FormAutocomplete from "../form/FormAutocomplete";
import {autocompleteTours, fetchGuides} from "../../services/tour-service";
import {useForm} from "vee-validate";
import { __ } from "../../i18n/lang";
import { VueRecaptcha } from 'vue-recaptcha'
import FormSelect from '../form/FormSelect.vue'
import FormPhone from "../form/FormPhone";

export default {
    name: "TestimonialPopupForm",
    components: {FormPhone, FormSelect, VueRecaptcha, FormAutocomplete, FormCustomSelect, Popup, FormTextarea, FormInput, FormStarRating },
    props: {
        user: Object,
        captcha: Boolean,
        action: String,
        dataParent: Number,
    },
    setup(props) {
        const store = useStore();
        const formRef = ref(null);
        const recaptcha = ref(null);
        const tourSelectRef = ref(null);
        const guideSelectRef = ref(null);
        const tours = ref([]);
        const guides = ref([]);
        const tour = computed(() => store.state.testimonials.tour);

        const data = reactive({
            first_name: props.user && props.user.first_name ? props.user.first_name : '',
            last_name: props.user && props.user.last_name ? props.user.last_name : '',
            phone: props.user && props.user.mobile_phone ? props.user.mobile_phone : '',
            email: props.user && props.user.email ? props.user.email : '',
            rating: 5,
            tour_id: tour.value ? tour.value.id : 0,
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
                text: 'required',
                rating: 'required|numeric|min_value:1',
                tour_id: () => data.tour_id > 0 || __('validation.select-tour'),
            }
        })

        const testimonialForm = useTestimonialForm(data, props.action)

        watch(data, () => testimonialForm.request.value && (testimonialForm.request.value = false))

        const onSubmit = (event) => {
            testimonialForm.submitForm()
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
            if (e.isTrusted) {
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

        const searchTours = async (q = '') => {
            const items = await autocompleteTours(q);
            let tourItems = items || [];
            if (tour.value) {
                tourItems = [tour.value, ...tourItems];
            }
            tours.value = tourItems.map(ti => ({...ti, img: ti.main_image}));
            await nextTick(() => {
                tourSelectRef.value.update(tours.value);
            })
        }

        searchTours();

        watch(tour, () => {
            if (tour.value) {
                tours.value = [tour.value, ...tours.value];
                data.tour_id = tour.value.id;
                nextTick(() => {
                    tourSelectRef.value.update(tours.value);
                    searchGuides(data.tour_id)
                })
            }
        })

        watch(() => data.tour_id, (tour_id) => {
            nextTick(() => {
                searchGuides(tour_id)
            })
        })

        const searchGuides = async (tour_id = 0) => {
            const items = await fetchGuides(tour_id);
            guides.value = (items || []).map(it => ({...it, img: it.avatar_url, title: it.name}));
            await nextTick(() => {
                guideSelectRef.value.update(guides.value);
            })
        }

        searchGuides();

        return {
            ...testimonialForm,
            onSubmit,
            data,
            formRef,
            guides,
            tour,
            tours,
            tourSelectRef,
            searchTours,
            searchGuides,
            guideSelectRef,
            useRecaptcha,
            sitekey,
            recaptcha,
            verify,
            render,
            validateForm,
        }
    }
}
</script>
