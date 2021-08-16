<x-bootstrap.card>

    <x-slot name="header">
        <h3>@lang('Staff')</h3>
    </x-slot>

    <x-slot name="body">
        <x-forms.select-group name="user_id" :label="__('User')"
                              :value="old('user_id', $staff->user_id)"
                              :options="$users"

        >
            <option value="">Не обов'язково</option>
        </x-forms.select-group>

        <x-forms.checkbox-group name="types" :label="__('Type')"
                                :value="$staff->types ? $staff->types->pluck('id')->toArray() : []"
                                :options="$staffTypes"
                                required
        />

        <x-forms.text-group name="first_name" :label="__('First name')" :value="old('first_name', $staff->first_name)"
                            maxlength="100" required></x-forms.text-group>
        <x-forms.text-group name="last_name" :label="__('Last name')" :value="old('last_name', $staff->last_name)"
                            maxlength="100" required></x-forms.text-group>
        <x-forms.text-group name="position" :label="__('Position')" :value="old('position', $staff->position)"
                            maxlength="100"></x-forms.text-group>
        <x-forms.single-image-upload
            name="avatar"
            :label="__('Avatar')"
            accept=".jpg,.png"
            class="image-uploader"
            imgstyle="height: 200px; width: 200px; object-fit: cover;">
        </x-forms.single-image-upload>
        <x-forms.textarea-group name="text" :label="__('Text')" :value="old('text', $staff->text)"></x-forms.textarea-group>
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

        <br>
        <div class="row">
            <label class="form-label col-md-2" for="Published">Активовано</label>
            <div class="col-md-10">
                <select class="form-select" maxlength="100" name="published"
                        value="old('published', $staff->published)">
                    <option value="1">так</option>
                    <option value="0">ні</option>
                </select>
            </div>
        </div>


    </x-slot>

</x-bootstrap.card>

