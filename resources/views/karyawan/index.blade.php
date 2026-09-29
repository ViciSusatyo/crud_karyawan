<x-layouts.app title="Data Karyawan">
    <div class="card overflow-hidden">
        <header
            class="flex flex-col gap-4 border-b border-slate-200/80 px-6 py-5 sm:flex-row sm:items-center sm:justify-between"
        >
            <div>
                <h2 class="text-lg font-bold text-slate-900">Data Karyawan</h2>
                <p class="mt-0.5 text-sm text-slate-500">
                    {{ $karyawans->total() }} karyawan terdaftar
                    @if ($q)
                        untuk kata kunci &ldquo;{{ $q }}&rdquo;
                    @endif
                    .
                </p>
            </div>

            <x-button :href="route('karyawan.create')" icon="plus" class="w-full sm:w-auto">
                Tambah Karyawan
            </x-button>
        </header>

        <form method="GET" action="{{ route('karyawan.index') }}" class="flex flex-col gap-3 border-b border-slate-200/80 bg-slate-50/60 px-6 py-4 sm:flex-row">
            <div class="relative flex-1">
                <span class="pointer-events-none absolute inset-y-0 left-0 grid w-10 place-items-center text-slate-400">
                    <x-icon name="search" class="size-4" />
                </span>
                <input
                    type="search"
                    name="q"
                    value="{{ $q }}"
                    placeholder="Cari nama, email, atau jabatan..."
                    class="block w-full rounded-xl border border-slate-200 bg-white py-2.5 pr-3.5 pl-10 text-sm shadow-xs transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 focus:outline-none"
                />
            </div>

            <div class="flex gap-2">
                <x-button type="submit" variant="dark" icon="search">Cari</x-button>

                @if ($q)
                    <x-button :href="route('karyawan.index')" variant="secondary">Reset</x-button>
                @endif
            </div>
        </form>

        @if ($karyawans->isEmpty())
            <x-empty
                :title="$q ? 'Karyawan tidak ditemukan' : 'Belum ada data karyawan'"
                :description="$q ? 'Coba kata kunci lain atau hapus filter pencarian.' : 'Mulai dengan menambahkan karyawan pertama Anda.'"
                icon="users"
                class="m-6"
            >
                <x-button :href="route('karyawan.create')" icon="plus" class="mt-2">
                    Tambah Karyawan
                </x-button>
            </x-empty>
        @else
            <div class="overflow-x-auto">
                <table class="w-full min-w-3xl text-left text-sm">
                    <thead class="bg-slate-50 text-xs tracking-wide text-slate-500 uppercase">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-semibold">ID</th>
                            <th scope="col" class="px-6 py-3 font-semibold">Karyawan</th>
                            <th scope="col" class="px-6 py-3 font-semibold">Jabatan</th>
                            <th scope="col" class="px-6 py-3 font-semibold">Ditambahkan</th>
                            <th scope="col" class="px-6 py-3 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @foreach ($karyawans as $karyawan)
                            <tr class="transition hover:bg-slate-50/70">
                                <td class="px-6 py-4 text-slate-400">{{ $karyawan->id }}</td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="grid size-9 shrink-0 place-items-center rounded-full bg-slate-100 text-xs font-bold text-slate-600"
                                        >
                                            {{ $karyawan->initials() }}
                                        </span>
                                        <div class="min-w-0">
                                            <p class="truncate font-semibold text-slate-900">{{ $karyawan->nama }}</p>
                                            <p class="truncate text-xs text-slate-500">{{ $karyawan->email }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <x-badge :jabatan="$karyawan->jabatan" />
                                </td>

                                <td class="px-6 py-4 text-xs text-slate-500">
                                    {{ $karyawan->created_at->translatedFormat('d M Y') }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a
                                            href="{{ route('karyawan.edit', $karyawan) }}"
                                            class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-1.5 text-xs font-semibold text-slate-600 transition hover:bg-amber-50 hover:text-amber-700"
                                        >
                                            <x-icon name="pencil" class="size-3.5" />
                                            Edit
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('karyawan.destroy', $karyawan) }}"
                                            onsubmit="return confirm('Yakin ingin menghapus {{ $karyawan->nama }}?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-1.5 text-xs font-semibold text-slate-600 transition hover:bg-rose-50 hover:text-rose-700"
                                            >
                                                <x-icon name="trash" class="size-3.5" />
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($karyawans->hasPages())
                <div class="border-t border-slate-200/80 px-6 py-4">
                    {{ $karyawans->links() }}
                </div>
            @endif
        @endif
    </div>
</x-layouts.app>
