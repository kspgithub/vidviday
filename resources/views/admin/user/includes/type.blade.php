@if ($user->isAdmin())
    @lang('Administrator')
@elseif ($user->isTourist())
    @lang('Tourist')
@elseif ($user->isTourAgent())
    @lang('Tour Agent')
@else
    @lang('N/A')
@endif
