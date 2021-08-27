<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Vacancy')</h3>
    </x-slot>

    <x-slot name="body">
        <x-forms.select-group name="staff_id" :label="__('Manager')"
        :value="old('staff_id', isset($vacancy->staff()->pluck('id')[0])?$vacancy->staff()->pluck('id')[0]:'')"
        :options="$staffs"
        required></x-forms.select-group>
        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $vacancy->title)" maxlength="100" required></x-forms.text-group>
        <x-forms.text-group name="slug" :label="__('Slug')" :value="old('slug', $vacancy->slug)" maxlength="100" ></x-forms.text-group>
        <x-forms.textarea-group name="short_text" :label="__('Short Text')" :value="old('short_text', $vacancy->short_text)" maxlength="100" ></x-forms.textarea-group>
        <x-forms.editor-group name="text" :label="__('Text')" :value="old('text', $vacancy->text)" maxlength="100" ></x-forms.editor-group>
    </x-slot>
</x-bootstrap.card>
<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Seo Information')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.text-group name="seo_title" :label="__('Seo Title')" :value="old('seo_title', $vacancy->seo_title)" maxlength="100" ></x-forms.text-group>
        <x-forms.text-group name="seo_h1" :label="__('Seo H1')" :value="old('seo_h1', $vacancy->seo_h1)" maxlength="100" required></x-forms.text-group>
        <x-forms.text-group name="seo_description" :label="__('Seo Description')" :value="old('seo_description', $vacancy->seo_description)" maxlength="100" ></x-forms.text-group>
        <x-forms.text-group name="seo_keywords" :label="__('Seo Keywords')" :value="old('seo_keywords', $vacancy->seo_keywords)" maxlength="100" ></x-forms.text-group>
   </x-slot>
</x-bootstrap.card>
<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Published')</h3>
    </x-slot>
    <x-slot name="body">
        <div class="row">
            <div class="col-md-10 offset-md-2">
                <label for="published" class="d-none"></label>
                <select class="form-select" maxlength="100" id="published" name="published" value="old('published', $vacancy->published)">
                    <option value="1">так</option>
                    <option value="0">ні</option>
                </select>
            </div>
            </div>


    </x-slot>

</x-bootstrap.card>

