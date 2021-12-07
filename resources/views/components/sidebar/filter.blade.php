<div id="tour-selection-dropdown"
     {{$attributes->merge(['class'=>"sidebar-item selection-tour notice"])}}
     v-is="'sidebar-filter'"
     :options='@json($options)'
>
</div>
