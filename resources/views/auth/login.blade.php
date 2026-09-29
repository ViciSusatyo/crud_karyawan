<x-layouts.guest title="Masuk" subtitle="Gunakan akun admin untuk mengakses dashboard.">
    <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
        @csrf

        <x-form.input
            name="email"
            label="Email"
            type="email"
            icon="mail"
            placeholder="admin@templating.test"
            autocomplete="username"
            value="admin@templating.test"
            required
        />

        <x-form.input
            name="password"
            label="Password"
            type="password"
            icon="lock"
            placeholder="••••••••"
            autocomplete="current-password"
            required
        />

        <label class="flex cursor-pointer items-center gap-2.5 text-sm text-slate-600">
            <input
                type="checkbox"
                name="remember"
                value="1"
                @checked(old('remember'))
                class="size-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
            />
            Ingat saya di perangkat ini
        </label>

        <x-button type="submit" class="w-full">Masuk</x-button>
    </form>

    <div class="mt-6 rounded-xl bg-slate-50 px-4 py-3 text-xs text-slate-500 ring-1 ring-slate-200/80">
        <p class="font-semibold text-slate-600">Akun demo</p>
        <p class="mt-1">admin@templating.test · password</p>
    </div>

    <p class="mt-6 text-center text-sm text-slate-500">
        <a href="{{ route('home') }}" class="font-medium text-indigo-600 transition hover:text-indigo-500">
            &larr; Kembali ke beranda
        </a>
    </p>
</x-layouts.guest>
