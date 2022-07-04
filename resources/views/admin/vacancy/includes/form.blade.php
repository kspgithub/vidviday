<div>
    <x-bootstrap.card>
        <x-slot name="body">
            <x-forms.translation-switch row-class="row mb-0"/>
        </x-slot>
    </x-bootstrap.card>

    <x-bootstrap.card>
        <x-slot name="header">
            <h3>@lang('Basic Information')</h3>
        </x-slot>

        <x-slot name="body">

            <x-forms.select-group name="staff_id" :label="__('Manager')"
                                  :value="old('staff_id', isset($vacancy->staff()->pluck('id')[0])?$vacancy->staff()->pluck('id')[0]:'')"
                                  :options="$staffs"
                                  required>
                <option value="">Не вибрано</option>
            </x-forms.select-group>

            <x-forms.text-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $vacancy->getTranslations('title'))" maxlength="100"
                                    required/>
            <x-forms.text-loc-group name="slug" :label="__('Slug')"
                                    :value="old('slug', $vacancy->getTranslations('slug'))"
                                    help="Залиште порожнім для автоматичної генерації"
            />
            <x-forms.textarea-loc-group name="short_text" :label="__('Short Text')"
                                        :value="old('short_text', $vacancy->getTranslations('short_text'))"/>
            <x-forms.editor-loc-group name="text" :label="__('Text')"
                                      :value="old('text', $vacancy->getTranslations('text'))"
                                      maxlength="100"/>

            <x-forms.switch-group name="published" :label="__('Published')" :active="$vacancy->published"/>

            <x-forms.datepicker-group name="created_at"
                                      :label="__('Created At')"
                                      :value="old('created_at', $vacancy->created_at->format('d.m.Y'))"
            />

            <x-forms.tag-group name="similar[]"
                               :label="__('Similar vacancies')"
                               :value="$vacancy->similar ?? []"
                               :options="$vacancies">
            </x-forms.tag-group>
        </x-slot>
    </x-bootstrap.card>
    <x-bootstrap.card>
        <x-slot name="header">
            <h3>@lang('Seo Information')</h3>
        </x-slot>
        <x-slot name="body">

            <x-forms.text-loc-group name="seo_h1" :label="__('SEO H1')"
                                    :value="old('seo_h1', $vacancy->getTranslations('seo_h1'))"></x-forms.text-loc-group>
            <x-forms.text-loc-group name="seo_title" :label="__('SEO Title')"
                                    :value="old('seo_title',  $vacancy->getTranslations('seo_title'))"></x-forms.text-loc-group>
            <x-forms.text-loc-group name="seo_description" :label="__('SEO Description')"
                                    :value="old('seo_description', $vacancy->getTranslations('seo_description'))"></x-forms.text-loc-group>
            <x-forms.text-loc-group name="seo_keywords" :label="__('SEO Keywords')"
                                    :value="old('seo_keywords', $vacancy->getTranslations('seo_keywords'))"></x-forms.text-loc-group>
            <x-forms.editor-loc-group name="seo_text" :label="__('SEO Text')"
                                      :value="old('seo_text', $vacancy->getTranslations('seo_text'))"></x-forms.editor-loc-group>
        </x-slot>
    </x-bootstrap.card>


</div>
