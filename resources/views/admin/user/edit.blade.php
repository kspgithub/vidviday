@extends('admin.layout.app')

@section('title', __('Update User'))

@section('content')
    <div class="d-flex justify-content-between">
        <h2> @lang('Update User')</h2>
        <div>
            <x-utils.link class="btn btn-sm btn-outline-secondary" :href="route('admin.user.index')" :text="__('Cancel')" />
        </div>
    </div>

    <x-forms.patch :action="route('admin.user.update', $user)" enctype="multipart/form-data">
        <x-bootstrap.card>

            <x-slot name="body">
                <div x-data="{role : '{{ $user->role }}'}">
                    @if (!$user->isMasterAdmin())
                        <x-forms.select-group
                            name="role"
                            :label="__('Role')"
                            :value="old('role') ?? $user->role"
                            required
                            x-on:change="role = $event.target.value"
                            :options="[
                                        ['value'=>'tourist', 'text'=>__('Tourist')],
                                        ['value'=>'tour-agent', 'text'=>__('Tour Agent')],
                                        ['value'=>'admin', 'text'=>__('Administrator')],
                                    ]"
                        ></x-forms.select-group>
                    @else
                        <input type="hidden" name="role" value="admin">
                    @endif
                    <x-forms.single-image-upload
                        name="avatar"
                        :label="__('Avatar')"
                        accept=".jpg,.png"
                        class="image-uploader"
                        :value="$user->avatar"
                        imgstyle="height: 200px; width: 200px; object-fit: cover;"
                    >
                    </x-forms.single-image-upload>
                    <x-forms.text-group
                        name="email"
                        type="email"
                        :label="__('Email')"
                        :placeholder="__('E-mail Address')"
                        :value="old('email') ?? $user->email"
                        maxlength="255"
                        required
                    ></x-forms.text-group>




                    <x-forms.text-group name="first_name" :label="__('First Name')" :value="old('first_name') ?? $user->first_name" maxlength="100"></x-forms.text-group>
                    <x-forms.text-group name="last_name" :label="__('Last Name')" :value="old('last_name') ?? $user->last_name" maxlength="100"></x-forms.text-group>
                    <x-forms.text-group name="middle_name" :label="__('Middle Name')" :value="old('last_name') ?? $user->middle_name" maxlength="100"></x-forms.text-group>
                    <x-forms.text-group name="mobile_phone" :label="__('Mobile Phone')" :value="old('mobile_phone') ?? $user->mobile_phone" maxlength="100"></x-forms.text-group>

                    <x-forms.datepicker-group name="birthday" :label="__('Date of Birth')" :value="old('birthday') ?? $user->birthday" maxlength="100" />

                    <template x-if="role === 'tour-agent'">
                        <div>
                            <x-forms.text-group name="company" :label="__('Company')" :value="old('company') ?? $user->company" ></x-forms.text-group>
                            <x-forms.text-group name="address" :label="__('Address')" :value="old('address') ?? $user->address" ></x-forms.text-group>
                            <x-forms.text-group name="position" :label="__('Position')" :value="old('position') ?? $user->position" ></x-forms.text-group>
                            <x-forms.text-group name="website" :label="__('Website')" :value="old('website') ?? $user->website" ></x-forms.text-group>
                            <x-forms.text-group name="work_phone" :label="__('Work Phone')" :value="old('work_phone') ?? $user->work_phone"></x-forms.text-group>
                            <x-forms.text-group name="work_email" :label="__('Work Email')" :value="old('work_email') ?? $user->work_email"></x-forms.text-group>
                        </div>
                    </template>

                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-primary float-right" type="submit">@lang('Update User')</button>
            </x-slot>
        </x-bootstrap.card>
    </x-forms.patch>
@endsection
