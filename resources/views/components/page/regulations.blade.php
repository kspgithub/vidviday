<div class="section only-desktop">
    <div class="container">
        <hr>
        <div class="spacer spacer-sm"></div>
        <div class="seo-text load-more-wrapp">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 col-12">

                    <div class="shorten-text">
                        {!! $seoText !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="spacer spacer-lg"></div>
</div>

<style>
    .seo-text-wrapper {

    }

    .seo-text {
        overflow: hidden;
    }

    a.show-more {

    }
</style>
@push('after-scripts')
<script>

window.addEventListener('DOMContentLoaded', () => {

    moreLess('seo-text', '150px', {
        textMore: '{{ __('Показати більше') }}',
        textLess: '{{ __('Показати менше') }}',
    });
})
</script>
@endpush()
