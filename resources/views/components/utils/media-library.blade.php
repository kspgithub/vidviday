@props([
    'uploadUrl'=>'#',
    'destroyUrl'=>'#',
    'items'=>[],
    'collection'=>'default'
])
<div class="media-library"
     data-media-collection="{{$collection}}"
     data-media-upload="{{$uploadUrl}}"
     data-media-destroy="{{$destroyUrl}}"
>
    @foreach($items as $media)
        <x-utils.media :media="$media"></x-utils.media>
    @endforeach

    <label class="img-thumbnail add-media">
        <input type="file">
        <i class="fas fa-plus"></i>
    </label>
</div>
