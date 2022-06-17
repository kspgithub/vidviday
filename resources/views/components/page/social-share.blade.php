@props([
    'shareUrl' => null,
    'shareTitle' => null,
    'title' => null,
])
<div {{$attributes->merge(['class'=>'social'])}}>
    <span>Поділитись:</span>
    <div v-is="'share-dropdown'" :share-url="{{json_encode($shareUrl)}}" :title="{{ json_encode($title) }}" :share-title="{{ json_encode($shareTitle) }}"></div>
</div>
