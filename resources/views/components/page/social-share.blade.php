@props([

])
<div {{$attributes->merge(['class'=>'social'])}}>
    <span>Поділитись:</span>
    <div v-is="'share-dropdown'"></div>
</div>
