@props(['title' => null])
@use('Illuminate\Support\Str')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ $title ? $title.' · '.config('app.name') : config('app.name') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body x-data="{ sidebar: false }" class="min-h-screen bg-slate-100">
        <div
            x-show="sidebar"
            x-transition.opacity
            @click="sidebar = false"
            class="fixed inset-0 z-30 bg-slate-900/60 backdrop-blur-sm lg:hidden"
            style="display: none"
        ></div>

        <aside
            class="fixed inset-y-0 left-0 z-40 flex w-72 flex-col bg-slate-900 transition-transform duration-300 lg:translate-x-0"
            :class="sidebar ? 'translate-x-0' : '-translate-x-full'"
        >
            <div class="flex items-center gap-3 px-6 py-6">
                <x-logo />
                <div>
                    <p class="text-base font-bold leading-tight text-white">{{ config('app.name') }}</p>
                    <p class="text-xs text-slate-400">Sistem Informasi Karyawan</p>
                </div>
                <button
                    type="button"
                    @click="sidebar = false"
                    class="ml-auto rounded-lg p-1.5 text-slate-400 hover:bg-white/10 hover:text-white lg:hidden"
                >
                    <x-icon name="x-mark" />
                </button>
            </div>

            <nav class="flex-1 space-y-1 overflow-y-auto px-4 pb-6">
                <p class="px-3 pb-2 pt-4 text-[11px] font-semibold uppercase tracking-wider text-slate-500">
                    Menu
                </p>

                <x-nav-link :href="route('dashboard')" icon="home" :active="request()->routeIs('dashboard')">
                    Dashboard
                </x-nav-link>
                <x-nav-link :href="route('karyawan.index')" icon="users"
                    :active="request()->routeIs('karyawan.index') || request()->routeIs('karyawan.show')">
                    Data Karyawan
                </x-nav-link>
                <x-nav-link :href="route('karyawan.create')" icon="user-plus"
                    :active="request()->routeIs('karyawan.create')">
                    Tambah Karyawan
                </x-nav-link>

                <p class="px-3 pb-2 pt-8 text-[11px] font-semibold uppercase tracking-wider text-slate-500">
                    Lainnya
                </p>
                <x-nav-link :href="route('home')" icon="sparkles">Landing Page</x-nav-link>

                <form method="POST" action="{{ route('logout') }}" class="pt-2">
                    @csrf
                    <button
                        type="submit"
                        class="group flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-rose-500/10 hover:text-rose-400"
                    >
                        <x-icon name="logout" class="size-5" />
                        <span>Keluar</span>
                    </button>
                </form>
            </nav>

            <div class="border-t border-white/10 p-4">
                <div class="flex items-center gap-3 rounded-xl bg-white/5 px-3 py-3">
                    <span
                        class="grid size-9 shrink-0 place-items-center rounded-full bg-indigo-500/20 text-sm font-bold text-indigo-300"
                    >
                        {{ Str::of(auth()->user()->name)->substr(0, 1)->upper() }}
                    </span>
                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold text-white">{{ auth()->user()->name }}</p>
                        <p class="truncate text-xs text-slate-400">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <div class="lg:pl-72">
            <header class="sticky top-0 z-20 border-b border-slate-200/80 bg-white/80 backdrop-blur">
                <div class="flex h-16 items-center gap-4 px-4 sm:px-6 lg:px-8">
                    <button
                        type="button"
                        @click="sidebar = true"
                        class="rounded-xl p-2 text-slate-500 transition hover:bg-slate-100 hover:text-slate-700 lg:hidden"
                    >
                        <x-icon name="menu" />
                    </button>

                    <h1 class="text-base font-semibold text-slate-800 sm:text-lg">
                        {{ $title ?? 'Dashboard' }}
                    </h1>

                    <div class="ml-auto flex items-center gap-2">
                        <a
                            href="{{ route('home') }}"
                            class="hidden items-center gap-1.5 rounded-xl px-3 py-2 text-sm font-medium text-slate-500 transition hover:bg-slate-100 hover:text-slate-700 sm:inline-flex"
                        >
                            <x-icon name="arrow-left" class="size-4" />
                            Beranda
                        </a>

                        <span
                            class="hidden size-9 place-items-center rounded-full bg-slate-900 text-sm font-bold text-white sm:grid"
                        >
                            {{ Str::of(auth()->user()->name)->substr(0, 1)->upper() }}
                        </span>
                    </div>
                </div>
            </header>

            <main class="px-4 py-6 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-7xl">
                    <x-flash />
                    {{ $slot }}
                </div>
            </main>

            <footer class="px-4 pb-8 text-center text-xs text-slate-400 sm:px-6 lg:px-8">
                &copy; {{ now()->year }} {{ config('app.name') }} — dibangun dengan Laravel 12 &amp; Tailwind CSS.
            </footer>
        </div>
    </body>
</html>
