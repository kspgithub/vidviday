<x-bootstrap.card>
    <x-slot name="body">
        <x-forms.translation-switch/>
        <x-forms.text-loc-group name="title" :label="__('Title')"
                                :value="old('title', $transport->getTranslations('title'))" maxlength="100"
                                required></x-forms.text-loc-group>
        <x-forms.text-loc-group name="text" :label="__('Text')"
                                :value="old('text',  $transport->getTranslations('text'))"
                                required></x-forms.text-loc-group>
        <x-forms.single-image-upload name="image" :label="__('Image')"
                                     :required="empty($transport->image)"
                                     :value="$transport->image"
                                     :preview="$transport->image ? $transport->image_url : ''"/>

        <x-forms.switch-group name="published" :label="__('Published')" :active="$transport->published"/>
    </x-slot>
</x-bootstrap.card>
