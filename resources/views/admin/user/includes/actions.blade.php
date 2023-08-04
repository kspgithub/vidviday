<x-utils.view-button :href="route('admin.user.show', $user)" text="" />

@if (current_user()->isAdmin())


    @if($user->trashed())

        <x-utils.form-button
            :action="route('admin.user.restore', $user)"
            method="patch"
            button-class="btn btn-outline-success btn-sm"
            icon="fas fa-sync-alt"
            name="confirm-item"
            :title="__('Restore')"
        >
            @lang('Restore')
        </x-utils.form-button>
        @if ($user->id !== current_user()->id && !$user->isMasterAdmin())
            <x-utils.delete-button :href="route('admin.user.permanently-delete', $user)" :text="__('Permanently Delete')" />
        @endif
    @else
        <x-utils.link
            :href="route('admin.user.change-password', $user)"
            class="btn btn-outline-warning btn-sm"
            :title="__('Change Password')"
            text=""
        ><i class="fa fa-key"></i></x-utils.link>


        <x-utils.edit-button :href="route('admin.user.edit', $user)" text="" />

        @if($user->isActive() && !$user->isMasterAdmin())
            <x-utils.form-button
                :action="route('admin.user.mark', [$user, 0])"
                method="patch"
                name="confirm-item"
                button-class="btn btn-outline-danger btn-sm"
                :title="__('Deactivate')"
            >
                <i class="fa fa-lock"></i>
            </x-utils.form-button>
        @endif

        @if (! $user->isActive())
            <x-utils.form-button
                :action="route('admin.user.mark', [$user, 1])"
                method="patch"
                button-class="btn btn-outline-success btn-sm"
                icon="fas fa-lock-open"
                name="confirm-item"
                :title="__('Reactivate')"
            >
                @lang('Reactivate')
            </x-utils.form-button>

        @endif
        @if ($user->id !== current_user()->id && !$user->isMasterAdmin())
        <x-utils.delete-button :href="route('admin.user.destroy', $user)" text="" />
        @endif
    @endif


@endif
