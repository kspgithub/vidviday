<div class="btn-group btn-group-lg mb-3">
    <a href="{{route('admin.user.index')}}" class="btn  {{Route::is('admin.user.index') ? 'btn-primary' : 'btn-outline-primary'}}">@lang('Users')</a>
    <a href="{{route('admin.user.deactivated')}}" class="btn {{Route::is('admin.user.deactivated') ? 'btn-primary' : 'btn-outline-primary'}}">@lang('Deactivated Users')</a>
    <a href="{{route('admin.user.deleted')}}" class="btn {{Route::is('admin.user.deleted') ? 'btn-primary' : 'btn-outline-primary'}}">@lang('Deleted Users')</a>
</div>
