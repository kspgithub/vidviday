@props([
    'name' => '',
    'placeholder' => '',
    'format' => 'd.m.Y',
    'value' => '',
    'errorName'=>null,
])

<div wire:ignore>
    <div
        class="input-group"
        x-data="{ value: @entangle($attributes->wire('model')), pikaday: null }"
        x-on:change="value = $event.target.value"
        x-init="
            flatpickr($refs.input, {
                allowInput: true,
                dateFormat: '{{$format}}'
            });
        "
    >
        <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
        <input
            {{ $attributes->whereDoesntStartWith('wire:model')->merge(['class'=>'form-control']) }}
            x-ref="input"
            name="{{$name}}"
            id="{{$name}}"
            x-bind:value="value"
            type="text"
            value="{{$value}}"
            placeholder="{{$placeholder}}"
            autocomplete="off"
        />
    </div>

    @error($errorName ?? $name)
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>
