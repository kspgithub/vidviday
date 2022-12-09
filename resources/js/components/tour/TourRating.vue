<template>
    <span class="stars select-stars stars-selected">
        <i :class="rating >= 1 ? 'icon-star' : 'icon-star-empty'" class="select-icon icon-star"></i>
        <i :class="rating >= 2 ? 'icon-star' : 'icon-star-empty'" class="select-icon icon-star"></i>
        <i :class="rating >= 3 ? 'icon-star' : 'icon-star-empty'" class="select-icon icon-star"></i>
        <i :class="rating >= 4 ? 'icon-star' : 'icon-star-empty'" class="select-icon icon-star"></i>
        <i :class="rating >= 5 ? 'icon-star' : 'icon-star-empty'" class="select-icon icon-star"></i>
        <a v-if="count > 0 || forceCount" :href="url" class="text">{{ title }}</a>
    </span>
</template>

<script>
import {pluralizeValue} from "../../utils/string";
import {trans} from '../../i18n/lang';
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
        },
        forceCount: Boolean,
        url: String,
    },
    setup(props) {
        const title = pluralizeValue(props.count, trans('tours-section.one_review'), trans('tours-section.two_reviews'), trans('tours-section.many_reviews'));
        return {
            title,
        }
    }
}
</script>

<style scoped>

</style>
