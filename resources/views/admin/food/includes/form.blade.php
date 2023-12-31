<div>
    <x-forms.translation-switch/>

    <x-forms.select-group :label="__('Час')" name="time_id" :value="$model->time_id" :options="$foodTimes"/>
    <x-forms.select-group :label="__('Країна')" name="country_id" :value="$model->country_id" :options="$countries"/>
    <x-forms.select-group :label="__('Область')" name="region_id" :value="$model->region_id" :options="$regions"/>

    <x-forms.text-loc-group name="title" :label="__('Title')"
                            :value="old('title', $model->getTranslations('title'))" maxlength="100"
                            required></x-forms.text-loc-group>
    <x-forms.editor-loc-group name="text" :label="__('Text')" :value="old('text', $model->getTranslations('text'))"
                              required></x-forms.editor-loc-group>
    <x-forms.text-group name="price" :label="__('Price')" :value="old('price', $model->price)"
                        required
                        type="number"></x-forms.text-group>
    <x-forms.select-group name="currency" :label="__('Currency')" :value="old('currency', $model->currency)"
                          :options="$currencies" type="text"></x-forms.select-group>

    <input type="hidden" name="published" value="1">

    @if($model->id > 0)
        <hr>
        <div class="row">
            <div class="col-md-2">
                @lang('Gallery')

            </div>
            <div class="col-md-10">
                <x-utils.media-library
                    :model="$model"
                ></x-utils.media-library>
            </div>
        </div>
    @else
        <x-forms.files-group name="media[]" id="media" label="Зображення" multiple accept=".jpg,.jpeg,.png"/>
    @endif

</div>
