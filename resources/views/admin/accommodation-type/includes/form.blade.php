<div class="card">
    <div class="card-body">
        <x-forms.translation-switch/>

        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $type->title)" maxlength="100"
                            required></x-forms.text-group>
        <x-forms.textarea-loc-group name="description" :label="__('Description')"
                                    :value="old('description', $type->getTranslations('description'))" maxlength="500"
                                    required></x-forms.textarea-loc-group>

        <x-forms.text-group name="slug" :label="__('Key')" :value="old('slug', $type->slug)" maxlength="100"
                            :help="__('Leave blank for automatic generation')"></x-forms.text-group>

    </div>
</div>
