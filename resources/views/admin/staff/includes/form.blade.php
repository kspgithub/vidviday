<x-bootstrap.card>

    <x-slot name="header">
        <h3>@lang('Staff')</h3>
    </x-slot>

    <x-slot name="body">
        <x-forms.translation-switch/>

        <x-forms.text-loc-group name="first_name" :label="__('First name')"
                                :value="$staff->getTranslations('first_name')"
                                maxlength="100" required/>

        <x-forms.text-loc-group name="last_name" :label="__('Last name')"
                                :value="$staff->getTranslations('last_name')"
                                maxlength="100" required/>

        <x-forms.text-loc-group name="label" :label="__('Label')" :value="$staff->getTranslations('label')"
                                maxlength="100" help="Наприклад: Бронювання турів"/>

        <x-forms.text-loc-group name="position" :label="__('Position')" :value="$staff->getTranslations('position')"
                                help="Наприклад: менеджер з продажу подарункових сертифікатів та рецепції"/>

        <x-forms.editor-loc-group name="text" :label="__('Text')"
                                  :value="$staff->getTranslations('text')"></x-forms.editor-loc-group>

        <x-forms.select-group name="user_id" :label="__('User')"
                              :value="old('user_id', $staff->user_id)"
                              :options="$users"

        >
            <option value="">Не обов'язково</option>
        </x-forms.select-group>

        <x-forms.checkbox-group name="types[]" :label="__('Type')"
                                :value="$staff->types ? $staff->types->pluck('id')->toArray() : []"
                                :options="$staffTypes"
                                required
        />

        <x-forms.single-image-upload
            name="avatar"
            :label="__('Avatar')"
            accept=".jpg,.png"
            class="image-uploader"
            :value="$staff->avatar"
            :preview="$staff->avatar ? $staff->avatar_url : ''"
            imgstyle="height: 200px; width: 200px; object-fit: cover;">
        </x-forms.single-image-upload>

        <x-forms.text-group name="video"
                            type="url"
                            :label="__('Youtube Video')"
                            :value="old('video', $staff->video)"
        ></x-forms.text-group>


        <x-forms.text-group
            name="email"
            type="email"
            :label="__('Email')"
            :placeholder="__('E-mail Address')"
            :value="old('email', $staff->email)"
            maxlength="255"
            required
        ></x-forms.text-group>
        <x-forms.text-group name="phone" :label="__('Phone')" :value="old('phone', $staff->phone)"
                            maxlength="100"></x-forms.text-group>
        <x-forms.text-group name="skype" :label="__('Skype')" :value="old('skype', $staff->skype)"
                            maxlength="100"></x-forms.text-group>
        <x-forms.text-group name="viber" :label="__('Viber')" :value="old('viber', $staff->viber)"
                            maxlength="100"></x-forms.text-group>
        <x-forms.text-group name="telegram" :label="__('Telegram')" :value="old('telegram', $staff->telegram)"
                            maxlength="100"></x-forms.text-group>
        <x-forms.text-group name="whatsapp" :label="__('Whatsapp')" :value="old('whatsapp', $staff->whatsapp)"
                            maxlength="100"></x-forms.text-group>

        <x-forms.editor-loc-group name="additional" :label="__('Додаткові контакти')"
                                  :value="$staff->getTranslations('additional')"/>

        <br>

        <x-forms.switch-group name="published" label="Активовано" :active="old('published', $staff->published)"/>


    </x-slot>

</x-bootstrap.card>

@if($staff->id > 0)
    <x-bootstrap.card>
        <x-slot name="header">
            <h3>@lang('Photos')</h3>
        </x-slot>
        <x-slot name="body">
            <x-utils.media-library :model="$staff"></x-utils.media-library>
        </x-slot>
    </x-bootstrap.card>
@endif
