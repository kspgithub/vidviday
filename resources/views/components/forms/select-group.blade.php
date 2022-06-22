@props([
    'name' => '',
    'id' => null,
    'value' => '',
    'label' => '',
    'placeholder' => '',
    'type' => 'text',
    'readonly'=> false,
    'help' => '',
    'options'=> [],
    'labelCol' => 'col-md-2',
    'inputCol' => 'col-md-10',
    'rowClass' => 'row mb-3',
    'select2' => false,
    'autocomplete'=> false,
    'allowClear'=> false,
    'filters'=> [],
])
@php
    if($placeholder && isset($options[0]) && ($options[0]['value'] ?? $options[0]['id']) ) {
        if(is_array($options)) {
            array_unshift($options,['id' => 0, 'title' => $placeholder]);
        }
        if($options instanceof Illuminate\Support\Collection) {
            $options->prepend(['id' => 0, 'title' => $placeholder]);
        }
    }
@endphp

<div class="form-group {{$rowClass}}">

<div class="{{$labelCol}} col-form-label">
    @lang($label)
    @if(isset($attributes['required']) || isset($attributes['x-bind:required']))
        <span class="text-danger">*</span>
    @endif
</div>

<div class="{{$inputCol}}">
    <div
        @if($select2)
            {{--Share x-model with parent if exists--}}
            @if($attributes->has('x-model'))
                x-modelable="value" x-model="{{$attributes->get('x-model')}}"
            @endif

            @if($attributes->has('wire:model'))
                x-data="{value: @entangle($attributes->get('wire:model'))}"
            @else
                x-data="{value: ''}"
            @endif
            x-init="

                @if($attributes->has('wire:model') && $attributes->has('wire:ignore') && count($options))
                    if($refs.input) {
                        jQuery($refs.input).find('option[value]').remove()
                        //jQuery($refs.input).html('')
                        @foreach($options as $option)
                            newOption = new Option(jQuery('<div/>').html('{{ $option['text'] ?? $option['title'] }}').text(), '{{ $option['value'] ?? $option['id'] }}', value == '{{ $option['value'] ?? $option['id'] }}', value == '{{ $option['value'] ?? $option['id'] }}')
                            $refs.input.add(newOption)
                        @endforeach
                    }
                @endif

                jQuery($refs.input).select2({
                    placeholder: '{{ $placeholder }}',
                    allowClear: '{{ $allowClear }}',
                    theme: 'bootstrap-5',
                    @if($autocomplete)
                    ajax: {
                        url: '{{ $autocomplete }}',
                        dataType: 'json',
                        quietMillis: 500,
                        data: function (params) {
                            self.prevQuery = params
                            return {
                                q: params.term,
                                page: params.page || 1,
                                limit: 20,
                                @foreach($filters as $key => $value)
                                {{ $key }}: '{{ $value }}',
                                @endforeach
                            };
                        },
                        processResults: function (data) {
                            return data.results ? data : {results: data.map(item => ({id: item.id||item.value, text: item.text})), pagination: {more: false}};
                        },
                        success: function (data) {
                            console.log(data)
                        }
                    },
                    @endif
                });

                jQuery($refs.input).on('select2:select', (e) => {
                    value = e.params.data.id;
                })

                @if($autocomplete)
                jQuery($refs.input).on('select2:opening', function(e) {
                    if (jQuery($refs.input).data('unselecting')) {
                        jQuery($refs.input).removeData('unselecting');
                        setTimeout(function() {
                            jQuery($refs.input).select2('close');
                        }, 1);
                        e.preventDefault()
                    }
                }).on('select2:unselecting', function(e) {
                    jQuery($refs.input).data('unselecting', true);
                    value = 0;
                });
                @endif
                $watch('value', (value) => {
                    jQuery($refs.input).val(value).trigger('change');
                });
             "
        @endif
    >
        <div {{ $attributes->has('wire:ignore') ? 'wire:ignore' : '' }}>
            <select name="{{$name}}"
                    id="{{$id ?? $name}}"
                    {{$readonly ? 'readonly' : ''}}
                    {{ $attributes->merge(['class' => $errors->has($name) ? 'form-control is-invalid' :  'form-control'])->except(['wire:ignore']) }}
                    @if($select2)
                        x-ref="input"
                    @endif
            >
                {{$slot}}
                @if(!($attributes->has('wire:model') && $attributes->has('wire:ignore')))
                    @foreach($options as $option)
                        <option
                            value="{{ $option['value'] ?? $option['id']}}" {{($option['value'] ?? $option['id']) == $value ? 'selected' : ''}}>{{ html_entity_decode($option['text'] ?? $option['title'])}}</option>
                    @endforeach
                @endif
            </select>
        </div>

    </div>
    @if(!empty($help))
        <div class="form-text">{{$help}}</div>
    @endif
    @error($name)
    <div class="invalid-feedback d-block">
        {{$message}}
    </div>
    @enderror

</div>
</div><!--form-group-->

