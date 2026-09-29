@php
    $messages = [
        'success' => ['icon' => 'check-circle', 'class' => 'border-emerald-200 bg-emerald-50 text-emerald-800'],
        'error' => ['icon' => 'exclamation', 'class' => 'border-rose-200 bg-rose-50 text-rose-800'],
        'info' => ['icon' => 'inbox', 'class' => 'border-sky-200 bg-sky-50 text-sky-800'],
    ];
@endphp

@foreach ($messages as $key => $style)
    @if (session()->has($key))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition
            class="mb-6 flex items-start gap-3 rounded-xl border px-4 py-3 text-sm font-medium {{ $style['class'] }}"
            role="alert"
        >
            <x-icon :name="$style['icon']" class="mt-0.5 size-5 shrink-0" />
            <p class="flex-1">{{ session($key) }}</p>
            <button type="button" @click="show = false" class="shrink-0 opacity-60 transition hover:opacity-100">
                <x-icon name="x-mark" class="size-4" />
            </button>
        </div>
    @endif
@endforeach

@if ($errors->any() && ! $errors->has('email'))
    <div class="mb-6 flex items-start gap-3 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-800" role="alert">
        <x-icon name="exclamation" class="mt-0.5 size-5 shrink-0" />
        <ul class="flex-1 space-y-1">
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
