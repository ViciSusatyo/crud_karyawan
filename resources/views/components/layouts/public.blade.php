@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ $title ? $title.' · '.config('app.name') : config('app.name') }}</title>
        <meta
            name="description"
            content="Contoh aplikasi Laravel 12 dengan Blade templating, autentikasi, dan CRUD karyawan."
        />

        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-screen bg-white text-slate-800">
        <header class="sticky top-0 z-30 border-b border-slate-200/80 bg-white/85 backdrop-blur">
            <div class="mx-auto flex h-16 max-w-6xl items-center gap-4 px-4 sm:px-6">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <x-logo class="size-9" />
                    <span class="text-base font-bold tracking-tight text-slate-900">
                        {{ config('app.name') }}
                    </span>
                </a>

                <nav class="ml-auto flex items-center gap-1 sm:gap-2">
                    <a
                        href="{{ route('home') }}#fitur"
                        class="hidden rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 sm:block"
                    >
                        Fitur
                    </a>
                    <a
                        href="{{ route('home') }}#teknologi"
                        class="hidden rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 sm:block"
                    >
                        Teknologi
                    </a>

                    @auth
                        <a
                            href="{{ route('dashboard') }}"
                            class="inline-flex items-center gap-1.5 rounded-lg bg-slate-900 px-3.5 py-2 text-sm font-semibold text-white transition hover:bg-slate-700"
                        >
                            Dashboard
                            <x-icon name="arrow-right" class="size-4" />
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-flex items-center rounded-lg px-3.5 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                        >
                            Masuk
                        </a>
                        <a
                            href="{{ route('login') }}"
                            class="inline-flex items-center rounded-lg bg-indigo-600 px-3.5 py-2 text-sm font-semibold text-white shadow-sm shadow-indigo-600/25 transition hover:bg-indigo-500"
                        >
                            Mulai Sekarang
                        </a>
                    @endauth
                </nav>
            </div>
        </header>

        <x-flash />

        <main>{{ $slot }}</main>

        <footer class="border-t border-slate-200/80 bg-slate-50">
            <div
                class="mx-auto flex max-w-6xl flex-col gap-4 px-4 py-10 sm:px-6 md:flex-row md:items-center md:justify-between"
            >
                <div class="flex items-center gap-2.5">
                    <x-logo class="size-8" />
                    <p class="text-sm text-slate-500">
                        &copy; {{ now()->year }} {{ config('app.name') }}.
                        <span class="hidden sm:inline">Dibangun dengan Laravel 12.</span>
                    </p>
                </div>
                <p class="text-xs text-slate-400">
                    Demo Blade Component, Layout, Route Model Binding &amp; Validasi.
                </p>
            </div>
        </footer>
    </body>
</html>
