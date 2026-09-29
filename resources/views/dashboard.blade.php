@use('Illuminate\Support\Str')

<x-layouts.app title="Dashboard">
    <div class="space-y-6">
        <div class="card flex flex-col gap-4 overflow-hidden p-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-bold text-slate-900">
                    Halo, {{ Str::before($pengguna->name, ' ') }}! 👋
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Ringkasan data karyawan per {{ now()->translatedFormat('F Y') }}.
                </p>
            </div>

            <x-button :href="route('karyawan.create')" icon="plus" class="w-full sm:w-auto">
                Tambah Karyawan
            </x-button>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
            <x-stat label="Total Karyawan" :value="$totalKaryawan" icon="users" tone="indigo" hint="Seluruh data tersimpan" />
            <x-stat label="Ditambah Bulan Ini" :value="$bulanIni" icon="clock" tone="emerald" hint="Sejak awal bulan berjalan" />
            <x-stat label="Jenis Jabatan" :value="$jumlahJabatan" icon="chart" tone="amber" hint="Posisi yang tersedia" />
        </div>

        <div class="grid gap-6 lg:grid-cols-5">
            <section class="card lg:col-span-3">
                <header class="flex items-center justify-between gap-4 border-b border-slate-200/80 px-6 py-4">
                    <h3 class="text-sm font-semibold text-slate-900">Karyawan Terbaru</h3>
                    <a href="{{ route('karyawan.index') }}" class="text-sm font-medium text-indigo-600 transition hover:text-indigo-500">
                        Lihat semua
                    </a>
                </header>

                @if ($terbaru->isEmpty())
                    <x-empty
                        title="Belum ada karyawan"
                        description="Tambahkan karyawan pertama untuk mulai mengelola data."
                        icon="users"
                        class="m-6"
                    >
                        <x-button :href="route('karyawan.create')" icon="plus" class="mt-2">
                            Tambah Karyawan
                        </x-button>
                    </x-empty>
                @else
                    <ul class="divide-y divide-slate-100">
                        @foreach ($terbaru as $karyawan)
                            <li class="flex items-center gap-4 px-6 py-4">
                                <span
                                    class="grid size-10 shrink-0 place-items-center rounded-full bg-slate-100 text-xs font-bold text-slate-600"
                                >
                                    {{ $karyawan->initials() }}
                                </span>

                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-sm font-semibold text-slate-900">{{ $karyawan->nama }}</p>
                                    <p class="truncate text-xs text-slate-500">{{ $karyawan->email }}</p>
                                </div>

                                <x-badge :jabatan="$karyawan->jabatan" class="hidden sm:inline-flex" />
                            </li>
                        @endforeach
                    </ul>
                @endif
            </section>

            <section class="card lg:col-span-2">
                <header class="border-b border-slate-200/80 px-6 py-4">
                    <h3 class="text-sm font-semibold text-slate-900">Rekap Jabatan</h3>
                </header>

                @if ($perJabatan->isEmpty())
                    <p class="px-6 py-10 text-center text-sm text-slate-400">Belum ada data.</p>
                @else
                    @php $maks = $perJabatan->max('total'); @endphp

                    <ul class="space-y-4 px-6 py-5">
                        @foreach ($perJabatan as $baris)
                            <li>
                                <div class="flex items-baseline justify-between gap-3 text-sm">
                                    <span class="truncate font-medium text-slate-700">{{ $baris->jabatan }}</span>
                                    <span class="text-xs font-semibold text-slate-500">{{ $baris->total }}</span>
                                </div>
                                <div class="mt-2 h-2 overflow-hidden rounded-full bg-slate-100">
                                    <div
                                        class="h-full rounded-full bg-gradient-to-r from-indigo-500 to-fuchsia-500"
                                        style="width: {{ round($baris->total / $maks * 100) }}%"
                                    ></div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </section>
        </div>
    </div>
</x-layouts.app>
