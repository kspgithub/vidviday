@props(['href' => '#', 'permission' => false, 'text'=>__('Action'), 'title'=>null, 'type'=>'secondary', 'icon'=>''])

<x-utils.link :href="$href" class="btn btn-outline-{{$type}} btn-sm" :icon="$icon" :title="$title ?: $text" :text="$text" permission="{{ $permission }}" />
