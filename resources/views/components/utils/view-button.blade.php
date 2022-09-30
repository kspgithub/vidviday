@props(['href' => '#', 'target' => null, 'text'=>__('View'), 'title'=>__('View'), 'permission' => false])

<x-utils.link :href="$href" :target="$target" class="btn btn-outline-info btn-sm" :title="$title" icon="fas fa-eye" :text="$text" permission="{{ $permission }}" />
