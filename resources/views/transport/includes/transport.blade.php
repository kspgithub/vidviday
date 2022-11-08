@if($transports->count() > 0)
    <div class="thumb-wrap row only-desktop">
        @foreach($transports as $transport)
            <div class="col-md-6 col-12">
                <div class="img img-border img-caption">
                    <img loading="lazy"
                         src="{{asset('/img/preloader.png')}}"
                         data-img-src="{{$transport->image_url}}"
                         width="{{$transport->dimensions['thumb']['width']}}"
                         height="{{$transport->dimensions['thumb']['height']}}"
                         alt="img 16">
                    <div class="img-caption-title">
                        <span class="h3">{{$transport->title}}</span>
                        <br>
                        <span class="text-sm">{{$transport->text}}</span>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endif
