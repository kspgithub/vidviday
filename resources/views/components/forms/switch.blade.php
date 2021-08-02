<div class="form-check form-switch"
     x-data="{ value: @entangle($attributes->wire('model')) }"
>
    <input type="checkbox"
        x-on:change="value = $event.target.value"
        x-bind:value="value"
        {{ $attributes->merge(['class'=>'form-check-input']) }}
    >
    <label class="form-check-label" for="{{$attributes['id']}}"></label>
</div>

