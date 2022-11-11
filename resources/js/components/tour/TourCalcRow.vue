<template>
    <div class="calc-row" :class="{ checked: checked }">
        <label class="checkbox" :class="{ active: checked }">
            <input type="checkbox" :checked="checked" @change.prevent="changeItem()" />
            <span>{{ item.title }}</span>
        </label>

        <form-number-input v-model="quantity" :disabled="!checked" :min="1" :max="item.places" />

        <span class="text-md">
            <span class="calc-item-price">{{ price }}</span> {{ __('common.currency.uah') }}
        </span>
    </div>
</template>

<script>
import FormNumberInput from '../form/FormNumberInput'
import { computed } from 'vue'

export default {
    name: 'TourCalcRow',
    components: { FormNumberInput },
    props: {
        item: Object,
        checked: Boolean,
    },
    emits: ['change', 'update-quantity'],
    setup(props, { emit }) {
        const quantity = computed({
            get() {
                return props.item.quantity
            },
            set(val) {
                if (props.item.quantity !== val) {
                    emit('update-quantity', { id: props.item.id, quantity: val })
                }
            },
        })

        const changeItem = () => {
            emit('change', props.item.id)
        }

        const price = computed(() => {
            return props.checked ? props.item.price * quantity.value : props.item.price
        })

        return {
            price,
            quantity,
            changeItem,
        }
    },
}
</script>

<style scoped></style>
