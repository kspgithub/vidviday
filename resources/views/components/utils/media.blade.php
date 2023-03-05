@props([
    'media'=>new \Spatie\MediaLibrary\MediaCollections\Models\Media(),
    'collection'=>'default',
])
<div class="media-item img-thumbnail" id="media-item-{{$media->id}}" data-id="{{$media->id}}">
    <img loading="lazy" data-img-src="{{$media->getUrl('thumb')}}" alt="{{$media->getCustomProperty('alt')}}">
    <a href="#" class="delete-media-item"><i class="fas fa-times"></i></a>
    <a href="{{$media->getUrl()}}" class="show-media-item" target="_blank" data-fancybox="{{$collection}}"><i
            class="fas fa-eye"></i></a>
    <span class="handler fas fa-bars"></span>
    <input class="edit-media-title"
           value="{{$media->getCustomProperty('title_'.app()->getLocale())}}"
           placeholder="{{__('Change image title')}}"/>

    <input class="edit-media-alt"
           value="{{$media->getCustomProperty('alt_'.app()->getLocale())}}"
           placeholder="{{__('Change image alt')}}"/>
</div>
