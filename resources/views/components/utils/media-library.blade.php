
<div class="media-library"
     data-media-upload
     data-media-collection="{{$collection}}"
     data-media-store="{{$storeUrl}}"
     data-media-update="{{$updateUrl}}"
     data-media-destroy="{{$destroyUrl}}"
>
    @foreach($items as $media)
        <x-utils.media :media="$media"></x-utils.media>
    @endforeach

    <label class="img-thumbnail add-media">
        <input type="file" multiple accept="{{$accept}}">
        <i class="fas fa-plus"></i>
    </label>
</div>
