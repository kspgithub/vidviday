<div class="card">
    <div class="card-body">
        <x-forms.translation-switch/>

        <x-forms.textarea-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $questionType->getTranslations('title'))"/>

        <x-forms.select-group name="type" :label="__('Type')" :value="old('type', $questionType->type)"
                              :options="$types">
            <option value=""></option>
        </x-forms.select-group>

        <x-forms.select-group name="manager_id" :label="__('Manager')" :value="old('manager_id', $questionType->manager_id)"
                              :options="$managers">
            <option value=""></option>
        </x-forms.select-group>

        <x-forms.text-group name="email" :label="__('Email')"
                                    :value="old('email', $questionType->email)"/>

        <x-forms.switch-group name="published" :label="__('Published')"
                              :active="old('published', $questionType->published)"/>
    </div>


</div>
