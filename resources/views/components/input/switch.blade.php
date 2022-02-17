<div class="form-check form-switch">
    <input type="checkbox" {{ $attributes->except('label')->merge(['class'=>'form-check-input']) }}>
    <label class="form-check-label" for="{{$attributes['id']}}">{{$attributes['label'] ?? ''}}</label>
</div>

