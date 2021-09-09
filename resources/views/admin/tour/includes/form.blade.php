<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Basic Information')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.text-group name="title" :label="__('Title')" :value="old('title', $tour->title)" maxlength="100"
                            required></x-forms.text-group>
        <x-forms.text-group name="slug" :label="__('Url')" :value="old('slug', $tour->slug)" maxlength="100"
                            :help="__('Leave blank for automatic generation')"></x-forms.text-group>
        
        <x-forms.textarea-group name="short_text" :label="__('Short Text')"
                                :value="old('short_text', $tour->short_text)"
                                :help="__('Leave blank for automatic generation')"
                                rows="5"
        ></x-forms.textarea-group>

        <x-forms.editor-group name="text" :label="__('Full Text')" :value="old('text', $tour->text)"
                              required></x-forms.editor-group>

        <x-forms.text-group name="duration" :label="__('Days')" :value="old('duration', $tour->duration)"
                            type="number" required></x-forms.text-group>
        <x-forms.text-group name="nights" :label="__('Nights')" :value="old('nights', $tour->nights)"
                            type="number" required></x-forms.text-group>
        <x-forms.text-group name="price" :label="__('Price')" :value="old('price', $tour->price)" type="number"
                            required></x-forms.text-group>
        <x-forms.text-group name="commission" :label="__('Commission')"
                            :value="old('commission', $tour->commission)" type="number"
        ></x-forms.text-group>
        <x-forms.select-group name="currency" :label="__('Currency')" :value="old('currency', $tour->currency)"
                              :options="$currencies" type="number"></x-forms.select-group>
        <x-forms.single-image-upload name="main_image"
                                     :value="$tour->main_image === asset('img/no-image.png') ? '' : $tour->main_image"
                                     :label="__('Main Image')"/>
        <x-forms.single-image-upload name="mobile_image"
                                     :value="$tour->mobile_image === asset('img/no-image.png') ? '' : $tour->mobile_image"
                                     :label="__('Mobile Image')"
                                     help="320x320"
                                     imgstyle="height: 200px; width: 200px; object-fit: cover;"
        />

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
        <x-forms.text-group name="seo_h1" :label="__('SEO H1')"
                            :value="old('seo_h1', $tour->seo_h1)"></x-forms.text-group>
        <x-forms.text-group name="seo_title" :label="__('SEO Title')"
                            :value="old('seo_title', $tour->seo_title)"></x-forms.text-group>
        <x-forms.text-group name="seo_description" :label="__('SEO Description')"
                            :value="old('seo_description', $tour->seo_description)"></x-forms.text-group>
        <x-forms.text-group name="seo_keywords" :label="__('SEO Keywords')"
                            :value="old('seo_keywords', $tour->seo_keywords)"></x-forms.text-group>
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
                           :label="__('Groups')"
                           :value="$tour->groups ?  $tour->groups->pluck('id')->toArray() : []"
                           :options="$groups">
        </x-forms.tag-group>

        <x-forms.tag-group name="types[]"
                           :label="__('Types')"
                           :value="$tour->types ?  $tour->types->pluck('id')->toArray() : []"
                           :options="$types">
        </x-forms.tag-group>

        <x-forms.tag-group name="subjects[]"
                           :label="__('Subjects')"
                           :value="$tour->subjects ?  $tour->subjects->pluck('id')->toArray() : []"
                           :options="$subjects">
        </x-forms.tag-group>
    </x-slot>
</x-bootstrap.card>


<x-bootstrap.card>
    <x-slot name="header">
        <h3>@lang('Staff')</h3>
    </x-slot>
    <x-slot name="body">
        <x-forms.select-group name="staff[]"
                              :label="__('Tour Manager')"
                              :value="old('staff', $tour->tour_manager ?  $tour->tour_manager->id : 0)"
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





