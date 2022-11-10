@props([
    'component' => '',
    'props' => [],
])

<div v-is="'{{ $component }}'" :props="{{ json_encode($props) }}" {{ $attributes }}>
    <slot />
</div>
