@if ($user->isAdmin())
    @lang('Administrator')
@elseif ($user->isTourist())
    @lang('Tourist')
@elseif ($user->isTourAgent())
    @lang('Tour Agent')
@else
    {{ucfirst(str_replace('-', ' ', $user->role))}}
@endif
