@props(['active' => '', 'text' => '', 'title' => '', 'hide' => false, 'icon' => false, 'permission' => false, 'target' => null])

@if ($permission)
    @if (current_user()->can($permission))
        @if (!$hide)
            <a {{ $attributes->merge(['href' => '#', 'class' => $active]) }} {{ $target ? 'target="'.$target.'"' : '' }} title="{{$title}}">@if ($icon)<i class="{{ $icon }}"></i> @endif{{ strlen($text) ? $text : $slot }}</a>
        @endif
    @endif
@else
    @if (!$hide)
        <a {{ $attributes->merge(['href' => '#', 'class' => $active]) }} {{ $target ? 'target="'.$target.'"' : '' }} title="{{$title}}">@if ($icon)<i class="{{ $icon }}"></i> @endif{{ strlen($text) ? $text : $slot }}</a>
    @endif
@endif
