<component :is="'{{ $component }}'" v-bind="{{ json_encode($props) }}">{!! $slot ?? '' !!}</component>
