<x-forms.translation-switch/>
<x-forms.select-group name="type_id" :label="__('Type')" :options="$types" :value="$model->type_id">
    <option value="">Не вибрано</option>
</x-forms.select-group>

<x-forms.text-loc-group name="title" :label="__('Title')" :value="old('title', $model->getTranslations('title'))"
                        required></x-forms.text-loc-group>
<x-forms.editor-loc-group name="text" :label="__('Description')"
                          :value="old('text', $model->getTranslations('text'))"></x-forms.editor-loc-group>
<x-forms.switch-group name="published" :label="__('Published')" :active="$model->published"></x-forms.switch-group>
