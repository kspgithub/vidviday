<div class="card">
    <div class="card-body">
        <x-forms.text-loc-group name="title" :label="__('Title')"
                                :value="old('title', $country->getTranslations('title'))"
                                maxlength="100"
                                required></x-forms.text-loc-group>

        <x-forms.text-group name="iso" :label="__('Iso')" :value="old('slug', $country->iso)" maxlength="10"
                            required></x-forms.text-group>
    </div>
</div>
