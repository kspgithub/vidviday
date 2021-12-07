@props([
    'method'=>'POST'
])
<div x-data="translatable()">
    <form method="post"
          {{ $attributes->except(['method'])->merge(['action' => '#', 'class' => 'form-horizontal']) }} x-ref="form">
        @csrf
        @method($method)

        {{ $slot }}

        <button class="btn btn-primary" type="submit" x-on:click.prevent="submit()">@lang('Save')</button>
    </form>
</div>
