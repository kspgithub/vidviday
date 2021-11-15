<x-bootstrap.card>
    <x-slot name="body">

        <x-forms.translation-switch/>

        <x-forms.textarea-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $ourClient->getTranslations('title'))"
                                    rows="2"
                                    required></x-forms.textarea-loc-group>


        <x-forms.single-image-upload name="image" :label="__('Image')"
                                     :value="$ourClient->image"
                                     :preview="$ourClient->image ? $ourClient->image_url : ''"
                                     imgstyle="height: 112px;"/>

        <x-forms.switch-group name="published" :label="__('Published')" :active="$ourClient->published"/>
    </x-slot>
</x-bootstrap.card>

