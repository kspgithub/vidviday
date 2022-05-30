<div x-data='@json($event)'>
    <x-bootstrap.card>
        <x-slot name="header">
            <h3>@lang('Basic Information')</h3>
        </x-slot>
        <x-slot name="body">
            <x-forms.translation-switch/>
            <x-forms.text-loc-group name="title" :label="__('Title')"
                                    :value="old('title', $event->getTranslations('title'))"
                                    required/>
            <x-forms.text-loc-group name="slug" :label="__('Url')" :value="old('slug',$event->getTranslations('slug'))"
                                    :help="__('Leave blank for automatic generation')"/>

            <x-forms.editor-loc-group name="text" :label="__('Full Text')"
                                      :value="old('text', $event->getTranslations('text'))" required/>

            <x-forms.textarea-loc-group name="short_text" :label="__('Short Text')"
                                        :value="old('short_text', $event->getTranslations('short_text'))"
                                        rows="5"/>

            <x-forms.tag-group name="directions[]"
                               :label="__('Directions')"
                               :value="$event->directions ?  $event->directions->pluck('id')->toArray() : []"
                               :options="$directions">
            </x-forms.tag-group>

            <x-forms.tag-group name="groups[]"
                               :label="__('Groups')"
                               :value="$event->groups ?  $event->groups->pluck('id')->toArray() : []"
                               :options="$groups">
            </x-forms.tag-group>


            <x-forms.datepicker-group
                :label="__('Start Date')"
                id="start_date"
                name="start_date"
                placeholder="{{ __('Start Date')}}"
                value="{{$event->start_date}}"
            />

            <x-forms.datepicker-group
                :label="__('End Date')"
                id="end_date"
                name="end_date"
                placeholder="{{ __('End Date')}}"
                value="{{$event->end_date}}"
            />

            <x-forms.switch-group name="published" :label="__('Published')"
                                  :active="$event->published"></x-forms.switch-group>
        </x-slot>
    </x-bootstrap.card>

    <x-bootstrap.card>
        <x-slot name="header">
            <h3>@lang('Seo Information')</h3>
        </x-slot>
        <x-slot name="body">
            <x-forms.text-loc-group name="seo_h1" :label="__('SEO H1')"
                                    :value="old('seo_h1', $event->getTranslations('seo_h1'))"/>
            <x-forms.text-loc-group name="seo_title" :label="__('SEO Title')"
                                    :value="old('seo_title',  $event->getTranslations('seo_title'))"/>
            <x-forms.text-loc-group name="seo_description" :label="__('SEO Description')"
                                    :value="old('seo_description', $event->getTranslations('seo_description'))"/>
            <x-forms.text-loc-group name="seo_keywords" :label="__('SEO Keywords')"
                                    :value="old('seo_keywords',  $event->getTranslations('seo_keywords'))"/>
            <x-forms.editor-loc-group name="seo_text" :label="__('SEO Text')"
                                      :value="old('seo_text', $event->getTranslations('seo_text'))"></x-forms.editor-loc-group>
        </x-slot>
    </x-bootstrap.card>

    @if($event->id > 0)
        <x-bootstrap.card>
            <x-slot name="header">
                <h3>@lang('Pictures')</h3>
            </x-slot>
            <x-slot name="body">
                <x-utils.media-library :model="$event"></x-utils.media-library>
            </x-slot>
        </x-bootstrap.card>
    @endif


</div>



