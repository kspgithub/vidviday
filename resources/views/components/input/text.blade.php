@props([
    'name' => '',
    'placeholder' => '',
    'format' => 'DD.MM.YYYY',
])

<div>
    <div
        class="input-group"
        x-data="{ value: @entangle($attributes->wire('model')) }"
        x-on:change="value = $event.target.value"
    >
        <input
            {{ $attributes->whereDoesntStartWith('wire:model')->merge(['class'=>'form-control']) }}
            x-ref="input"
            name="{{$name}}"
            id="{{$name}}"
            x-bind:value="value"
            type="text"
            placeholder="{{$placeholder}}"
        />
    </div>

    @error($name)
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

