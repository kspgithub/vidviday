<template>
    <div class="review">
        <div class="review-header">
            <div class="review-img">
                <img src="/img/preloader.png"
                     data-src="/img/user.jpg" alt="user">
            </div>
            <div class="review-title">
                <span class="h4">Григоряш Вероніка</span>
                <span class="text text-sm">22.11.2019</span>
                <span class="text text-sm">13:09</span>
                <tour-rating :rating="4"/>

                <span class="text">{{ __('forms.reply') }}</span>
            </div>
        </div>
        <div class="text text-md">
            <p>Доброго дня. Цікавить наступне питання. Чи можна підбирати учасників туру по ходу туру? І чи вплине це
                якимось чином на остаточну вартість?</p>
        </div>
    </div>
</template>

<script>
import TourRating from "./TourRating";

export default {
    name: "TourQuestion",
    components: {TourRating},
    props: {
        question: Object,
    }
}
</script>

<style scoped>

</style>
