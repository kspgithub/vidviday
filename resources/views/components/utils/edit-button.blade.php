@props(['href' => '#', 'permission' => false, 'text'=>__('Edit'), 'title'=>__('Edit')])

<x-utils.link :href="$href" class="btn btn-outline-primary btn-sm" icon="fas fa-pencil-alt" :title="$title" :text="$text" permission="{{ $permission }}" />
