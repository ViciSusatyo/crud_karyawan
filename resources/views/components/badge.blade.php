@props(['jabatan'])

@php
    $tones = [
        'bg-indigo-50 text-indigo-700 ring-indigo-600/20',
        'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
        'bg-amber-50 text-amber-700 ring-amber-600/20',
        'bg-sky-50 text-sky-700 ring-sky-600/20',
        'bg-fuchsia-50 text-fuchsia-700 ring-fuchsia-600/20',
    ];

    $tone = $tones[crc32($jabatan) % count($tones)];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset '.$tone]) }}>
    {{ $jabatan }}
</span>
