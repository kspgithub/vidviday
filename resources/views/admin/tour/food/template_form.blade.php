<div>
    <x-forms.select-group wire:model="form.day" name="day" :label="__('Day')"
                          wire:ignore
                          :select2="true"
                          :allowClear="true"
                          :required="true"
                          :placeholder="__('Не вибрано')">
        @for($day = 1; $day <= $tour->duration; $day++)
            <option value="{{$day}}">{{$day}}-й день</option>
        @endfor
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.time_id" name="time_id" :label="__('Time')"
                          wire:ignore
                          :select2="true"
                          :allowClear="true"
                          :placeholder="__('Не вибрано')"
                          :options="$foodTimes">
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.country_id" name="country_id" :label="__('Country')"
                          wire:ignore
                          :select2="true"
                          :allowClear="true"
                          :placeholder="__('Не вибрано')"
                          :options="$countries">
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.region_id" name="region_id" :label="__('Region')"
                          wire:ignore
                          :select2="true"
                          :allowClear="true"
                          :placeholder="__('Не вибрано')"
                          :options="$regions">
    </x-forms.select-group>

    <x-forms.select-group wire:model="form.food_id" name="food_id" :label="__('Template')"
                          wire:ignore
                          :select2="true"
                          :allowClear="true"
                          :placeholder="__('Не вибрано')"
                          :options="$foodItems" >
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
