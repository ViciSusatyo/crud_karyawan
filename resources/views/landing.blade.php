<x-layouts.public title="Beranda">
    <section class="relative overflow-hidden">
        <div class="pointer-events-none absolute inset-x-0 -top-40 h-[32rem] bg-[radial-gradient(60%_60%_at_50%_0%,theme(colors.indigo.200),transparent)]"></div>

        <div class="relative mx-auto max-w-6xl px-4 pt-20 pb-24 sm:px-6 lg:pt-28">
            <div class="mx-auto max-w-3xl text-center">
                <span
                    class="inline-flex items-center gap-2 rounded-full bg-white px-3 py-1 text-xs font-semibold text-indigo-700 shadow-sm ring-1 ring-slate-200/80"
                >
                    <x-icon name="sparkles" class="size-3.5" />
                    Contoh Project Blade Templating
                </span>

                <h1 class="mt-6 text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                    Kelola data karyawan
                    <span class="bg-gradient-to-r from-indigo-600 to-fuchsia-600 bg-clip-text text-transparent">
                        tanpa ribet
                    </span>
                </h1>

                <p class="mx-auto mt-6 max-w-2xl text-base leading-relaxed text-slate-600 sm:text-lg">
                    Aplikasi demo Laravel 12 yang memperlihatkan cara menyusun halaman memakai
                    <strong class="font-semibold text-slate-800">Blade Component</strong>,
                    <strong class="font-semibold text-slate-800">Layout</strong>, dan
                    <strong class="font-semibold text-slate-800">Route Resource</strong> — mulai dari halaman
                    publik, login, sampai CRUD.
                </p>

                <div class="mt-10 flex flex-col items-center justify-center gap-3 sm:flex-row">
                    <x-button :href="route('login')" icon="arrow-right" class="w-full sm:w-auto">
                        Masuk ke Dashboard
                    </x-button>
                    <a
                        href="#fitur"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 ring-1 ring-slate-200 transition hover:bg-slate-50 sm:w-auto"
                    >
                        <x-icon name="arrow-left" class="size-4 rotate-90" />
                        Lihat Fitur
                    </a>
                </div>

                <p class="mt-6 text-xs text-slate-400">
                    Akun demo: <span class="font-semibold text-slate-600">admin@templating.test</span> ·
                    <span class="font-semibold text-slate-600">password</span>
                </p>
            </div>
        </div>
    </section>

    <section id="fitur" class="border-t border-slate-200/80 bg-slate-50/70 py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="max-w-2xl">
                <p class="text-sm font-semibold text-indigo-600">Fitur</p>
                <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                    Semua yang perlu untuk belajar templating
                </h2>
                <p class="mt-4 text-slate-600">
                    Setiap bagian dibuat terpisah agar mudah dipelajari dan dikembangkan.
                </p>
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ([
                    ['icon' => 'sparkles', 'title' => 'Blade Templating', 'text' => 'Layout, komponen, dan partial yang bisa dipakai ulang di banyak halaman tanpa mengulang kode.'],
                    ['icon' => 'lock', 'title' => 'Autentikasi', 'text' => 'Login berbasis session dengan middleware auth, remember me, dan proteksi route untuk halaman privat.'],
                    ['icon' => 'users', 'title' => 'CRUD Karyawan', 'text' => 'Route resource, route model binding, validasi server, pencarian, dan pagination otomatis.'],
                    ['icon' => 'chart', 'title' => 'Dashboard Ringkas', 'text' => 'Statistik jumlah karyawan, rekap jabatan, dan data terbaru yang dirangkum dari database.'],
                    ['icon' => 'exclamation', 'title' => 'Validasi & Flash', 'text' => 'Pesan error dikembalikan ke form вместе input lama, plus notifikasi sukses yang otomatis hilang.'],
                    ['icon' => 'check-circle', 'title' => 'Responsif', 'text' => 'Tampilan rapi di desktop maupun mobile, ditulis dengan Tailwind CSS 4 dan Alpine.js.'],
                ] as $fitur)
                    <div class="card p-6 transition hover:-translate-y-0.5 hover:shadow-md">
                        <span class="grid size-11 place-items-center rounded-xl bg-indigo-50 text-indigo-600">
                            <x-icon :name="$fitur['icon']" class="size-5" />
                        </span>
                        <h3 class="mt-4 text-base font-semibold text-slate-900">{{ $fitur['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $fitur['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="teknologi" class="py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <div>
                    <p class="text-sm font-semibold text-indigo-600">Teknologi</p>
                    <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                        Stack yang simpel dan modern
                    </h2>
                    <p class="mt-4 text-slate-600">
                        Tidak ada yang aneh-aneh. Semua paket resmi dan dokumentasinya mudah diikuti.
                    </p>

                    <dl class="mt-8 space-y-4">
                        @foreach ([
                            ['Laravel 12', 'Framework PHP dengan routing, Eloquent, dan Blade.'],
                            ['Tailwind CSS 4', 'Styling utility-first, hasil build lewat Vite.'],
                            ['Alpine.js', 'Interaksi ringan untuk sidebar mobile dan notifikasi.'],
                            ['MySQL', 'Database lokal dari XAMPP untuk menyimpan data karyawan.'],
                        ] as [$nilai, $keterangan])
                            <div class="flex gap-4">
                                <dt class="mt-0.5 grid size-6 shrink-0 place-items-center rounded-full bg-emerald-50 text-emerald-600">
                                    <x-icon name="check-circle" class="size-4" />
                                </dt>
                                <dd>
                                    <p class="text-sm font-semibold text-slate-900">{{ $nilai }}</p>
                                    <p class="text-sm text-slate-600">{{ $keterangan }}</p>
                                </dd>
                            </div>
                        @endforeach
                    </dl>
                </div>

                <div class="card overflow-hidden">
                    <div class="flex items-center gap-2 border-b border-slate-200/80 bg-slate-900 px-4 py-3">
                        <span class="size-3 rounded-full bg-rose-400"></span>
                        <span class="size-3 rounded-full bg-amber-400"></span>
                        <span class="size-3 rounded-full bg-emerald-400"></span>
                        <span class="ml-2 text-xs font-medium text-slate-400">routes/web.php</span>
                    </div>

                    <pre class="overflow-x-auto px-5 py-5 text-[13px] leading-relaxed text-slate-300"><code>Route::view('/', 'landing')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'create'])
        ->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('karyawan', KaryawanController::class);
});</code></pre>
                </div>
            </div>
        </div>
    </section>

    <section class="px-4 pb-24 sm:px-6">
        <div
            class="mx-auto max-w-6xl overflow-hidden rounded-3xl bg-slate-900 px-6 py-14 text-center sm:px-12"
        >
            <h2 class="text-3xl font-bold tracking-tight text-white">Siap mencoba?</h2>
            <p class="mx-auto mt-3 max-w-xl text-slate-400">
                Masuk dengan akun demo, lalu coba tambah, ubah, cari, dan hapus data karyawan.
            </p>

            <x-button :href="route('login')" class="mt-8 bg-white text-slate-900 hover:bg-slate-100 focus-visible:ring-white">
                Login Sekarang
            </x-button>
        </div>
    </section>
</x-layouts.public>
