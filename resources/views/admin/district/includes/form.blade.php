<div class="card">
    <div class="card-body">
        <x-forms.select-group name="country_id" :label="__('Country')"
                              :value="old('country_id', $district->country_id)"
                              :options="$countries"
                              required>
            <option value="">Не вибрано</option>
        </x-forms.select-group>

        <x-forms.select-group name="region_id" :label="__('Region')"
                              :value="old('region_id', $district->region_id)"
                              :options="$regions"
                              required>
            <option value="">Не вибрано</option>
        </x-forms.select-group>


        <x-forms.text-loc-group name="title" :label="__('Title')"
                                :value="old('title', $district->getTranslations('title'))"
                                required></x-forms.text-loc-group>

        {{--    <x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $district->slug)"--}}
        {{--                        :help="__('Leave blank for automatic generation')"></x-forms.text-group>--}}
    </div>

</div>
