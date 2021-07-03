@props([
    'media'=>new \Spatie\MediaLibrary\MediaCollections\Models\Media(),
    'name'=>'media',
])
<div class="media-item img-thumbnail" id="media-item-{{$media->id}}">
    <img src="{{$media->getUrl('thumb')}}" alt="{{$media->getCustomProperty('alt')}}">
    <a href="#" class="delete-media-item"><i class="fas fa-times"></i></a>
    <a href="{{$media->getUrl()}}" class="show-media-item" target="_blank" data-fancybox="{{$name}}"><i class="fas fa-eye"></i></a>
</div>
