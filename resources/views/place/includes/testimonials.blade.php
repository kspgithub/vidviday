<div class="accordion type-4">
    <div class="spacer-xs"></div>
    <hr>
    <div class="accordion-item">
        <div id="testimonials" class="accordion-title">Відгуки ({{$place->testimonials->count()}})<i></i></div>
        <div class="accordion-inner">
            <div></div>
            <x-seo-button key="testimonial.send" class="btn btn-block-sm type-1" v-is="'open-testimonial-form'"
                  :parent='0'>{{ __('forms.leave-feedback') }}</x-seo-button>
            <div class="spacer-xs"></div>
            @if($place->testimonials->count() > 0)
                <hr>
                <div class="spacer-xs"></div>

                <div v-is="'testimonial-list'"
                     :items='@json($place->testimonials->toTree())'
                     url="{{route('place.testimonial', $place)}}"
                ></div>

                <div class="spacer-xs"></div>
                <hr>
                <div class="spacer-xs"></div>
                <x-seo-button key="testimonial.send" class="btn btn-block-sm type-1" v-is="'open-testimonial-form'"
                      :parent='0'>{{ __('forms.leave-feedback') }}</x-seo-button>
            @endif
        </div>
    </div>
</div>
