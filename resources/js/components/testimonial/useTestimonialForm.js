import {computed, ref} from "vue";
import axios from "axios";
import {getError} from "../../services/api";
import toast from "../../libs/toast";
import {useStore} from "vuex";

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

    const previewImages = () => {

        if (imagesRef.value.files.length) {
            const uploadedCount = selectedImages.value.length
            const remainCount = Math.max(5 - uploadedCount, 0)
            const limitFiles = [...imagesRef.value.files]
            limitFiles.splice(remainCount)

            if(limitFiles.length) {
                for (let i = 0; i < limitFiles.length; i++) {
                    const file = limitFiles[i];
                    const reader = new FileReader();
                    reader.onload = (pe) => {
                        selectedImages.value = [...selectedImages.value, {preview: pe.target.result, file: file}];
                    }
                    reader.readAsDataURL(file);
                }
            } else {

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
                        toast.error(message);
                    }
                });


            if (response?.data) {
                if (response.data.result === 'success') {
                    closePopup();
                    await store.dispatch('userQuestion/showThanks', {
                        title: 'Дякуємо за ваш відгук'
                    })
                } else {
                    toast.error(response.data.message);
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
    }

}

export default useTestimonialForm;
