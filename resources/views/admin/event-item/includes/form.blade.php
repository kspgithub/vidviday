<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $eventItem->title)" maxlength="100" required ></x-forms.text-group>
        <x-forms.text-group name="slug" :label="__('Slug')" :value="old('slug', $eventItem->slug)"
                            :help="__('Leave blank for automatic generation')"
                            maxlength="100" ></x-forms.text-group>


        <x-forms.editor-group name="text" :label="__('Text')" :value="old('text', $eventItem->text)"  ></x-forms.editor-group>

        <x-forms.switch-group name="published" :label="__('Published')" :active="$eventItem->published"></x-forms.switch-group>

        <x-forms.switch-group name="indefinite" :label="__('Indefinite')" :active="$eventItem->indefinite"></x-forms.switch-group>




        <x-forms.select-group name="event_id" :label="__('Events')" :value="old('event_id', $eventItem->event_id)"  :options="$events" type="text" required></x-forms.select-group>

        <x-forms.select-default-group name="group_id" :label="__('Groups')" :value="old('group_id', $eventItem->group_id)"  :options="$eventGroups" type="text"></x-forms.select-default-group>

        <x-forms.select-default-group name="direction_id" :label="__('Directions')" :value="old('direction_id', $eventItem->direction_id)"  :options="$directions" type="text"></x-forms.select-default-group>

        <x-forms.datepicker-group
            :label="__('Start Date')"
            id="start_date"
            name="start_date"
            placeholder="{{ __('Start Date')}}"
            value="{{$eventItem->start_date}}"
            class="me-2"
        />
        <x-forms.datepicker-group
            :label="__('End Date')"
            id="end_date"
            name="end_date"
            placeholder="{{ __('End Date')}}"
            value="{{$eventItem->end_date}}"
        />

        <x-forms.single-image-upload name="main_image" :value="$eventItem->main_image"  :label="__('Main Image')" />
        <x-forms.single-image-upload name="mobile_image" :value="$eventItem->mobile_image"  :label="__('Mobile Image')"
                                     help="320x320"
                                     imgstyle="height: 200px; width: 200px; object-fit: cover;"
        />
    </x-slot>
</x-bootstrap.card>

<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Seo Information')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.text-group name="seo_h1" :label="__('SEO H1')" :value="old('seo_h1', $eventItem->seo_h1)"></x-forms.text-group>
        <x-forms.text-group name="seo_title" :label="__('SEO Title')" :value="old('seo_title', $eventItem->seo_title)"></x-forms.text-group>
        <x-forms.text-group name="seo_description" :label="__('SEO Description')" :value="old('seo_description', $eventItem->seo_description)"></x-forms.text-group>
        <x-forms.text-group name="seo_keywords" :label="__('SEO Keywords')" :value="old('seo_keywords', $eventItem->seo_keywords)"></x-forms.text-group>
    </x-slot>
</x-bootstrap.card>





