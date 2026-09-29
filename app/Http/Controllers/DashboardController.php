<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalKaryawan = Karyawan::count();
        $bulanIni = Karyawan::whereBetween('created_at', [
            now()->startOfMonth(),
            now()->endOfMonth(),
        ])->count();

        $perJabatan = Karyawan::selectRaw('jabatan, count(*) as total')
            ->groupBy('jabatan')
            ->orderByDesc('total')
            ->get();

        $terbaru = Karyawan::latest()->take(5)->get();

        return view('dashboard', [
            'totalKaryawan' => $totalKaryawan,
            'bulanIni' => $bulanIni,
            'jumlahJabatan' => $perJabatan->count(),
            'perJabatan' => $perJabatan,
            'terbaru' => $terbaru,
            'pengguna' => Auth::user(),
        ]);
    }
}
