@extends('admin.layout.app')

@section('title', __('Create User'))

@section('content')
    <div class="d-flex justify-content-between">
        <h2> @lang('Create User')</h2>
        <div>
            <x-utils.link class="btn btn-sm btn-outline-secondary" :href="route('admin.user.index')"
                          :text="__('Cancel')"/>
        </div>
    </div>

    <x-forms.post :action="route('admin.user.store')" enctype="multipart/form-data">
        <x-bootstrap.card>

            <x-slot name="body">
                <div x-data="{role : 'tourist', status: 1}">

                    <x-forms.select-group
                        name="role"
                        label="Основна роль"
                        :value="old('role')"
                        required
                        x-on:change="role = $event.target.value"
                        :options="\App\Models\Role::toSelectBox()"
                    ></x-forms.select-group>

                    <x-forms.single-image-upload
                        name="avatar"
                        :label="__('Avatar')"
                        accept=".jpg,.png"
                        class="image-uploader"
                        imgstyle="height: 200px; width: 200px; object-fit: cover;"
                    >
                    </x-forms.single-image-upload>
                    <x-forms.text-group
                        name="email"
                        type="email"
                        :label="__('Email')"
                        :placeholder="__('E-mail Address')"
                        :value="old('email')"
                        maxlength="255"
                        required
                    ></x-forms.text-group>


                    <x-forms.text-group name="first_name" :label="__('First Name')" :value="old('first_name')"
                                        maxlength="100"></x-forms.text-group>
                    <x-forms.text-group name="last_name" :label="__('Last Name')" :value="old('last_name')"
                                        maxlength="100"></x-forms.text-group>
                    <x-forms.text-group name="middle_name" :label="__('Middle Name')" :value="old('middle_name')"
                                        maxlength="100"></x-forms.text-group>
                    <x-forms.text-group name="mobile_phone" :label="__('Mobile Phone')"
                                        :value="old('mobile_phone')"></x-forms.text-group>
                    <x-forms.text-group name="viber" :label="__('Viber')" :value="old('viber')"></x-forms.text-group>

                    <x-forms.datepicker-group name="birthday" :label="__('Date of Birth')" :value="old('birthday') "
                                              maxlength="100"/>

                    <template x-if="role === 'tour-agent'">
                        <div class="my-5">
                            <x-forms.text-group name="company" :label="__('Company')"
                                                :value="old('company') ?? $user->company"></x-forms.text-group>
                            <x-forms.text-group name="address" :label="__('Address')"
                                                :value="old('address') ?? $user->address"></x-forms.text-group>
                            <x-forms.text-group name="position" :label="__('Position')"
                                                :value="old('position') ?? $user->position"></x-forms.text-group>
                            <x-forms.text-group name="website" :label="__('Website')"
                                                :value="old('website') ?? $user->website"></x-forms.text-group>
                            <x-forms.text-group name="work_phone" :label="__('Work Phone')"
                                                :value="old('work_phone') ?? $user->work_phone"></x-forms.text-group>
                            <x-forms.text-group name="work_email" :label="__('Work Email')"
                                                :value="old('work_email') ?? $user->work_email"></x-forms.text-group>
                        </div>

                    </template>

                    <x-forms.text-group type="password" name="password" :label="__('Password')" maxlength="100" required
                                        autocomplete="new-password"></x-forms.text-group>

                    <x-forms.text-group type="password" name="password_confirmation"
                                        :label="__('Password Confirmation')" maxlength="100" required
                                        autocomplete="new-password"></x-forms.text-group>

                    <x-forms.select-group
                        name="status"
                        :label="__('Status')"
                        :value="old('status')"
                        required
                        :options="[
                            ['value'=>1, 'text'=>__('Active')],
                            ['value'=>0, 'text'=>__('Inactive')],

                        ]"
                    ></x-forms.select-group>


                    <div x-data="{ emailVerified : false }">

                        <x-forms.switch-group
                            name="email_verified"
                            :label="__('E-mail Verified')"
                            :value="1"
                            :active="false"
                            type="checkbox"
                            x-on:change="emailVerified = !emailVerified"
                        ></x-forms.switch-group>


                        <div x-show="!emailVerified">
                            <x-forms.switch-group
                                name="send_confirmation_email"
                                :label="__('Send Confirmation E-mail')"
                            ></x-forms.switch-group>


                        </div>
                    </div>

                </div>
            </x-slot>
        </x-bootstrap.card>

        <x-bootstrap.card>
            <x-slot name="header">
                <h3>@lang('Bitrix 24')</h3>
            </x-slot>
            <x-slot name="body">
                <x-forms.text-group name="bitrix_id" :label="__('Bitrix ID')"
                                    :value="old('bitrix_id')"
                                    maxlength="100"></x-forms.text-group>

            </x-slot>
        </x-bootstrap.card>

        <button class="btn btn-primary" type="submit">@lang('Create User')</button>
    </x-forms.post>

@endsection

