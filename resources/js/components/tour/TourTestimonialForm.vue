<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()">
        <div class="popup-header" v-if="showForm">
            <div class="text-center">
                <span class="h2 title text-medium">Написати відгук про тур</span>
            </div>
        </div>
        <form method="post" :action="action" class="popup-align" enctype="multipart/form-data" v-if="showForm">
            <slot/>
            <div class="have-an-account text-center">
                    <span class="text" v-if="!user">Уже є аккаунт?
                        <span class="open-popup" data-rel="login-popup">Вхід</span>
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
                            <span><b>Ваша фотографія</b> (перетягніть файл сюди або натисніть для вибору)</span>
                            <br>
                            <span>Це повинен бути файл формату <b>JPG/PNG, 200×200 пікс.</b>, розміром не більше <b>5 МБ</b></span>
                        </div>

                        <div class="text" v-if="selectedAvatar">
                            <div class="loaded-img">
                                <img :src="selectedAvatar.preview" alt="img">
                                <div class="btn-delete" @click="deleteAvatar()"></div>
                            </div>

                            <span>Фото успішно завантажено</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <form-input name="first_name" v-model="data.first_name" rules="required" label="Ваше ім’я"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input name="last_name" v-model="data.last_name" rules="required" label="Ваше прізвище"
                                tooltip="Поле обов'язкове для заповнення"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input mask="+38 (099) 999-99-99"
                                name="phone"
                                rules="tel"
                                v-model="data.phone" label="Ваш телефон"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input type="email" name="email" v-model="data.email" label="Email"/>

                </div>


                <div class="col-md-6 col-12">
					    <span class="text text-sm">
                            <b>Оцініть тур</b>
                        </span>
                    <form-star-rating v-model="data.rating"/>
                </div>

                <div class="col-md-6 col-12">
                        <span class="text text-sm">
                            <b>Ваш гід</b>
                        </span>
                    <form-custom-select name="guide_id" search search-text="Введіть ім'я гіда"
                                        v-model.number="data.guide_id"
                                        placeholder="Оберіть зі списку">
                        <option v-for="guide in tour.guides" :value="guide.id" :data-img="guide.avatar_url">
                            {{ guide.name }}
                        </option>
                    </form-custom-select>

                </div>

                <div class="col-12">
                    <form-textarea name="text" v-model="data.text" class="smile" label="Ваш відгук" rules="required"
                                   tooltip="Поле обов'язкове для заповнення"/>

                </div>

                <div class="col-md-6 col-12">
                    <div class="img-input-wrap text-center-xs">
                        <div class="img-input tooltip-wrap">
                            <div class="tooltip">
                                <span class="text-medium">Додати фото з туру:</span>
                                <div class="text text-sm">
                                    <ul>
                                        <li>макс. розмір зображення 3 МБ</li>
                                        <li>макс. кількість зображень — 5</li>
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
                    <button type="submit" :disabled="invalid || request" @click="submitForm" class="btn type-1">
                        Залишити відгук
                    </button>
                </div>

                <div class="text-center-xs col-12">
                    <div class="only-mobile spacer-sm"></div>
                    <span class="text-sm">* обов’язкове для заповнення поле</span>
                </div>
            </div>
            <div class="btn-close" @click="closePopup()">
                <span></span>
            </div>
        </form>

        <div class="popup-align" v-if="showThanks">
            <div class="img done">
                <img src="/icon/done.svg" alt="done">
            </div>
            <div class="text-center">
                <div class="spacer-xs"></div>
                <span class="h2 title text-medium">Дякуємо за ваш відгук</span>
                <br>
                <div class="spacer-xs"></div>
                <span class="btn type-1" @click="closePopup()">Повернутись на сайт</span>
            </div>
            <div class="btn-close" @click="closePopup()">
                <span></span>
            </div>
        </div>
    </popup>


</template>

<script>
import {computed, reactive, ref} from "vue";
import FormStarRating from "../form/FormStarRating";
import FormInput from "../form/FormInput";
import FormTextarea from "../form/FormTextarea";
import axios from "axios";
import {getError} from "../../services/api";
import toast from "../../libs/toast";
import Popup from "../popup/Popup";
import FormCustomSelect from "../form/FormCustomSelect";
import {useStore} from "vuex";

export default {
    name: "TourTestimonialForm",
    components: {FormCustomSelect, Popup, FormTextarea, FormInput, FormStarRating},
    props: {
        tour: Object,
        user: Object,
        action: String,
        dataParent: Number,
    },
    setup(props) {
        const store = useStore();
        const popupOpen = computed(() => store.state.testimonials.popupOpen);
        const parentId = computed(() => store.state.testimonials.parentId);

        const avatarRef = ref(null);
        const imagesRef = ref(null);

        const selectedAvatar = ref(null);
        const selectedImages = ref([]);
        const dragover = ref(false);
        const request = ref(false);

        const showForm = ref(true);
        const showThanks = ref(false);

        const data = reactive({
            first_name: props.user && props.user.first_name ? props.user.first_name : '',
            last_name: props.user && props.user.last_name ? props.user.last_name : '',
            phone: props.user && props.user.phone ? props.user.phone : '',
            email: props.user && props.user.email ? props.user.email : '',
            rating: 0,
            guide_id: 0,
            text: '',
        });

        const previewImages = () => {

            if (imagesRef.value.files.length) {
                for (let i = 0; i < imagesRef.value.files.length; i++) {
                    if (selectedImages.value.length >= 5) break;
                    const file = imagesRef.value.files[i];
                    const reader = new FileReader();
                    reader.onload = (pe) => {
                        selectedImages.value = [...selectedImages.value, {preview: pe.target.result, file: file}];
                    }
                    reader.readAsDataURL(file);
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

        const submitForm = async (event) => {
            if (invalid.value) {
                event.preventDefault();
            } else {
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

                const response = await axios.post(props.action, formData, {
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


                if (response.data) {
                    if (response.data.result === 'success') {
                        showForm.value = false;
                        showThanks.value = true;
                    } else {
                        toast.error(response.data.message);
                    }

                }

                request.value = false;
            }
        }

        const closePopup = () => {
            store.commit('testimonials/SET_POPUP_OPEN', false);
            showForm.value = true;
            showThanks.value = false;
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
    }
}
</script>

<style scoped>

</style>
