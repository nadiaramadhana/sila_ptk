<?php

namespace App\Http\Controllers;

use App\Models\DataPTK;
use App\Models\Pengajuan;
use App\Models\Sekolah;
use App\Models\KategoriPTK;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPtk      = DataPTK::count();
        $totalSekolah  = Sekolah::count();
        $totalPengajuan = Pengajuan::count();
        $pengajuanMenunggu = Pengajuan::where('status', 'diajukan')->count();

        $ptkPerKategori = KategoriPTK::withCount('data_ptk')->get();

        $pengajuanPerBulan = Pengajuan::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $bulanLabels = collect(range(1, 12))->map(fn($b) => now()->setMonth($b)->translatedFormat('M'));
        $bulanData   = collect(range(1, 12))->map(fn($b) => $pengajuanPerBulan[$b] ?? 0);

        $pengajuanTerbaru = Pengajuan::with(['kategori', 'user'])->latest()->take(5)->get();

        return view('dashboard.index', compact(
            'totalPtk',
            'totalSekolah',
            'totalPengajuan',
            'pengajuanMenunggu',
            'ptkPerKategori',
            'bulanLabels',
            'bulanData',
            'pengajuanTerbaru',
        ));
    }
}
