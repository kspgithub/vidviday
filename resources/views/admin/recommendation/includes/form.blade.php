<x-bootstrap.card>
    <x-slot name="body">
        <x-forms.translation-switch/>
        <x-forms.text-loc-group name="name" :label="__('Name')"
                                :value="old('name', $recommendation->getTranslations('name'))" required/>

        <x-forms.text-loc-group name="company" :label="__('Компанія')"
                                :value="old('company', $recommendation->getTranslations('company'))"/>

        <x-forms.single-image-upload
            name="avatar"
            :label="__('Avatar')"
            accept=".jpg,.png"
            class="image-uploader"
            :value="$recommendation->avatar"
            :preview="$recommendation->avatar ? $recommendation->avatar_url : ''"
            imgstyle="height: 200px; width: 200px; object-fit: cover;">
        </x-forms.single-image-upload>

        <x-forms.editor-loc-group name="text" :label="__('Text')"
                                  :value="old('text', $recommendation->getTranslations('text'))"></x-forms.editor-loc-group>

        <x-forms.text-group type="number" name="rating" label="Рейтинг" :value="$recommendation->rating"/>

        <x-forms.switch-group name="published" :label="__('Published')" :active="$recommendation->published"/>
    </x-slot>

</x-bootstrap.card>

