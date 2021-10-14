<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()">
        <div class="popup-header">
            <div class="text-center">
                <span class="h2 title text-medium">Написати відгук про тур</span>
            </div>
        </div>
        <form method="post" @submit="submitForm" :action="action" class="popup-align" enctype="multipart/form-data"
              ref="formRef">
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
                    <form-input name="first_name" id="tt_first_name" v-model="data.first_name" rules="required"
                                label="Ваше ім’я"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input name="last_name" id="tt_last_name" v-model="data.last_name" rules="required"
                                label="Ваше прізвище"
                                tooltip="Поле обов'язкове для заповнення"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input mask="+38 (099) 999-99-99"
                                name="phone"
                                id="tt_phone"
                                rules="tel"
                                v-model="data.phone" label="Ваш телефон"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input type="email" id="tt_email" name="email" v-model="data.email" label="Email"/>

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
                    <form-custom-select name="guide_id" id="tt_guide_id" search search-text="Введіть ім'я гіда"
                                        v-model.number="data.guide_id"
                                        placeholder="Оберіть зі списку">
                        <option v-for="guide in tour.guides" :value="guide.id" :data-img="guide.avatar_url">
                            {{ guide.name }}
                        </option>
                    </form-custom-select>

                </div>

                <div class="col-12">
                    <form-textarea name="text" id="tt_text" v-model="data.text" class="smile" label="Ваш відгук"
                                   rules="required"
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
                    <button type="submit" :disabled="invalid || request" @click.prevent="onSubmit()" class="btn type-1">
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
import useTestimonialForm from "../testimonial/useTestimonialForm";
import {useForm} from "vee-validate";

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

        const formRef = ref(null);



        const data = reactive({
            first_name: props.user && props.user.first_name ? props.user.first_name : '',
            last_name: props.user && props.user.last_name ? props.user.last_name : '',
            phone: props.user && props.user.phone ? props.user.phone : '',
            email: props.user && props.user.email ? props.user.email : '',
            rating: 0,
            guide_id: 0,
            text: '',
        });


        const {validate, errors} = useForm({
            validationSchema: {
                first_name: 'required',
                last_name: 'required',
                phone: 'tel',
                email: 'email',
            }
        })

        const onSubmit = async () => {
            const result = await validate();
            if (result.valid) {
                formRef.value.submit();
            } else {
                console.log(errors.value);
            }
        }


        return {
            ...useTestimonialForm(data, props.action),
            onSubmit,
            formRef,
            data,
            popupOpen,
        }
    }
}
</script>

<style scoped>

</style>
