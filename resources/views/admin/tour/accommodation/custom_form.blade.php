<div>

    <x-forms.translation-switch/>

    <x-forms.text-loc-group wire:model="form.title" name="title" :label="__('Title')"/>

    <x-forms.textarea-loc-group wire:model="form.text" name="text" :label="__('Text')"/>

    <x-forms.select-group wire:model="form.country_id" name="country_id" :label="__('Country')"
                          wire:ignore
                          :select2="true"
                          :allowClear="true"
                          :placeholder="__('Не вибрано')"
                          :options="$countries">
        <option value="0">Не вибрано</option>
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.region_id" name="region_id" :label="__('Region')"
                          :select2="true"
                          :allowClear="true"
                          autocomplete="/api/location/regions?paginate=1"
                          :placeholder="__('Не вибрано')"
                          :filters="[
                              'city_id' => $form['city_id'] ?? 0,
                              'region_id' => $form['region_id'] ?? 0,
                              'country_id' => $form['country_id'] ?? 0,
                           ]"
                          :options="$regions">
        <option value="0">Не вибрано</option>
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.city_id" name="city_id" :label="__('City')"
                          :select2="true"
                          :allowClear="true"
                          autocomplete="/api/location/cities?paginate=1"
                          :placeholder="__('Не вибрано')"
                          :filters="[
                              'city_id' => $form['city_id'] ?? 0,
                              'region_id' => $form['region_id'] ?? 0,
                              'country_id' => $form['country_id'] ?? 0,
                           ]"
                          :options="$cities">
        <option value="0">Не вибрано</option>
    </x-forms.select-group>


    @if($model->exists)
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
    @endif
</div>

