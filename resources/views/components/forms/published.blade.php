@props([
    'name' => 'published',
    'id' => 'published',
    'active' => false,
    'label'=>__('Published'),
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
            <input type="hidden" name="{{$name}}" :value="active ? 1 : 0">
            <input type="checkbox"
                   id="{{$id}}" {{ $attributes->merge(['class' => 'form-check-input'])->except('x-model') }} >
            <label class="form-check-label" for="{{$id}}"></label>
        </div>
        @if(!empty($help))
            <div class="form-text">{{$help}}</div>
        @endif
    </div>
</div>

