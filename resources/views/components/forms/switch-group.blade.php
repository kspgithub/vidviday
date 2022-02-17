@props([
    'name' => '',
    'id' => null,
    'active' => false,
    'label'=>'',
    'activeValue'=>1,
    'inactiveValue'=>0,
    'help'=>'',
    'labelCol'=>'col-md-2',
    'inputCol'=>'col-md-10',
])
<div class="form-group row mb-3 align-items-center">
    <div class="m-0 {{$labelCol}} col-form-label">
        <span class="form-check-label">
            {{$label}}
            @if(isset($attributes['required']) || isset($attributes['x-bind:required']))
                <span class="text-danger">*</span>
            @endif
        </span>
    </div>
    <div class="m-0 {{$inputCol}}">
        <div class="form-check form-switch ms-0">
            @if($inactiveValue !== null)
                <input type="hidden" name="{{$name}}" value="{{$inactiveValue}}">
            @endif
            <input
                {{$active ? 'checked' : ''}} name="{{$name}}" value="{{$activeValue}}" type="checkbox"
                id="{{$id ?? $name}}"
                {{ $attributes->merge(['class' => 'form-check-input']) }}
            >
            <label class="form-check-label" for="{{$id ?? $name}}"></label>
        </div>
        @if(!empty($help))
            <div class="form-text">{{$help}}</div>
        @endif
    </div>
</div>
