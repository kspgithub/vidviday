@extends('admin.layout.app')

@section('title', __('Change Password for :name', ['name' => $user->name]))

@section('content')
    {!! breadcrumbs([
['url'=>route('admin.dashboard'), 'title'=>__('Dashboard')],
['url'=>route('admin.user.index'), 'title'=>__('Users')],
['url'=>route('admin.user.show', $user), 'title'=>$user->email],
['url'=>route('admin.user.change-password', $user), 'title'=>'Зміна паролю'],
]) !!}

    <div class="d-flex justify-content-between">
        <h2> @lang('Change Password for :name', ['name' => $user->email])</h2>
        <div>
            <x-utils.link class="btn btn-sm btn-outline-secondary" :href="route('admin.user.index')"
                          :text="__('Cancel')"/>
        </div>
    </div>

    <x-forms.patch :action="route('admin.user.change-password.update', $user)">
        <div class="card">

            <div class="card-body">
                <div class="form-group row mb-3">
                    <label for="password" class="col-md-2 col-form-label">@lang('Password')</label>

                    <div class="col-md-10">
                        <input type="password" name="password" id="password" class="form-control"
                               placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="new-password"/>
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="password_confirmation"
                           class="col-md-2 col-form-label">@lang('Password Confirmation')</label>

                    <div class="col-md-10">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="form-control" placeholder="{{ __('Password Confirmation') }}" maxlength="100"
                               required autocomplete="new-password"/>
                    </div>
                </div><!--form-group-->
            </div>
        </div>

        <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update')</button>
    </x-forms.patch>
@endsection
