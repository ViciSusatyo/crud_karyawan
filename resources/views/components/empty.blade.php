@props(['title' => 'Belum ada data', 'description' => null, 'icon' => 'inbox'])

<div {{ $attributes->merge(['class' => 'card flex flex-col items-center gap-3 px-6 py-14 text-center']) }}>
    <span class="grid size-12 place-items-center rounded-2xl bg-slate-100 text-slate-400">
        <x-icon :name="$icon" class="size-6" />
    </span>

    <div>
        <p class="text-sm font-semibold text-slate-800">{{ $title }}</p>
        @if ($description)
            <p class="mx-auto mt-1 max-w-sm text-sm text-slate-500">{{ $description }}</p>
        @endif
    </div>

    {{ $slot }}
</div>
