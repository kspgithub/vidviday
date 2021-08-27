<div class="bread-crumbs">
    <a href="{{ route("home") }}">{{ __("Головна") }}</a>
    <span>—</span>
    <span>{{ __("Новини") }}</span>

    @if(isset($title)) <span>{{ $title }}</span> @endif

</div>
