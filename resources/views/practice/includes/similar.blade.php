@if($practice->similar_practices->count() > 0)
    <div class="section no-print">
        <div class="container">
            <h2 class="h1 text-center">Схожі практики</h2>
            <div class="spacer-xs"></div>
            <div class="thumbs-carousel swiper-entry vac">
                <div class="swiper-button-prev inner vac">
                    <i></i>
                </div>
                <div class="swiper-button-next inner vac">
                    <i></i>
                </div>
                <div class="swiper-container" data-options='{
						"loop": {{ count($practice->similar_practices) > 1 ? 'true' : 'false' }},
						"slidesPerView": 1,
						"spaceBetween": 20,
						"centerInsufficientSlides": true,
						"breakpoints": {
                            "1199": {
                                "slidesPerView": 4
                            },
                            "991": {
                                "slidesPerView": 2
                            },
                            "767": {
                                "slidesPerView": 1
                            }
                        }
                    }'>
                    <div class="swiper-wrapper">
                        @foreach($practice->similar_practices as $similar)
                            <div class="swiper-slide">
                                <div class="bordered-box vacancy">
                                    <h2 class="h3"><a href="{{$similar->url}}">{{$similar->title}}</a></h2>
                                    <div class="text">
                                        <p>{{!empty($similar->short_text) ? $similar->short_text : str_limit(strip_tags(html_entity_decode($similar->text)), 500)}}</p>
                                    </div>
                                    <x-seo-button key="goto.practice" href="{{$similar->url}}" class="btn type-3 btn-more">Дізнатись Більше</x-seo-button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
@endif
