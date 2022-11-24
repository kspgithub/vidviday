@props([
    'sectionTitle'=>'',
    'tours'=>[],
])

<div v-is="'tour-carousel'" title='{{$sectionTitle}}'
     :tours='@json($tours)'
>
</div>

