@props([
    'id'=>'switch-'.md5(time().rand(0, 100)),
    'label'=>'',
    'inline'=>false,
    'switch'=>false,
])
<div class="form-check {{$switch ? 'form-switch' : ''}} {{$inline ? 'form-check-inline' : ''}}">
    <input class="form-check-input" type="checkbox" id="{{$id}}" {{$attributes->except('id')}}>
    <label class="form-check-label" for="{{$id}}">{{$label}}</label>
</div>
