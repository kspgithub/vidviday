
<x-forms.text-group name="title" :label="__('Title')" :value="old('title', $accommodation->title)" maxlength="100" required ></x-forms.text-group>

<x-forms.select-group name="region_id" :label="__('Regions')" :value="old('region_id', $accommodation->region_id)" :options="$regions" type="text"></x-forms.select-group>

<x-forms.text-group name="populated_area" :label="__('Populated area')" :value="old('populated_area', $accommodation->populated_area)"></x-forms.text-group>

<x-forms.text-group name="place" :label="__('Place')" :value="old('place', $accommodation->place)"></x-forms.text-group>

<x-forms.textarea-group name="text" :label="__('Description')" :value="old('description', $accommodation->text)" maxlength="500" required ></x-forms.textarea-group>

<x-forms.text-group name="slug" :label="__('Slug')" :value="old('slug', $accommodation->slug)" maxlength="100" :help="__('Leave blank for automatic generation')" ></x-forms.text-group>


@if($accommodation->id > 0)
    <div class="form-group row mb-3">
        <div  class="col-md-2 col-form-label">@lang('Pictures')</div>
        <div class="col-md-10">
            <x-utils.media-library
                :model="$accommodation"
            ></x-utils.media-library>
        </div>
    </div>
@endif
