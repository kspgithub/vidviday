<!-- POPUP ADS -->
@foreach(($popupAds ?? []) as $popupAd)
    <div class="popup-content" data-rel="popup-ad-{{$popupAd->id}}">

        <div class="layer-close"></div>

        <div class="popup-container size-1">
            <div class="popup-align">
                <div class="text-center">
                    <a href="{{ $popupAd->url }}">

                        <div class="img">
                            <img src="{{asset('img/preloader.png')}}" data-img-src="{{$popupAd->image_url}}" alt="done">
                        </div>

                        <div class="spacer-xs"></div>
                        <span class="h2 title text-medium">{{ $popupAd->title }}</span>
                        <br>
                        <span class="text">{!! $popupAd->text !!}</span>
                        <div class="spacer-xs"></div>
                    </a>

                    <span class="btn type-1 close-popup">@lang('popup.return')</span>
                </div>

                <div class="btn-close">
                    <span></span>
                </div>
            </div>
        </div>

    </div>
@endforeach
<!-- THANKS POPUP END -->

@push('after-scripts')
    <script>
        (function () {
            window.onload = () => {
                    @foreach(($popupAds ?? []) as $i => $popupAd) {

                    let showPopup = !localStorage.getItem('popup-ad-{{$popupAd->id}}')

                    if (showPopup) {
                        let timeout = {{ $popupAd->timeout ?: 5000 }}

                        setTimeout(() => {
                            _functions.showPopup('popup-ad-{{$popupAd->id}}')

                            localStorage.setItem('popup-ad-{{$popupAd->id}}', true);
                        }, timeout)
                    }
                }
                @endforeach
            }
        })(window)
    </script>
@endpush
