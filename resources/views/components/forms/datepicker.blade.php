@props([
    'format'=>'YYYY-MM-DD'
])
<div class="input-group me-2 mb-2"
     x-data="{ value: @entangle($attributes->wire('model')), picker: undefined }"
     x-init="
            new Pikaday({
                field: $refs.input,
                i18n: Pikadayi18n.ru,
                format: '{{$format}}',
                onOpen() {
                    moment($refs.input.value,'{{$format}}').toDate()
                },
            });
            "
>
    <label class="input-group-text" for="{{$attributes['id']}}"><i class="fa fa-calendar-alt"></i></label>
    <input
        x-ref="input"
        x-on:change="value = $event.target.value"
        x-bind:value="value"
        type="text"
        autocomplete="off"
        {{ $attributes->merge(['class'=>'form-control']) }}
    >

</div>
