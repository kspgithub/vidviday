import { computed, ref, watch } from "vue";
import axios from "axios";
import { getError } from "../../services/api";
import toast from "../../libs/toast";
import {useStore} from "vuex";
import { __ } from "../../i18n/lang";
import { scrollToEl } from '../../utils/functions'

export const useTestimonialForm = (data, action) => {

    const store = useStore();
    const avatarRef = ref(null);
    const imagesRef = ref(null);
    const selectedAvatar = ref(null);
    const selectedImages = ref([]);
    const dragover = ref(false);
    const parentId = computed(() => store.state.testimonials.parentId);
    const popupOpen = computed(() => store.state.testimonials.popupOpen);
    const request = computed(() => store.state.testimonials.request);
    const maxImages = 5
    const errorsTimeout = 5000
    const errors = ref({})

    watch(errors.value,
        (value) => {
            for(let key in value) {
                setTimeout(() => delete errors.value[key], errorsTimeout)
            }
        },
        {deep: true},
    )

    const previewImages = () => {
        let remainImages = Math.max(maxImages - selectedImages.value.length, 0)

        if (imagesRef.value.files.length) {
            for (let i = 0; i < imagesRef.value.files.length; i++) {
                if (selectedImages.value.length >= 5 || remainImages <= 0) {
                    errors.value.images = __('forms.max-image-count-5')
                    break;
                }
                const file = imagesRef.value.files[i];
                const reader = new FileReader();
                reader.onload = (pe) => {
                    selectedImages.value.push({preview: pe.target.result, file: file});
                }
                reader.readAsDataURL(file);
                remainImages--
            }
        } else {
            selectedImages.value = [];
            const dt = new DataTransfer();
            imagesRef.value.files = dt.files;
        }
    }

    const deleteImage = (idx) => {
        selectedImages.value.splice(idx, 1);
        const dt = new DataTransfer();
        selectedImages.value.forEach(f => {
            dt.items.add(f.file);
        });
        imagesRef.value.files = dt.files;
    }

    const onDragleave = () => {
        dragover.value = false;
    }

    const onDragover = (event) => {
        event.preventDefault();
        dragover.value = true;
    }

    const onAvatarChange = () => {
        if (avatarRef.value.files.length) {
            const file = avatarRef.value.files[0];
            const reader = new FileReader();
            reader.onload = (pe) => {
                selectedAvatar.value = {preview: pe.target.result, file: file}
            }
            reader.readAsDataURL(file);
        } else {
            deleteAvatar();
        }

    }

    const onDrop = (event) => {
        event.preventDefault();
        avatarRef.value.files = event.dataTransfer.files;
        onAvatarChange();
    }

    const deleteAvatar = () => {
        const dt = new DataTransfer();
        selectedAvatar.value = null;
        avatarRef.value.files = dt.files;
    }

    const invalid = computed(() => {
        return !data.first_name || !data.last_name || !data.text;
    })

    const submitForm = async () => {
        if (!invalid.value) {
            request.value = true;
            const formData = new FormData();
            for (let key in data) {
                formData.append(key, data[key]);
            }

            if (parentId.value > 0) {
                formData.append("parent_id", parentId.value);
            }

            if (selectedAvatar.value && selectedAvatar.value.file) {
                formData.append("avatar_upload", selectedAvatar.value.file);
            }

            if (selectedImages.value && selectedImages.value.length) {
                selectedImages.value.forEach(val => {
                    formData.append("images_upload[]", val.file);
                })
            }

            const response = await axios.post(action, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .catch(error => {
                    if (!axios.isCancel(error)) {
                        const message = getError(error);
                        // toast.error(message);

                        const serverErrors = (error.data || error.response?.data || {errors: {}}).errors
                        for(let key in serverErrors) {
                            const attrKey = key.replace('_upload', '').split('.').shift()
                            errors.value[attrKey] = Array.isArray(serverErrors[key]) ? serverErrors[key].join(',') : serverErrors[key]
                        }
                    }
                });

            if (response?.data) {
                if (response.data.result === 'success') {
                    closePopup();
                    await store.dispatch('testimonials/callback', response.data)
                    await store.dispatch('userQuestion/showThanks', {
                        title: __('popup.types.testimonial.thanks-title'),
                        message: __('popup.types.testimonial.thanks-message'),
                    })

                    if(!parentId.value) {
                        const item = response.data.testimonial || response.data.question
                        await store.commit('testimonials/PREPEND_TESTIMONIAL', item)
                    }
                } else {
                    // toast.error(response.data.message);
                }
            }

            request.value = false;
        }
    }

    const closePopup = () => {
        store.commit('testimonials/SET_POPUP_OPEN', false);
    }

    return {
        avatarRef,
        imagesRef,
        selectedAvatar,
        selectedImages,
        previewImages,
        deleteImage,
        onDragleave,
        onDragover,
        onDrop,
        onAvatarChange,
        submitForm,
        deleteAvatar,
        request,
        closePopup,
        popupOpen,
        invalid,
        errors,
    }

}

export default useTestimonialForm;
