<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Basic Information')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.switch-group name="published" label="Опублікований" :active="old('published', $tour->published)"/>

        <x-forms.switch-group name="order_enabled" label="Замовлення" :active="old('order_enabled', $tour->order_enabled)"/>

        <x-forms.switch-group name="home_disabled" label="Відключити показ на головній" :active="old('home_disabled', $tour->home_disabled)"/>

        <x-forms.text-group name="priority" :label="__('Priority')" :value="old('priority', $tour->priority)"
                            type="number"></x-forms.text-group>

        <x-forms.switch-group name="show_map" label="Показати карту" :active="old('show_map', $tour->show_map)"/>

        <x-forms.locales :value="$tour->locales ?? ['uk']" :use-fallback="false"/>

        <x-forms.translation-switch/>

        <x-forms.text-loc-group name="title" :label="__('Title')"
                                :value="old('title', $tour->getTranslations('title'))"
                                maxlength="100"
                                required></x-forms.text-loc-group>
        <x-forms.text-loc-group name="slug" :label="__('Url')"
                                :value="old('slug', $tour->getTranslations('slug'))"
                                required
                                maxlength="100"/>

        <x-forms.textarea-loc-group name="short_text" :label="__('Short Text')"
                                    :value="old('short_text', $tour->getTranslations('short_text'))"
                                    :help="__('Leave blank for automatic generation')"
                                    rows="5"
        ></x-forms.textarea-loc-group>

        <x-forms.editor-loc-group name="text" :label="__('Full Text')"
                                  :value="old('text', $tour->getTranslations('text'))"
                                  required></x-forms.editor-loc-group>

        <x-forms.select-group name="duration_format" :label="__('Format')"
                              :value="old('duration_format', $tour->duration_format)"
                              :options="$durationFormats" type="number"></x-forms.select-group>

        <x-forms.text-group name="duration" :label="__('Days')" :value="old('duration', $tour->duration)"
                            type="number" required></x-forms.text-group>
        <x-forms.text-group name="nights" :label="__('Nights')" :value="old('nights', $tour->nights)"
                            type="number" required></x-forms.text-group>
        <x-forms.text-group name="time" :label="__('Time')" :value="old('time', $tour->time)"
                            type="text"></x-forms.text-group>
        <x-forms.text-group name="price" :label="__('Price')" :value="old('price', $tour->price)" type="number"
                            required></x-forms.text-group>
        <x-forms.text-group name="commission" :label="__('Commission')"
                            :value="old('commission', $tour->commission)" type="number"/>
        <x-forms.text-group name="accomm_price" label="Доп. за поселення" required
                            :value="old('accomm_price', $tour->accomm_price)" type="number"/>

        <x-forms.select-group name="currency" :label="__('Currency')" :value="old('currency', $tour->currency)"
                              :options="$currencies" type="number"></x-forms.select-group>

        @php
            $main_image_alts = [];
            $main_image_titles = [];
            foreach (siteLocales() as $locale) {
                $main_image_alts[$locale] = $tour->getFirstMedia('main')->custom_properties['alt_' . $locale] ?? '';
                $main_image_titles[$locale] = $tour->getFirstMedia('main')->custom_properties['title_' . $locale] ?? '';
            }
        @endphp
        <x-forms.single-image-upload name="main_image"
                                     :value="$tour->getFirstMediaUrl('main')"
                                     :preview="$tour->getFirstMediaUrl('main')"
                                     help="1500х1000"
                                     :label="__('Main Image')">
            <slot>
                <x-forms.translation-switch/>

                <x-forms.text-loc-group name="main_image_alts" :label="__('Alt')"
                                        :value="old('main_image_alts', $main_image_alts)"
                                        maxlength="100"/>
                <x-forms.text-loc-group name="main_image_titles" :label="__('Title')"
                                        :value="old('main_image_titles', $main_image_titles)"
                                        maxlength="100"/>
            </slot>
        </x-forms.single-image-upload>

        @php
            $mobile_image_alts = [];
            $mobile_image_titles = [];
            foreach (siteLocales() as $locale) {
                $mobile_image_alts[$locale] = $tour->getFirstMedia('mobile')->custom_properties['alt_' . $locale] ?? '';
                $mobile_image_titles[$locale] = $tour->getFirstMedia('mobile')->custom_properties['title_' . $locale] ?? '';
            }
        @endphp
        <x-forms.single-image-upload name="mobile_image"
                                     :value="$tour->getFirstMediaUrl('mobile')"
                                     :preview="$tour->getFirstMediaUrl('mobile')"
                                     :label="__('Mobile Image')"
                                     help="320x320"
                                     imgstyle="height: 200px; width: 200px; object-fit: cover;">
            <slot>
                <x-forms.translation-switch/>

                <x-forms.text-loc-group name="mobile_image_alts" :label="__('Alt')"
                                        :value="old('mobile_image_alts', $mobile_image_alts)"
                                        maxlength="100"/>
                <x-forms.text-loc-group name="mobile_image_titles" :label="__('Title')"
                                        :value="old('mobile_image_titles', $mobile_image_titles)"
                                        maxlength="100"/>
            </slot>
        </x-forms.single-image-upload>

        <x-forms.text-group name="video"
                            type="url"
                            :label="__('Youtube Video')"
                            :value="old('video', $tour->video)"
        ></x-forms.text-group>
    </x-slot>
