<div>
    <x-forms.select-group wire:model="form.day" name="day" :label="__('Day')">
        @for($day = 1; $day <= $tour->duration; $day++)
            <option value="{{$day}}">{{$day}}-й день</option>
        @endfor
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.time_id" name="time_id" :label="__('Time')"
                          :options="$foodTimes">
        <option value="0">Не вибрано</option>
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.country_id" name="country_id" :label="__('Country')"
                          :foodholder="__('Не вибрано')"
                          :options="$countries">
        <option value="0">Не вибрано</option>
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.region_id" name="region_id" :label="__('Region')"
                          :select2="true"
                          :allowClear="true"
                          autocomplete="/api/location/regions?paginate=1"
                          :foodholder="__('Не вибрано')"
                          :filters="[
                              'region_id' => $form['region_id'] ?? 0,
                              'district_id' => $form['district_id'] ?? 0,
                           ]"
                          :options="$regions">
        <option value="0">Не вибрано</option>
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.food_id" name="food_id" :label="__('Template')"
                          wire:ignore
                          :select2="true"
                          :allowClear="true"
                          :foodholder="__('Не вибрано')"
                          :options="$foodItems" >
        <option value="0">Не вибрано</option>
    </x-forms.select-group>

    @if($form['food_id'] && $food)
        <div>

            <x-forms.translation-switch/>

            <x-forms.html-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $food->getTranslations('title'))"/>

            <x-forms.html-loc-group name="text" :label="__('Text')"
                                    :value="old('text', $food->getTranslations('text'))"/>
        </div>
    @endif

</div>
