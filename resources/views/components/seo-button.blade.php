<{{ $tag }} {{ $attributes->merge($config)->merge([
    ...($tag === 'component' ? ['is' => $as] : []),
]) }}>
    {{ $slot }}
</{{ $tag }}>
