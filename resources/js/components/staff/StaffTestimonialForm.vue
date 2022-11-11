<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()">
        <div v-if="showForm" class="popup-header">
            <div class="text-center">
                <span v-if="type === 'guide'" class="h2 title text-medium">{{
                    __('popup.testimonial.write-guide')
                }}</span>
                <span v-if="type === 'worker'" class="h2 title text-medium">{{
                    __('popup.testimonial.write-worker')
                }}</span>
            </div>
        </div>
        <form v-if="showForm" method="post" :action="action" class="popup-align" enctype="multipart/form-data">
            <slot />
            <div class="have-an-account text-center">
                <span v-if="!user" class="text"
                    >{{ __('auth.have-account') }}
                    <span class="open-popup" data-rel="login-popup" @click="closePopup()">{{
                        __('auth.entrance')
                    }}</span>
                </span>
                <div class="img-input-wrap">
                    <div
                        class="img-input img-input-avatar"
                        :class="{ uploaded: !!selectedAvatar }"
                        @dragleave="onDragleave"
                        @dragover="onDragover"
                        @drop="onDrop"
                    >
                        <input
                            ref="avatarRef"
                            type="file"
                            class="vue-action"
                            name="avatar_upload"
                            accept=".jpg,.jpeg,.png"
                            @change.stop="onAvatarChange()"
                        />
                        <div v-if="!selectedAvatar" class="text">
                            <span
                                ><b>{{ __('forms.avatar-title') }}</b> {{ __('forms.avatar-note') }}</span
                            >
                            <br />
                            <span v-html="__('forms.avatar-requirements')"></span>
                        </div>

                        <div v-if="selectedAvatar" class="text">
                            <div class="loaded-img">
                                <img :src="selectedAvatar.preview" alt="img" />
                                <div class="btn-delete" @click="deleteAvatar()"></div>
                            </div>

                            <span>{{ __('forms.avatar-success') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <form-input v-model="data.first_name" name="first_name" :label="__('forms.your-name')" />
                </div>

                <div class="col-md-6 col-12">
                    <form-input
                        v-model="data.last_name"
                        name="last_name"
                        :label="__('forms.your-last-name')"
                        :tooltip="__('forms.required')"
                    />
                </div>

                <div class="col-md-6 col-12">
                    <form-input
                        v-model="data.phone"
                        mask="+38 (099) 999-99-99"
                        name="phone"
                        :label="__('forms.your-phone')"
                    />
                </div>

                <div class="col-md-6 col-12">
                    <form-input v-model="data.email" type="email" name="email" :label="__('forms.email')" />
                </div>

                <div class="col-12">
                    <span class="text text-sm">
                        <b>{{ __('forms.tour-where-on') }}</b>
                    </span>
                    <form-custom-select
                        v-model.number="data.tour_id"
                        name="tour_id"
                        search
                        :search-text="__('forms.enter-tour-name')"
                        :placeholder="__('forms.select-from-list')"
                    >
                        <option v-for="tour in tours" :value="tour.id">
                            {{ tour.title }}
                        </option>
                    </form-custom-select>
                </div>

                <div class="col-12">
                    <form-textarea
                        v-model="data.text"
                        name="text"
                        class="smile"
                        :label="__('forms.your-feedback')"
                        :tooltip="__('forms.required')"
                    />
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
                            <input
                                ref="imagesRef"
                                class="vue-action"
                                type="file"
                                multiple
                                name="images_upload[]"
                                accept=".jpg,.jpeg,.png"
                                @change.stop="previewImages()"
                            />
                        </div>

                        <div v-for="(sImage, idx) in selectedImages" class="loaded-img">
                            <img :src="sImage.preview" alt="img" />
                            <div class="btn-delete" @click="deleteImage(idx)"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12 text-right text-center-xs">
                    <button type="submit" :disabled="invalid || request" class="btn type-1" @click="submitForm">
                        {{ __('forms.leave-feedback') }}
                    </button>
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

        <div v-if="showThanks" class="popup-align">
            <div class="img done">
                <img src="/icon/done.svg" alt="done" />
            </div>
            <div class="text-center">
                <div class="spacer-xs"></div>
                <span class="h2 title text-medium">{{ __('popup.testimonial.thank-you') }}</span>
                <br />
                <div class="spacer-xs"></div>
                <span class="btn type-1" @click="closePopup()">
                    {{ __('popup.return') }}
                </span>
            </div>
            <div class="btn-close" @click="closePopup()">
                <span></span>
            </div>
        </div>
    </popup>
</template>

<script>
import { computed, reactive, ref } from 'vue'
import FormStarRating from '../form/FormStarRating'
import FormInput from '../form/FormInput'
import FormTextarea from '../form/FormTextarea'
import axios from 'axios'
import { getError } from '../../services/api'
import toast from '../../libs/toast'
import Popup from '../popup/Popup'
import FormCustomSelect from '../form/FormCustomSelect'
import { useStore } from 'vuex'

export default {
    name: 'StaffTestimonialForm',
    components: { FormCustomSelect, Popup, FormTextarea, FormInput, FormStarRating },
    props: {
        type: String,
        staff: Object,
        user: Object,
        action: String,
        dataParent: Number,
        tours: Array,
    },
    setup(props) {
        const store = useStore()
        const popupOpen = computed(() => store.state.testimonials.popupOpen)
        const parentId = computed(() => store.state.testimonials.parentId)

        const avatarRef = ref(null)
        const imagesRef = ref(null)

        const selectedAvatar = ref(null)
        const selectedImages = ref([])
        const dragover = ref(false)
        const request = ref(false)

        const showForm = ref(true)
        const showThanks = ref(false)

        const data = reactive({
            first_name: props.user && props.user.first_name ? props.user.first_name : '',
            last_name: props.user && props.user.last_name ? props.user.last_name : '',
            phone: props.user && props.user.mobile_phone ? props.user.mobile_phone : '',
            email: props.user && props.user.email ? props.user.email : '',
            rating: 5,
            tour_id: 0,
            text: '',
        })

        const previewImages = () => {
            if (imagesRef.value.files.length) {
                for (let i = 0; i < imagesRef.value.files.length; i++) {
                    if (selectedImages.value.length >= 5) break
                    const file = imagesRef.value.files[i]
                    const reader = new FileReader()
                    reader.onload = pe => {
                        selectedImages.value = [...selectedImages.value, { preview: pe.target.result, file: file }]
                    }
                    reader.readAsDataURL(file)
                }
            } else {
                selectedImages.value = []
                const dt = new DataTransfer()
                imagesRef.value.files = dt.files
            }
        }

        const deleteImage = idx => {
            selectedImages.value.splice(idx, 1)
            const dt = new DataTransfer()
            selectedImages.value.forEach(f => {
                dt.items.add(f.file)
            })
            imagesRef.value.files = dt.files
        }

        const onDragleave = () => {
            dragover.value = false
        }

        const onDragover = event => {
            event.preventDefault()
            dragover.value = true
        }

        const onAvatarChange = () => {
            if (avatarRef.value.files.length) {
                const file = avatarRef.value.files[0]
                const reader = new FileReader()
                reader.onload = pe => {
                    selectedAvatar.value = { preview: pe.target.result, file: file }
                }
                reader.readAsDataURL(file)
            } else {
                deleteAvatar()
            }
        }

        const onDrop = event => {
            event.preventDefault()
            avatarRef.value.files = event.dataTransfer.files
            onAvatarChange()
        }

        const deleteAvatar = () => {
            const dt = new DataTransfer()
            selectedAvatar.value = null
            avatarRef.value.files = dt.files
        }

        const invalid = computed(() => {
            return !data.first_name || !data.last_name || !data.text
        })

        const submitForm = async event => {
            if (invalid.value) {
                event.preventDefault()
            } else {
                request.value = true
                const formData = new FormData()
                for (let key in data) {
                    formData.append(key, data[key])
                }

                if (parentId.value > 0) {
                    formData.append('parent_id', parentId.value)
                }

                if (selectedAvatar.value && selectedAvatar.value.file) {
                    formData.append('avatar_upload', selectedAvatar.value.file)
                }

                if (selectedImages.value && selectedImages.value.length) {
                    selectedImages.value.forEach(val => {
                        formData.append('images_upload[]', val.file)
                    })
                }

                const response = await axios
                    .post(props.action, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                        },
                    })
                    .catch(error => {
                        if (!axios.isCancel(error)) {
                            const message = getError(error)
                            toast.error(message)
                        }
                    })

                if (response.data) {
                    if (response.data.result === 'success') {
                        showForm.value = false
                        showThanks.value = true
                    } else {
                        toast.error(response.data.message)
                    }
                }

                request.value = false
            }
        }

        const closePopup = () => {
            store.commit('testimonials/SET_POPUP_OPEN', false)
            showForm.value = true
            showThanks.value = false
        }

        return {
            avatarRef,
            imagesRef,
            selectedAvatar,
            selectedImages,
            data,
            previewImages,
            deleteImage,
            onDragleave,
            onDragover,
            onDrop,
            onAvatarChange,
            submitForm,
            deleteAvatar,
            invalid,
            request,
            showForm,
            showThanks,
            closePopup,
            popupOpen,
        }
    },
}
</script>

<style scoped></style>
