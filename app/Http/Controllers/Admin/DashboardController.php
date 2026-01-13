<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Ukm;
use App\Models\Pendaftaran;
use App\Models\Admin;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa = Mahasiswa::count();
        $totalUkm = Ukm::count();
        $pendaftaranBaru = Pendaftaran::where('status_verifikasi', 'Pending')->count();
        $totalAdmin = Admin::count();
        $totalFasilitas = \App\Models\Fasilitas::count();

        // Data for Chart: Registrations per UKM
        // Data for Chart: Registrations per UKM (Top 5 Paling Diminati)
        $chartData = Ukm::withCount('pendaftaran')
            ->orderByDesc('pendaftaran_count')
            ->take(5)
            ->get()
            ->map(function ($ukm) {
                return [
                    'name' => $ukm->nama_ukm,
                    'count' => $ukm->pendaftaran_count
                ];
            });

        // Recent Activities (Last 5 Registrations)
        $recentActivities = Pendaftaran::with(['mahasiswa', 'ukm'])
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalMahasiswa',
            'totalUkm',
            'pendaftaranBaru',
            'totalAdmin',
            'totalFasilitas',
            'chartData',
            'recentActivities'
        ));
    }
}
