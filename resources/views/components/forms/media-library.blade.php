@props([
    'name'=>'media',
    'label'=>'',
    'items'=> null,
    'labelCol'=>'col-md-3',
    'inputCol'=>'col-md-9',
    'accept'=>'.jpg,.png,.jpeg'
])
<div class="form-group row mb-3">
    <div class="{{$labelCol}} col-form-label">{{$label}}@if(isset($attributes['required'])) <span class="text-danger">*</span>@endif</div>
    <div class="{{$inputCol}}">
        <div class="media-library" data-media-library="{{$name}}">
            @foreach($items as $item)
                <x-utils.media :media="$item" :name="$name"></x-utils.media>
            @endforeach

            <label class="img-thumbnail add-media">
                <input type="file">
                <i class="fas fa-plus"></i>
            </label>
        </div>
    </div>
</div>

