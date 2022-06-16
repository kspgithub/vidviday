<div>

    <x-forms.select-group wire:model="form.day" name="day" :label="__('Day')">
        <option value="0">Не вибрано</option>
        @for($day = 1; $day <= $tour->duration; $day++)
            <option value="{{$day}}">{{$day}}-й день</option>
        @endfor
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.time_id" name="time_id" :label="__('Time')"
                          :options="$foodTimes">
        <option value="0">Не вибрано</option>
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.country_id" name="country_id" :label="__('Country')"
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
                              'region_id' => $form['region_id'] ?? 0,
                              'district_id' => $form['district_id'] ?? 0,
                           ]"
                          :options="$regions">
        <option value="0">Не вибрано</option>
    </x-forms.select-group>


    <x-forms.translation-switch/>

    <x-forms.text-loc-group wire:model="form.title" name="title" :label="__('Title')"/>

    <x-forms.textarea-loc-group wire:model="form.text" name="text" :label="__('Text')"/>

    <x-forms.text-group wire:model="form.price" name="price" :label="__('Price')"
                        required
                        type="number"></x-forms.text-group>
    <x-forms.select-group wire:model="form.currency" name="currency" :label="__('Currency')"
                          :options="$currencies" type="text"></x-forms.select-group>


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
    @else
        <x-forms.files-group name="media[]" id="media" label="Зображення" multiple accept=".jpg,.jpeg,.png"/>
    @endif
</div>

