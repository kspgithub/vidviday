<div class="card">
    <div class="card-body">
        <x-forms.select-group name="country_id" :label="__('Country')"
                              :value="old('country_id', $region->country_id)"
                              :options="$countries"
                              required></x-forms.select-group>

        <x-forms.text-loc-group name="title" :label="__('Title')"
                                :value="old('title', $region->getTranslations('title'))"
                                required/>

    </div>
</div>
