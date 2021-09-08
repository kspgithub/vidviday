<template>
    <form action="/" class="calc-form vue-calc">
        <div class="text-sm">Дата виїзду*</div>

        <div class="single-datepicker">
            <form-select-event v-model="eventId" :options="eventOptions"/>
        </div>
        <div class="text">
            <p>Ціни вказані без урахування знижок для дітей, учасників АТО/ООС, осіб
                з інвалідністю та інших пільгових категорій.</p>
        </div>
        <div class="calc">
            <div class="calc-header">
                <label class="checkbox">
                    <input type="checkbox" name="all-inclusive">
                    <span>Все включено</span>
                </label>
            </div>

            <div class="calc-rows-wrap">
                <tour-calc-row v-for="(item, idx) in items"
                               :item="item"
                               :checked="selected.indexOf(item.id) !== -1"
                               :key="'row-'+item.id"
                               @change="changeItem"
                               @update-quantity="changeQuantity"
                />

            </div>
            <div class="calc-footer">
                <span class="text-sm">Загальна сума: <span
                    class="calc-total-price">{{ total }}</span> <sup>грн</sup></span>
            </div>
        </div>
    </form>
</template>

<script>
import {computed, reactive, ref, watch} from "vue";
import {useI18n} from "vue-i18n";
import FormNumberInput from "../form/FormNumberInput";
import TourCalcRow from "./TourCalcRow";
import FormSelect from "../form/FormSelect";
import FormSelectEvent from "../form/FormSelectEvent";

export default {
    name: "TourCalc",
    components: {FormSelectEvent, FormSelect, TourCalcRow, FormNumberInput},
    props: {
        tour: Object,
        futureEvents: Array,
        priceItems: Array,
    },
    setup(props) {
        const eventId = ref(props.futureEvents.length > 0 ? props.futureEvents[0].id : 0);

        const eventOptions = ref(props.futureEvents.map(evt => {
            return {
                text: evt.title,
                value: evt.id,
            }
        }));

        const selectedEvent = computed(() => props.futureEvents.find(it => it.id === eventId.value));

        const nearestPrice = computed(() => {
            return {
                id: 'event_' + (selectedEvent.value ? selectedEvent.value.id : 0),
                title: 'Тур',
                price: selectedEvent.value ? selectedEvent.value.price : props.tour.price,
                commission: selectedEvent.value ? selectedEvent.value.commission : props.tour.commission,
                currency: selectedEvent.value ? selectedEvent.value.currency : props.tour.currency,
                places: selectedEvent.value ? selectedEvent.value.places : 999,
                quantity: 1
            }
        });

        const selected = ref([]);

        const {locale} = useI18n({useScope: 'global'});

        const priceItems = props.priceItems.map(it => {
            return {
                id: 'price_' + it.id,
                title: it.title[locale] || it.title['uk'],
                price: it.price,
                commission: 0,
                currency: it.currency,
                places: it.limited ? it.places : 999,
                quantity: 1
            }
        });

        const items = ref([nearestPrice.value, ...priceItems]);

        const changeItem = (id) => {
            if (selected.value.indexOf(id) === -1) {
                selected.value.push(id);
            } else {
                selected.value = selected.value.filter(it => it !== id);
            }
        }

        const changeQuantity = (payload) => {
            const item = items.value.find(it => it.id === payload.id);
            if (item) {
                item.quantity = payload.quantity;
            }
        }

        const total = computed(() => {
            let totalPrice = 0;
            items.value.filter(it => selected.value.indexOf(it.id) !== -1).forEach((it) => {
                totalPrice += (it.price + it.commission) * it.quantity;
            })
            return totalPrice;
        });


        watch(eventId, () => {

            items.value = [nearestPrice.value, ...priceItems];
            const idx = selected.value.findIndex(it => it.includes('event_'));
            if (idx !== -1) {
                selected.value[idx] = nearestPrice.value.id;
            }
        });

        return {
            eventId,
            eventOptions,
            items,
            selected,
            changeItem,
            changeQuantity,
            total,
        }
    }
}
</script>

<style scoped>

</style>
