<template>
    <popup size="size-1" :active="popupOpen" @hide="closePopup()">
        <div class="popup-header">
            <div class="text-center">
                <span class="h2 title text-medium">Написати відгук</span>
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
                    <form-input name="first_name" v-model="data.first_name" rules="required" label="Ваше ім’я"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input name="last_name" v-model="data.last_name" rules="required" label="Ваше прізвище"
                                tooltip="Поле обов'язкове для заповнення"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input mask="+38 (099) 999-99-99"
                                name="phone"
                                id="testimonial_phone"
                                rules="tel"
                                v-model="data.phone" label="Ваш телефон"/>
                </div>

                <div class="col-md-6 col-12">
                    <form-input type="email" name="email" id="testimonial_email" v-model="data.email" label="Email"/>

                </div>
                <div class="col-12">
					    <span class="text text-sm">
                            <b>Оцініть тур</b>
                        </span>
                    <form-star-rating v-model="data.rating"/>
                </div>


                <div class="col-12 col-md-6">
                    <span class="text text-sm">
                        <b>Тур, у якому ви були *</b>
                    </span>
                    <form-autocomplete
                        name="tour_id"
                        placeholder="Введіть назву тура"
                        :search="true"
                        ref="tourSelectRef"
                        v-model.number="data.tour_id"
                        @search="searchTours"
                        rules="required"
                    >
                        <option :value="0" :selected="data.tour_id === 0" disabled>Оберіть зі списку</option>
                        <option v-for="option in tours" :value="option.id">{{ option.title }}</option>
                    </form-autocomplete>


                </div>
                <div class="col-md-6 col-12">
                    <span class="text text-sm">
                        <b>Ваш гід</b>
                    </span>
                    <form-autocomplete
                        name="guide_id"
                        placeholder="Введіть ім'я гіда"
                        :search="true"
                        ref="guideSelectRef"
                        v-model.number="data.guide_id"
                        @search="searchGuides"
                        title-field="name"
                        rules="required"
                    >
                        <option :value="0" :selected="data.guide_id === 0" disabled>Оберіть зі списку</option>
                        <option v-for="guide in guides" :value="guide.id" :data-img="guide.avatar_url">
                            {{ guide.name }}
                        </option>
                    </form-autocomplete>
                </div>
                <div class="col-12">
                    <form-textarea name="text" v-model="data.text" label="Ваш відгук" rules="required"/>

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
import useTestimonialForm from "./useTestimonialForm";
import FormAutocomplete from "../form/FormAutocomplete";
import {autocompleteTours, fetchGuides} from "../../services/tour-service";
import {useForm} from "vee-validate";

export default {
    name: "TestimonialPopupForm",
    components: {FormAutocomplete, FormCustomSelect, Popup, FormTextarea, FormInput, FormStarRating},
    props: {
        user: Object,
        action: String,
        dataParent: Number,
    },
    setup(props) {
        const formRef = ref(null);
        const tourSelectRef = ref(null);
        const guideSelectRef = ref(null);
        const tours = ref([]);
        const guides = ref([]);

        const data = reactive({
            first_name: props.user && props.user.first_name ? props.user.first_name : '',
            last_name: props.user && props.user.last_name ? props.user.last_name : '',
            phone: props.user && props.user.phone ? props.user.phone : '',
            email: props.user && props.user.email ? props.user.email : '',
            rating: 5,
            tour_id: 0,
            guide_id: 0,
            text: '',
        });

        const {validate, errors} = useForm({
            validationSchema: {
                first_name: 'required',
                last_name: 'required',
                phone: 'tel',
                email: 'email',
                tour_id: () => data.tour_id > 0 || 'Оберіть тур',
            }
        })

        const searchTours = async (q = '') => {
            const items = await autocompleteTours(q);
            tours.value = items || [];
            tourSelectRef.value.update(tours.value);
        }

        searchTours();

        const searchGuides = async (q = '') => {
            if (guides.value.length === 0) {
                const items = await fetchGuides();
                guides.value = items || [];
            }
            guideSelectRef.value.update(guides.value);
        }

        searchGuides();

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
            data,
            formRef,
            guides,
            tours,
            tourSelectRef,
            searchTours,
            searchGuides,
            guideSelectRef,
        }
    }
}
</script>

<style scoped>

</style>
