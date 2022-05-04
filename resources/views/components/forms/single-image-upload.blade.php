@props([
    'name' => '',
    'value' => '',
    'preview' => '',
    'label'=>'',
    'placeholder' => '',
    'type'=>'text',
    'options'=>[],
    'help'=>'',
    'required'=>false,
    'imgstyle'=>'height: 200px;',
    'labelCol'=>'col-md-2',
    'inputCol'=>'col-md-10',
    'accept'=>'.jpg,.png,.gif,.pdf,.doc,.docx',
])

<div class="form-group row mb-3 image-upload-group">
    <div class="{{$labelCol}} col-form-label">
        {{$label}}
        @if($required || isset($attributes['x-bind:required']))
            <span class="text-danger">*</span>
        @endif
    </div>

    <div class="{{$inputCol}}" for="{{$name}}">
        <label class="img-thumbnail-wrp" for="{{$name}}">
            <img src="{{!empty($preview) ? $preview : '/img/no-image.png'}}" alt="{{__($label)}}" style="{{$imgstyle}}"
                 class="img-thumbnail mb-3">
            <a href="#" class="clear-image text-danger {{empty($value) ? 'd-none' : ''}}"
               title="@lang('Clear image')"><i data-feather="x"></i></a>
        </label>
        {!! $slot !!}
        <input type="hidden" name="{{$name}}" class="old-file" value="{{!empty($value) ? $value : ''}}">

        <input accept="{{$accept}}" type="file" id="{{$name}}"
               {{$required ? 'required' : ''}}
               name="{{$name.'_upload'}}" {{ $attributes->merge(['class' => 'form-control']) }}>
        @error($name)
        <div class="invalid-feedback d-block">
            {{$message}}
        </div>
        @enderror
        @if(!empty($help))
            <div class="form-text">{{$help}}</div>
        @endif

    </div>
</div><!--form-group-->


