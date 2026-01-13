<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Ukm;

class StatusController extends Controller
{
    /**
     * Check registration status by NIM
     */
    public function checkStatus($nim)
    {
        $mahasiswa = Mahasiswa::with('pendaftaran.ukm')->where('nim', $nim)->first();

        if (!$mahasiswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'NIM tidak ditemukan dalam sistem.',
            ], 404);
        }

        if ($mahasiswa->pendaftaran->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'nama' => $mahasiswa->nama,
                    'nim' => $mahasiswa->nim,
                    'status_pendaftaran' => 'Belum Mendaftar',
                ]
            ]);
        }

        // Get the latest registration
        $pendaftaran = $mahasiswa->pendaftaran->sortByDesc('created_at')->first();

        return response()->json([
            'status' => 'success',
            'data' => [
                'nama' => $mahasiswa->nama,
                'nim' => $mahasiswa->nim,
                'ukm' => $pendaftaran->ukm ? $pendaftaran->ukm->nama_ukm : null,
                'status_verifikasi' => $pendaftaran->status_verifikasi, // Pending, Diterima, Dikeluarkan
                'tanggal_daftar' => $pendaftaran->tanggal_daftar,
            ]
        ]);
    }

    /**
     * Get list of all UKMs
     */
    public function getUkmList()
    {
        $ukms = Ukm::all(['id_ukm', 'nama_ukm', 'deskripsi', 'gambar']);
        return response()->json([
            'status' => 'success',
            'data' => $ukms
        ]);
    }

    /**
     * Get list of Prestasi
     */
    public function getPrestasi()
    {
        // Ambil nama UKM dan prestasinya, filter yang punya prestasi saja
        $prestasis = Ukm::select('nama_ukm', 'prestasi')
            ->whereNotNull('prestasi')
            ->where('prestasi', '!=', '-')
            ->get();

        return response()->json([
            'status' => 'success',
            'count' => $prestasis->count(),
            'data' => $prestasis
        ]);
    }
}
