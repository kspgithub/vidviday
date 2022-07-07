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

        <x-forms.editor-loc-group name="text" :label="__('Text')"
                                    :value="old('text', $advertisement->getTranslations('text'))"></x-forms.editor-loc-group>

        <x-forms.single-image-upload name="image" :label="__('Image')"
                                     :value="$advertisement->image"
                                     :preview="$advertisement->image ? $advertisement->image_url : ''"
                                     imgstyle="height: 200px;"/>

        <x-forms.datepicker-group name="starts_at" :label="__('Starts at')"
                                :value="old('starts_at', $advertisement->starts_at)"
        ></x-forms.datepicker-group>

        <x-forms.tag-group name="pages[]"
                           :label="__('Pages')"
                           :value="$advertisement->pages ?: []"
                           :options="$pages">
        </x-forms.tag-group>

        <x-forms.text-group name="timeout"
                            :label="__('Timeout')"
                            :value="$advertisement->timeout ?: 5000"
        />

        <x-forms.switch-group name="published" :label="__('Published')" :active="$advertisement->published"/>
    </x-slot>
</x-bootstrap.card>