</x-bootstrap.card>

<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Seo Information')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.translation-switch/>

        <x-forms.text-loc-group name="seo_h1" :label="__('SEO H1')"
                                :value="old('seo_h1', $tour->getTranslations('seo_h1'))"></x-forms.text-loc-group>
        <x-forms.text-loc-group name="seo_title" :label="__('SEO Title')"
                                :value="old('seo_title',  $tour->getTranslations('seo_title'))"></x-forms.text-loc-group>
        <x-forms.text-loc-group name="seo_description" :label="__('SEO Description')"
                                :value="old('seo_description', $tour->getTranslations('seo_description'))"></x-forms.text-loc-group>
        <x-forms.text-loc-group name="seo_keywords" :label="__('SEO Keywords')"
                                :value="old('seo_keywords', $tour->getTranslations('seo_keywords'))"></x-forms.text-loc-group>
        <x-forms.editor-loc-group name="seo_text" :label="__('SEO Text')"
                                  :value="old('seo_text', $tour->getTranslations('seo_text'))"></x-forms.editor-loc-group>
    </x-slot>
</x-bootstrap.card>


<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Badges')</h3>
    </x-slot>
    <x-slot name="body">
        @foreach($badges as $badge)
            <div class="form-check form-switch form-check-inline mb-3 me-4">
                <input class="form-check-input" name="badges[]"
                       type="checkbox" value="{{$badge->id}}" id="badge-{{$badge->id}}"
                    {{$tour->badges->contains('id', $badge->id) ? 'checked' : ''}}
                >
                <label class="form-check-label" for="badge-{{$badge->id}}">
                    {{$badge->title}}
                </label>
            </div>

        @endforeach
    </x-slot>
</x-bootstrap.card>

<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Additional Info')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.tag-group name="directions[]"
                           :label="__('Directions')"
                           :value="$tour->directions ?  $tour->directions->pluck('id')->toArray() : []"
                           :options="$directions">
        </x-forms.tag-group>

        <x-forms.tag-group name="groups[]"
                           :label="__('Categories')"
                           :value="$tour->groups ?  $tour->groups->pluck('id')->toArray() : []"
                           :options="$groups">
        </x-forms.tag-group>

        <x-forms.tag-group name="events[]"
                           :label="__('Events')"
                           :value="$tour->events ?  $tour->events->pluck('id')->toArray() : []"
                           :options="$events">
        </x-forms.tag-group>

        <x-forms.tag-group name="types[]"
                           :label="__('Types')"
                           :value="$tour->types ?  $tour->types->pluck('id')->toArray() : []"
                           :options="$types">
        </x-forms.tag-group>

        {{--        <x-forms.tag-group name="subjects[]"--}}
        {{--                           :label="__('Subjects')"--}}
        {{--                           :value="$tour->subjects ?  $tour->subjects->pluck('id')->toArray() : []"--}}
        {{--                           :options="$subjects">--}}
        {{--        </x-forms.tag-group>--}}
    </x-slot>
</x-bootstrap.card>


<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Staff')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.select-group name="manager_id"
                              :label="__('Tour Manager')"
                              :value="old('manager_id', $tour->manager_id)"
                              :options="$managers">
            <option value="">Не вибрано</option>
        </x-forms.select-group>

        <x-forms.tag-group name="staff[]"
                           :label="__('Guides')"
                           :value="$tour->tour_guides ?  $tour->tour_guides->pluck('id')->toArray() : []"
                           :options="$guides">
        </x-forms.tag-group>

    </x-slot>
</x-bootstrap.card>

<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Bitrix 24')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.text-group name="bitrix_id" :label="__('Bitrix ID')"
                            :value="old('bitrix_id', $tour->bitrix_id)"
                            maxlength="100"></x-forms.text-group>

        <x-forms.text-group name="bitrix_id" :label="__('Bitrix Manager ID')"
                            :value="old('bitrix_manager_id', $tour->bitrix_manager_id)"
                            maxlength="100"></x-forms.text-group>

    </x-slot>
</x-bootstrap.card>

{{--@include('admin.tour.includes.tour-plan')--}}
