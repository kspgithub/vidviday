@if($slides->count() > 0)
    <div class="swiper-entry" v-is="'swiper-slider'"
         :media='@json($slides->map(function ($media) { return App\Models\Media::asSwiperSlide($media); }))'
    >
    </div>
    <div class="spacer-xs"></div>
@endif
