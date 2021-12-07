<div>
    <x-forms.select-group name="country_id" :label="__('Country')"
                          :value="old('country_id', $city->country_id)"
                          :options="$countries"
                          required>
        <option value="">Не вибрано</option>
    </x-forms.select-group>

    <x-forms.select-group name="region_id" :label="__('Region')"
                          :value="old('region_id', $city->region_id)"
                          :options="$regions"
                          required>
        <option value="">Не вибрано</option>
    </x-forms.select-group>

    <x-forms.select-group name="district_id" :label="__('District')"
                          :value="old('district_id', $city->district_id)"
                          :options="$districts"
                          required>
        <option value="">Не вибрано</option>
    </x-forms.select-group>

    <x-forms.text-loc-group name="title" :label="__('Title')" :value="old('title', $city->getTranslations('title'))"
                            required></x-forms.text-loc-group>

    <x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $city->slug)" maxlength="100"
                        :help="__('Leave blank for automatic generation')"></x-forms.text-group>
</div>
