@props(['href', 'icon' => 'home', 'active' => false])

<a
    href="{{ $href }}"
    @class([
        'flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition',
        'bg-indigo-600/15 text-white shadow-inner ring-1 ring-indigo-500/30' => $active,
        'text-slate-300 hover:bg-white/5 hover:text-white' => ! $active,
    ])
>
    <x-icon :name="$icon" @class(['size-5 shrink-0', 'text-indigo-300' => $active, 'text-slate-500' => ! $active]) />
    <span>{{ $slot }}</span>
</a>
