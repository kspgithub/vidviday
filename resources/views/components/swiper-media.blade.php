@if($slides->count() > 0)
    <div class="swiper-entry" v-is="'swiper-slider'"
         :media='@json($slides->map->toSwiperSlide() ))'
         :buttons="true"
    >
    </div>
    <div class="spacer-xs"></div>
@endif
