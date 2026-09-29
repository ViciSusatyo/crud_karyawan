<x-layouts.app title="Edit Karyawan">
    <div class="mx-auto max-w-2xl">
        <a
            href="{{ route('karyawan.index') }}"
            class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-500 transition hover:text-slate-800"
        >
            <x-icon name="arrow-left" class="size-4" />
            Kembali ke daftar
        </a>

        <div class="card mt-4 overflow-hidden">
            <header class="flex flex-col gap-3 border-b border-slate-200/80 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Edit Karyawan</h2>
                    <p class="mt-0.5 text-sm text-slate-500">
                        Perbarui data <span class="font-medium text-slate-700">{{ $karyawan->nama }}</span>.
                    </p>
                </div>

                <x-badge :jabatan="$karyawan->jabatan" />
            </header>

            <form method="POST" action="{{ route('karyawan.update', $karyawan) }}" class="space-y-6 px-6 py-6">
                @csrf
                @method('PUT')

                @include('karyawan._form')

                <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                    <x-button :href="route('karyawan.index')" variant="secondary">Batal</x-button>
                    <x-button type="submit" icon="check-circle">Update Data</x-button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
