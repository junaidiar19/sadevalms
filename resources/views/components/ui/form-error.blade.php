@props(['name'])

@error($name)
    <p {{ $attributes->class(['text-xs text-red-500 mt-1']) }}>{{ $message }}</p>
@enderror
