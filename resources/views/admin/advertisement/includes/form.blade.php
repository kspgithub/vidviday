<x-bootstrap.card>
    <x-slot name="body">

        <x-forms.translation-switch/>

        <x-forms.textarea-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $advertisement->getTranslations('title'))"
                                    rows="2"
                                    required></x-forms.textarea-loc-group>

        <x-forms.text-loc-group name="url" :label="__('Url')"
                                :value="old('url', $advertisement->getTranslations('url'))"
                                help="Не обов'язково"
        ></x-forms.text-loc-group>

        <x-forms.textarea-loc-group name="text" :label="__('Text')"
                                    :value="old('text', $advertisement->getTranslations('text'))"></x-forms.textarea-loc-group>


        <x-forms.single-image-upload name="image" :label="__('Image')"
                                     :value="$advertisement->image"
                                     :preview="$advertisement->image ? $advertisement->image_url : ''"
                                     imgstyle="height: 200px;"/>

        <x-forms.switch-group name="published" :label="__('Published')" :active="$advertisement->published"/>
    </x-slot>
</x-bootstrap.card>

