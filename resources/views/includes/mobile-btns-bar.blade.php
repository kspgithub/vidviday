<div class="only-pad-mobile hidden-print">
    <div class="row short-distance">
        <div class="col-md-4 col-12 only-pad">
                                <x-seo-button :code="'order.tour'" class="btn type-4 arrow-right text-left flex"><img
                                        src="{{asset('img/preloader.png')}}"
                                        data-img-src="{{asset('icon/placeholder-light.svg')}}" alt="placeholder light">Замовити тур</x-seo-button>
        </div>

        <div class="col-md-4 col-12 only-pad">
            <x-seo-button :code="'download.schedule'" href="{{route('tour.download')}}" download
               class="btn type-5 arrow-right text-left flex"><img
                    src="{{asset('img/preloader.png')}}"
                    data-img-src="{{asset('icon/tours-scedule-dark.svg')}}"
                    alt="tours scedule dark">Завантажити розклади турів</x-seo-button>
        </div>
    </div>
    <div class="spacer-sm"></div>
</div>
