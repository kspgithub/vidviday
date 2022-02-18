<div class="card">
    <div class="card-body">
        <x-forms.text-loc-group name="title" :label="__('Title')"
                                :value="old('title', $country->getTranslations('title'))" required/>

        <x-forms.text-group name="iso" :label="__('Iso')" :value="old('iso', $country->iso)" required/>

        <x-forms.text-group name="slug" :label="__('Slug')" :value="old('slug', $country->slug)" required/>
    </div>
</div>
