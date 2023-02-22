<{{ $tag }} {{ $attributes->merge($config)->merge(['is' => $as]) }}>
    {{ $slot }}
</{{ $tag }}>
