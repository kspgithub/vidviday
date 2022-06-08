@props([
    'name' => '',
    'placeholder' => '',
    'value' => null,
    'url'=> false,
])

<div>
    <div>
        <div
            x-data="{
            value: {{is_string($value) ? "'$value'" : (string)$value}},
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
                jQuery($refs.input).on('select2:select', (e) => {
                    value = e.params.data.id;
                })
                $watch('value', (value) => {
                    jQuery($refs.input).select2().val(value).trigger('change');
                });
"
        >
            <select name="{{$name}}" id="{{$name}}"
                    {{ $attributes->merge(['class'=>'form-control']) }}
                    x-ref="input"
                    x-bind:value="value"
            >
                {{$slot}}
            </select>
        </div>
    </div>


    @error($name)
    <div class="invalid-feedback d-block">
        {{$message}}
    </div>
    @enderror
</div>


