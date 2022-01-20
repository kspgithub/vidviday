@props([
    'testimonials'=>[],
])
<div class="accordion-item" id="reviews-accordion">
    <div class="accordion-title">Відгуки ({{$testimonials->count()}})<i></i></div>
    <div class="accordion-inner px-0">
        <span class="btn btn-block-sm type-1" v-is="'open-testimonial-form'"
              :parent='0'>{{ __('forms.leave-feedback') }}</span>
        <div class="spacer-xs"></div>

        @if($testimonials->count() > 0)
            <hr>
            <div class="spacer-xs"></div>
            @foreach($testimonials->toTree() as $testimonial)
                <x-page.testimonial :testimonial="$testimonial"/>
            @endforeach
            <div class="spacer-xs"></div>
            <hr>
            <div class="spacer-xs"></div>
            <span class="btn btn-block-sm type-1" v-is="'open-testimonial-form'"
                  :parent='0'>{{ __('forms.leave-feedback') }}</span>
        @endif
    </div>
</div>

