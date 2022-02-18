<div>
    <x-bootstrap.card>
        <x-slot name="header"><h3>@lang('Basic Information')</h3></x-slot>
        <x-slot name="body">
            <x-forms.translation-switch/>
            <x-forms.text-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $model->getTranslations('title'))"
                                    required></x-forms.text-loc-group>

            <x-forms.editor-loc-group name="description" :label="__('Description')"
                                      :value="old('description', $model->getTranslations('description'))"/>

            <x-forms.text-group name="lat" :label="__('Latitude')" :value="old('lat', $model->lat)" required/>
            <x-forms.text-group name="lng" :label="__('Longitude')" :value="old('lng', $model->lng)" required/>
        </x-slot>

    </x-bootstrap.card>


</div>
