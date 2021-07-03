@props([
    'name' => '',
    'active' => false,
    'label'=>'',
    'active_value'=>1,
    'inactive_value'=>0,
    'help'=>'',
    'labelCol'=>'col-md-2',
    'inputCol'=>'col-md-10',
])
<div class="form-group row mb-3 align-items-center">
    <div class="m-0 {{$labelCol}} col-form-label">
        <span class="form-check-label">{{$label}}</span>
    </div>
    <div class="m-0 {{$inputCol}}">
        <div class="form-check form-switch ms-0">
            <input type="hidden" name="{{$name}}" value="{{$inactive_value}}">
            <input
                 {{$active ? 'checked' : ''}} name="{{$name}}" value="{{$active_value}}" type="checkbox" id="{{$name}}"
                 {{ $attributes->merge(['class' => 'form-check-input']) }}
            >
            <label class="form-check-label" for="{{$name}}"></label>
        </div>
        @if(!empty($help))
            <div class="form-text">{{$help}}</div>
        @endif
    </div>
</div>
