<x-bootstrap.card>
    <x-slot name="body">

        <x-forms.translation-switch/>

        <x-forms.editor-loc-group name="title" :label="__('Title')"
                                  :value="old('title', $achievement->getTranslations('title'))"
                                  rows="2"
                                  required></x-forms.editor-loc-group>


        <x-forms.single-image-upload name="image" :label="__('Image')"
                                     :value="$achievement->image"
                                     :preview="$achievement->image ? $achievement->image_url : ''"
                                     accept=".jpg,.png,.svg"
                                     imgstyle="height: 112px;"/>

        <x-forms.switch-group name="published" :label="__('Published')" :active="$achievement->published"/>
    </x-slot>
</x-bootstrap.card>

