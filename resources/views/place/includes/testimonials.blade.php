<div class="accordion type-4">
    <div class="spacer-xs"></div>
    <hr>
    <div class="accordion-item">
        <div id="testimonials" class="accordion-title">Відгуки ({{$place->testimonials->count()}})<i></i></div>
        <div class="accordion-inner">
            <div></div>
            <span class="btn btn-block-sm type-1" v-is="'open-testimonial-form'"
                  :parent='0'>{{ __('forms.leave-feedback') }}</span>
            <div class="spacer-xs"></div>
            @if($place->testimonials->count() > 0)
                <hr>
                <div class="spacer-xs"></div>

                @foreach($place->testimonials->toTree() as $testimonial)
                    <x-tour.testimonial :testimonial="$testimonial"/>
                @endforeach
                <div class="spacer-xs"></div>
                <hr>
                <div class="spacer-xs"></div>
                <span class="btn btn-block-sm type-1" v-is="'open-testimonial-form'"
                      :parent='0'>{{ __('forms.leave-feedback') }}</span>
            @endif
        </div>
    </div>
</div>
