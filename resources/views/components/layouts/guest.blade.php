@props(['title' => null, 'subtitle' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ $title ? $title.' · '.config('app.name') : config('app.name') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="relative flex min-h-screen flex-col overflow-hidden bg-slate-900">
        <div
            class="pointer-events-none absolute -top-40 -left-40 size-[32rem] rounded-full bg-indigo-600/30 blur-3xl"
        ></div>
        <div
            class="pointer-events-none absolute -right-32 -bottom-40 size-[28rem] rounded-full bg-fuchsia-600/20 blur-3xl"
        ></div>

        <div class="relative flex flex-1 flex-col items-center justify-center px-4 py-12">
            <div class="w-full max-w-md">
                <div class="mb-8 flex flex-col items-center text-center">
                    <x-logo class="size-12" />
                    <h1 class="mt-5 text-2xl font-bold text-white">{{ $title }}</h1>
                    @if ($subtitle)
                        <p class="mt-2 text-sm text-slate-400">{{ $subtitle }}</p>
                    @endif
                </div>

                <x-flash />

                <div class="rounded-2xl border border-white/10 bg-white/95 p-7 shadow-2xl shadow-black/30 backdrop-blur">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <p class="relative pb-8 text-center text-xs text-slate-500">
            &copy; {{ now()->year }} {{ config('app.name') }}
        </p>
    </body>
</html>
