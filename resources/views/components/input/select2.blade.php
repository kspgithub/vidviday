@props([
    'name' => '',
    'placeholder' => '',
    'url'=> false,
])

<div wire:ignore>
    <div
        x-data="{
            value: @entangle($attributes->wire('model')),
        }"
        x-on:change="value = $event.target.value"
        x-init="
                jQuery($refs.input).select2({
                    theme: 'bootstrap-5',
                    @if($url !== false)
                    ajax: {
                        url: '{{$url}}',
                        dataType: 'json',
                        data: function (params) {
                            return {
                                q: params.term,
                                page: params.page || 1,
                                limit: 20
                            };
                        },
                    }
                    @endif
                });
                jQuery($refs.input).on('select2:select', (e)=> {
                    value = e.params.data.id;
                })
"
    >
        <select name="{{$name}}" id="{{$name}}"
                {{ $attributes->whereDoesntStartWith('wire:model')->merge(['class'=>'form-control']) }}
                x-ref="input"
                x-bind:value="value"
        >
            {{$slot}}
        </select>
    </div>

    @error($name)
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>


