<template>
    <popup size="size-2" :active="popupOpen" @hide="closePopup()">
        <div class="popup-align">
            <div class="row justify-content-center">
                <div class="col-xl-9 col-lg-10 col-md-11 col-12">
                    <div class="text-center">
                        <span class="h2 title text-medium">Скасування {{ tour ? tour.title.uk : 'туру' }}</span>
                    </div>
                    <div class="spacer-xs"></div>
                    <div class="text-center">
                        <span class="text">Зверніть будь ласка увагу на наші <a href="/public-offer">Умови скасування</a></span>
                    </div>
                    <div class="spacer-xs"></div>
                    <form @submit.prevent="onSubmit" :action="actionURL" method="post"
                          class="row">
                        <div class="col-12">
                            <select v-model="cause">
                                <option value="0" selected disabled>Причина скасування*</option>
                                <option value="Перенесення на іншу дату або інший тур">Перенесення на іншу дату або інший тур</option>
                                <option value="Несприятлива погода">Несприятлива погода</option>
                                <option value="огіршення стану здоров'я">Погіршення стану здоров'я</option>
                                <option value="Непередбачувані особисті обставини">Непередбачувані особисті обставини</option>
                                <option value="Не влаштували умови замовлення">Не влаштували умови замовлення</option>
                                <option value="Ваш варіант">Ваш варіант (із можливістю заповнення)</option>
                            </select>

                            <label>
                                <i>Примітка</i>
                                <textarea v-model="comment"></textarea>
                            </label>
                        </div>

                        <div class="col-12">
                            <button id="b12" type="submit" class="btn type-1 btn-block" :disabled="request">Погоджуюсь на умови
                                скасування
                            </button>
                            <div class="text text-sm">{{__('forms.required-fields')}}</div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="btn-close" @click="closePopup()">
                <span></span>
            </div>
        </div>
    </popup>
</template>

<script>
import Popup from "../popup/Popup";
import {useStore} from "vuex";
import {computed, ref} from "vue";
import axios from "axios";

export default {
    name: "OrderCancelPopup",
    components: {
        Popup
    },
    setup() {
        const store = useStore();
        const popupOpen = computed(() => store.state.profileOrders.popupOpen);
        const order = computed(() => store.state.profileOrders.order);
        const request = ref(false);
        const cause = ref(0);
        const comment = ref('');

        const closePopup = () => {
            store.commit('profileOrders/SET_POPUP_OPEN', false);
        }

        const tour = computed(() => order.value && order.value.tour ? order.value.tour : null);
        const actionURL = computed(() => order.value ? `/order/${order.value.id}/cancel` : '')

        const onSubmit = async () => {
            request.value = true;
            const {data: response} = await axios.post(`/order/${order.value.id}/cancel`, {
                cause: cause.value,
                comment: comment.value,
            });
            if (response.result === 'success') {
                closePopup();
                await store.dispatch('userQuestion/showThanks', {
                    title: 'Запит відправлено'
                })
            }
            request.value = false;
        }


        return {
            closePopup,
            onSubmit,
            actionURL,
            popupOpen,
            order,
            tour,
            cause,
            comment,
            request,
        }
    }
}
</script>

<style scoped>

</style>
