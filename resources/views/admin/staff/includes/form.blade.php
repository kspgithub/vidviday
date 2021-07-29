<x-bootstrap.card>

    <x-slot name="header">
        <h3>@lang('Staff')</h3>
    </x-slot>

    <x-slot name="body">
        <x-forms.select-group name="user_id" :label="__('user')"
        :value="old('user_id', isset($staff->user()->pluck('id')[0])?$staff->user()->pluck('id')[0]:'')"
        :options="$users"
        required></x-forms.select-group>
        <x-forms.text-group name="type" :label="__('type')" :value="old('type', $staff->type)" maxlength="100" required ></x-forms.text-group>
        <x-forms.text-group name="first_name" :label="__('first_name')" :value="old('first_name', $staff->first_name)" maxlength="100" required></x-forms.text-group>
        <x-forms.text-group name="last_name" :label="__('last_name')" :value="old('last_name', $staff->last_name)" maxlength="100" required></x-forms.text-group>
        <x-forms.text-group name="position" :label="__('position')" :value="old('position', $staff->position)" maxlength="100" ></x-forms.text-group>
        <x-forms.single-image-upload
        name="avatar"
        :label="__('Avatar')"
        accept=".jpg,.png"
        class="image-uploader"
        imgstyle="height: 200px; width: 200px; object-fit: cover;">
        </x-forms.single-image-upload>
        <x-forms.text-group name="text" :label="__('text')" :value="old('text', $staff->text)" maxlength="100"></x-forms.text-group>
        <x-forms.text-group
                        name="email"
                        type="email"
                        :label="__('Email')"
                        :placeholder="__('E-mail Address')"
                        :value="old('email')"
                        maxlength="255"
                        required
                    ></x-forms.text-group>
        <x-forms.text-group name="phone" :label="__('phone')" :value="old('phone', $staff->phone)" maxlength="100" ></x-forms.text-group>
        <x-forms.text-group name="viber" :label="__('viber')" :value="old('viber', $staff->viber)" maxlength="100" ></x-forms.text-group>
        <x-forms.text-group name="telegram" :label="__('telegram')" :value="old('telegram', $staff->telegram)" maxlength="100" ></x-forms.text-group>
        <x-forms.text-group name="whatsapp" :label="__('whatsapp')" :value="old('whatsapp', $staff->whatsapp)" maxlength="100" ></x-forms.text-group>
        <br>
        <div class="row">
            <label class="form-label col-md-2" for="Published">Активовано</label>
            <div class="col-md-10">
            <select class="form-select" maxlength="100" name="published" value="old('published', $staff->published)">
                <option value="1">так</option>
                <option value="0">ні</option>
            </select>
            </div>
            </div>


    </x-slot>

</x-bootstrap.card>

