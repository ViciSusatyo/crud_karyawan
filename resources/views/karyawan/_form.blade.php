@use('App\Models\Karyawan')

@php
    $daftarJabatan = Karyawan::query()->distinct()->orderBy('jabatan')->pluck('jabatan');
    $jabatan = old('jabatan', $karyawan->jabatan ?? null);
@endphp

<div class="space-y-5">
    <x-form.input
        name="nama"
        label="Nama Lengkap"
        icon="users"
        placeholder="Contoh: Budi Santoso"
        :value="$karyawan->nama ?? null"
        hint="Minimal 3 karakter, maksimal 100 karakter."
        required
    />

    <x-form.input
        name="email"
        label="Alamat Email"
        type="email"
        icon="mail"
        placeholder="nama@karyawan.test"
        :value="$karyawan->email ?? null"
        hint="Email harus unik di antara seluruh karyawan."
        required
    />

    <div class="space-y-1.5">
        <label for="jabatan" class="block text-sm font-medium text-slate-700">
            Jabatan
            @if ($errors->has('jabatan'))
                <span class="text-rose-500">*</span>
            @endif
        </label>

        <div class="relative">
            <span class="pointer-events-none absolute inset-y-0 left-0 grid w-10 place-items-center text-slate-400">
                <x-icon name="id-card" class="size-4" />
            </span>

            <input
                id="jabatan"
                name="jabatan"
                type="text"
                list="daftar-jabatan"
                value="{{ $jabatan }}"
                placeholder="Contoh: Frontend Developer"
                @required(! $errors->has('jabatan'))
                @class([
                    'block w-full rounded-xl border bg-white py-2.5 pr-3.5 pl-10 text-sm text-slate-900 shadow-xs transition focus:ring-2 focus:outline-none',
                    'border-rose-300 focus:border-rose-400 focus:ring-rose-100' => $errors->has('jabatan'),
                    'border-slate-200 focus:border-indigo-500 focus:ring-indigo-100' => ! $errors->has('jabatan'),
                ])
            />
        </div>

        <datalist id="daftar-jabatan">
            @foreach ($daftarJabatan as $item)
                <option value="{{ $item }}"></option>
            @endforeach
        </datalist>

        @if ($errors->has('jabatan'))
            <p class="flex items-center gap-1.5 text-xs font-medium text-rose-600">
                <x-icon name="exclamation" class="size-3.5" />
                {{ $errors->first('jabatan') }}
            </p>
        @else
            <p class="text-xs text-slate-400">Pilih dari daftar atau ketik jabatan baru secara bebas.</p>
        @endif
    </div>
</div>
