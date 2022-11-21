<div class="section only-desktop">
    <div class="container">
        <hr>

        <div class="spacer spacer-sm"></div>
        <div class="seo-text load-more-wrapp">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 col-12">
                    @if(!empty($h1))
                        <h1 class="h1 title">{!! $h1 !!}</h1>
                        <div class="spacer spacer-sm"></div>
                    @endif
                    <div class="shorten-text" id="seo-shorten-text">
                        {!! $seoText !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="spacer spacer-lg"></div>
</div>

@push('after-scripts')
    @if($seoText)
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                if (document.getElementById('seo-shorten-text')?.offsetHeight > 180) {
                    if('moreLess' in window) {
                        moreLess('shorten-text', '150px', {
                            textMore: '{{ __('Read more') }}',
                            textLess: '{{ __('Hide text') }}',
                        });
                    }
                }
            })
        </script>
    @endif
@endpush
