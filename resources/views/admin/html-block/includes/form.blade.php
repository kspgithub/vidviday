<div x-data="translatable()">

    <x-forms.translation-switch/>

    <x-forms.text-loc-group name="title" :label="__('Title')" :value="old('title', $htmlBlock->getTranslations('title'))" maxlength="100"
                            required></x-forms.text-loc-group>

    <x-forms.text-group name="slug" :label="__('Key')" :value="old('slug', $htmlBlock->slug)"
                            maxlength="100"></x-forms.text-group>

    <x-forms.editor-loc-group name="text" :label="__('Text')" :value="old('text', $htmlBlock->getTranslations('text'))"></x-forms.editor-loc-group>

</div>
