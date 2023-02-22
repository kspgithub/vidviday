<div class="accordion type-4">
    <div class="spacer-xs"></div>
    <hr>
    <div class="accordion-item">
        <div id="testimonials" class="accordion-title">Відгуки ({{$place->testimonials->count()}})<i></i></div>
        <div class="accordion-inner">
            <div></div>
            <span v-bind="$buttons('testimonial.send')" class="btn btn-block-sm type-1" v-is="'open-testimonial-form'"
                  :parent='0'>{{ __('forms.leave-feedback') }}</span>
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
                <span v-bind="$buttons('testimonial.send')" class="btn btn-block-sm type-1" v-is="'open-testimonial-form'"
                      :parent='0'>{{ __('forms.leave-feedback') }}</span>
            @endif
        </div>
    </div>
</div>
