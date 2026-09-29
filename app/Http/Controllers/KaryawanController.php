<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class KaryawanController extends Controller
{
    public function index(Request $request): View
    {
        $karyawans = Karyawan::search($request->string('q')->toString())
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('karyawan.index', [
            'karyawans' => $karyawans,
            'q' => $request->string('q')->toString(),
        ]);
    }

    public function create(): View
    {
        return view('karyawan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'max:255', Rule::unique('karyawans', 'email')],
            'jabatan' => ['required', 'string', 'max:100'],
        ]);

        Karyawan::create($data);

        return redirect()
            ->route('karyawan.index')
            ->with('success', "Karyawan {$data['nama']} berhasil ditambahkan.");
    }

    public function edit(Karyawan $karyawan): View
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, Karyawan $karyawan): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'min:3', 'max:100'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('karyawans', 'email')->ignore($karyawan),
            ],
            'jabatan' => ['required', 'string', 'max:100'],
        ]);

        $karyawan->update($data);

        return redirect()
            ->route('karyawan.index')
            ->with('success', "Karyawan {$data['nama']} berhasil diperbarui.");
    }

    public function destroy(Karyawan $karyawan): RedirectResponse
    {
        $nama = $karyawan->nama;
        $karyawan->delete();

        return redirect()
            ->route('karyawan.index')
            ->with('success', "Karyawan {$nama} berhasil dihapus.");
    }
}
