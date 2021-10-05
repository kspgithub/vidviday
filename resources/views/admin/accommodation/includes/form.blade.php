
<x-forms.text-group name="title" :label="__('Title')" :value="old('title', $accommodation->title)" maxlength="200"
                    required></x-forms.text-group>

<x-forms.text-group name="title_where" :label="__('Title Where')"
                    :value="old('title_where', $accommodation->title_where)"
                    maxlength="200"
                    required></x-forms.text-group>

<x-forms.location-group
    :city-id="$accommodation->city_id"
    :city="$accommodation->city"
    :region-id="$accommodation->region_id"
    :region="$accommodation->region"
    :regions="$regions"
    :map="false"
></x-forms.location-group>

<x-forms.textarea-group name="text" :label="__('Description')" :value="old('description', $accommodation->text)"
                        maxlength="500"></x-forms.textarea-group>

<x-forms.text-group name="slug" :label="__('Slug')" :value="old('slug', $accommodation->slug)" maxlength="100"
                    :help="__('Leave blank for automatic generation')"></x-forms.text-group>


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
