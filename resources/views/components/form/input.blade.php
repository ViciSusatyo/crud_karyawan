@props(['name', 'label' => null, 'type' => 'text', 'value' => null, 'hint' => null, 'icon' => null])

@php
    $invalid = $errors->has($name);
@endphp

<div {{ $attributes->only('class')->merge(['class' => 'space-y-1.5']) }}>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-slate-700">
            {{ $label }}
            @if ($errors->has($name))
                <span class="text-rose-500">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        @if ($icon)
            <span class="pointer-events-none absolute inset-y-0 left-0 grid w-10 place-items-center text-slate-400">
                <x-icon :name="$icon" class="size-4" />
            </span>
        @endif

        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="{{ $type }}"
            value="{{ old($name, $value) }}"
            @required($attributes->has('required'))
            @class([
                'block w-full rounded-xl border bg-white px-3.5 py-2.5 text-sm text-slate-900 shadow-xs transition',
                'focus:ring-2 focus:outline-none',
                'pl-10' => $icon,
                'border-rose-300 focus:border-rose-400 focus:ring-rose-100' => $invalid,
                'border-slate-200 focus:border-indigo-500 focus:ring-indigo-100' => ! $invalid,
            ])
        />
    </div>

    @if ($hint && ! $invalid)
        <p class="text-xs text-slate-400">{{ $hint }}</p>
    @endif

    @error($name)
        <p class="flex items-center gap-1.5 text-xs font-medium text-rose-600">
            <x-icon name="exclamation" class="size-3.5" />
            {{ $message }}
        </p>
    @enderror
</div>
