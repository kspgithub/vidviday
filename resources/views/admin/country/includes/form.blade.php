<div class="card">
    <div class="card-body">
        <x-forms.text-loc-group name="title" :label="__('Title')"
                                :value="old('title', $country->getTranslations('title'))" required/>

        <x-forms.text-group name="iso" :label="__('Iso')" :value="old('iso', $country->iso)" required/>

        <x-forms.text-group name="slug" :label="__('Slug')" :value="old('slug', $country->slug)" required/>

        <x-forms.text-group name="phone_code" :label="__('Phone code')" :value="old('phone_code', $country->phone_code)" required/>

        <x-forms.text-group name="phone_mask" :label="__('Phone mask')" help="`9` : numeric;\n`a` : alphabetical;\n`*` : alphanumeric" :value="old('phone_mask', $country->phone_mask)" required/>

        <x-forms.text-group name="phone_rule" :label="__('Phone rule (regex)')" help="/regex/" :value="old('phone_rule', $country->phone_rule)" required/>
    </div>
</div>
