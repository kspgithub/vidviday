@if($items->count() > 0)
    <div class="sidebar-item testimonials">
        <div class="top-part b-border">
            <div class="title h3 title-icon">
                <img loading="lazy" src="{{asset('/img/preloader.png')}}" data-img-src="{{asset('/icon/reviews.svg')}}"
                     alt="reviews">
                <span>{{ __("Нас рекомендують") }}</span>
            </div>
        </div>
        <div class="bottom-part">
            <div v-is="'sidebar-recommendations'">

                <x-sidebar.recommendation-item :item="$items->first()"/>

                @if($items->count() > 1)
                    <x-seo-button :code="'common.more_recommendations'" href="{{$testimonialsUrl}}"
                       class="btn type-2 btn-block show_more">{{__('tours-section.show-more')}}</x-seo-button>
                    @foreach($items as $key=>$item)
                        @if($key> 0)
                            <div class="divider d-none"></div>
                            <x-sidebar.recommendation-item :item="$item" :hidden="true"/>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endif
