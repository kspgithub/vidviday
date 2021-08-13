<template>
    <span class="stars select-stars stars-selected">
        <i :class="rating >= 1 ? 'icon-star' : 'icon-star-empty'" class="select-icon icon-star"></i>
        <i :class="rating >= 2 ? 'icon-star' : 'icon-star-empty'" class="select-icon icon-star"></i>
        <i :class="rating >= 3 ? 'icon-star' : 'icon-star-empty'" class="select-icon icon-star"></i>
        <i :class="rating >= 4 ? 'icon-star' : 'icon-star-empty'" class="select-icon icon-star"></i>
        <i :class="rating >= 5 ? 'icon-star' : 'icon-star-empty'" class="select-icon icon-star"></i>
        <span v-if="count > 0" class="text">{{ title }}</span>
    </span>
</template>

<script>
import {pluralizeValue} from "../../utils/string";

export default {
    name: "TourRating",
    props: {
        rating: {
            type: Number,
            default: 0
        },
        count: {
            type: Number,
            default: 0
        }
    },
    setup(props) {
        const title = pluralizeValue(props.count, 'відгук', 'відгука', 'відгуків');
        return {
            title,
        }
    }
}
</script>

<style scoped>

</style>
