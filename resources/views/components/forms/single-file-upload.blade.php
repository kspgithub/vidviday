@props([
    'name' => '',
    'value' => '',
    'label'=>'',
    'placeholder' => '',
    'type'=>'text',
    'options'=>[],
    'storage'=>false,
    'help'=>'',
    'imgstyle'=>'height: 200px;',
    'labelCol'=>'col-md-2',
    'inputCol'=>'col-md-10',
    'accept'=>'.jpg,.png,.gif,.pdf,.doc,.docx',
])

<div class="form-group row mb-3 file-upload-group">
    <div class="{{$labelCol}} col-form-label">@lang($label)</div>

    <div class="{{$inputCol}}" x-data="singleFileUpload({value: '{{$value}}'})">
        <div class="file-thumbnail-wrp" x-show="!!value">
            <a href="{{$value}}" target="_blank">{{$value}}</a>
            <a href="#" x-on:click.prevent="clear()" class="clear-image text-danger" title="@lang('Clear image')">
                <i data-feather="x"></i>
            </a>
        </div>
        <input type="hidden" name="{{$name}}" class="old-file" x-bind:value="value">
        <input accept="{{$accept}}" type="file" id="{{$name}}"
               name="{{$name.'_upload'}}"
               x-ref="fileInputRef"
               x-on:change="onChange"
            {{ $attributes->merge(['class' => 'form-control']) }}
        >
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


