@props([
    'name' => '',
    'value' => '',
    'label'=>'',
    'placeholder' => '',

    'help'=>'',
    'options'=>[],
])


<select {{ $attributes->merge(['class' => 'form-control']) }} >
    {{$slot}}
    @foreach($options as $option)
        <option
            value="{{ $option['value']}}" {{$option['value'] === $value ? 'selected' : ''}}>{{ $option['text']}}</option>
    @endforeach
</select>
