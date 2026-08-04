@props(['value'])

<label {{ $attributes->merge([
    'class' => 'block font-serif text-sm font-bold tracking-wide text-amber-950'
]) }}>
    {{ $value ?? $slot }}
</label>
