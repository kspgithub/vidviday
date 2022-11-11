<div v-is="'{{ $component }}'" :props="{{ json_encode($props) }}">
    <slot />
</div>
