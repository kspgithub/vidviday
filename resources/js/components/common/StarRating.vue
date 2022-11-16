<template>
<span class="stars select-stars stars-selected">
    <i class="select-icon" :class="value >= 1 ? 'icon-star' : 'icon-star-empty'"></i>
    <i class="select-icon" :class="value >= 2 ? 'icon-star' : 'icon-star-empty'"></i>
    <i class="select-icon" :class="value >= 3 ? 'icon-star' : 'icon-star-empty'"></i>
    <i class="select-icon" :class="value >= 4 ? 'icon-star' : 'icon-star-empty'"></i>
    <i class="select-icon" :class="value >= 5 ? 'icon-star' : 'icon-star-empty'"></i>
</span>
</template>

<script>
export default {
    name: "StarRating",
    props: {
        value: [Number, String]
    }
}
</script>

<style scoped>

</style>
