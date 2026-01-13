<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PenilaianController extends Controller
{
    public function index()
    {
        $penilaians = \App\Models\Penilaian::with(['mahasiswa.pendaftaran.ukm', 'kriteria', 'subKriteria'])->get()->groupBy('id_mahasiswa');
        return view('admin.penilaian.index', compact('penilaians'));
    }

    public function create()
    {
        // Only show accepted students in the dropdown
        $mahasiswas = \App\Models\Mahasiswa::whereHas('pendaftaran', function ($q) {
            $q->where('status_verifikasi', 'Diterima');
        })->get();

        $kriterias = \App\Models\Kriteria::with('subkriteria')->get();
        return view('admin.penilaian.create', compact('mahasiswas', 'kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_mahasiswa' => 'required',
            'nilai' => 'required|array',
        ]);

        foreach ($request->nilai as $id_kriteria => $id_sub_kriteria) {
            $sub = \App\Models\SubKriteria::find($id_sub_kriteria);
            \App\Models\Penilaian::updateOrCreate(
                [
                    'id_mahasiswa' => $request->id_mahasiswa,
                    'id_kriteria' => $id_kriteria,
                ],
                [
                    'id_sub_kriteria' => $id_sub_kriteria,
                    'nilai' => $sub->nilai
                ]
            );
        }

        return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil disimpan!');
    }

    public function ranking()
    {
        $penilaians = \App\Models\Penilaian::with(['mahasiswa.pendaftaran.ukm', 'kriteria', 'subKriteria'])->get()->groupBy('id_mahasiswa');
        $rankings = [];

        foreach ($penilaians as $id_mahasiswa => $items) {
            $totalSkor = 0;
            $mahasiswa = $items->first()->mahasiswa;

            foreach ($items as $item) {
                // Formula SAW: Value * Weight / 100 (assuming weight is percentage)
                $bobot = $item->kriteria->bobot;
                $nilai_sub = $item->nilai;

                $skor = $nilai_sub * ($bobot / 100);
                $totalSkor += $skor;
            }

            $rankings[] = [
                'mahasiswa' => $mahasiswa,
                'total_skor' => $totalSkor
            ];
        }

        // Sort Descending by Total Skor
        usort($rankings, function ($a, $b) {
            return $b['total_skor'] <=> $a['total_skor'];
        });

        return view('admin.penilaian.ranking', compact('rankings'));
    }

    public function exportPdf()
    {
        $penilaians = \App\Models\Penilaian::with(['mahasiswa.pendaftaran.ukm', 'kriteria', 'subKriteria'])->get()->groupBy('id_mahasiswa');
        $rankings = [];

        foreach ($penilaians as $id_mahasiswa => $items) {
            $totalSkor = 0;
            $mahasiswa = $items->first()->mahasiswa;

            foreach ($items as $item) {
                // Formula SAW: Value * Weight / 100
                $bobot = $item->kriteria->bobot;
                $nilai_sub = $item->nilai;

                $skor = $nilai_sub * ($bobot / 100);
                $totalSkor += $skor;
            }

            $rankings[] = [
                'mahasiswa' => $mahasiswa,
                'total_skor' => $totalSkor
            ];
        }

        // Sort Descending by Total Skor
        usort($rankings, function ($a, $b) {
            return $b['total_skor'] <=> $a['total_skor'];
        });

        $pdf = Pdf::loadView('admin.penilaian.pdf', compact('rankings'));
        return $pdf->stream('laporan-ranking.pdf');
    }

    public function destroy($id_mahasiswa)
    {
        // Delete all assessments for this student
        \App\Models\Penilaian::where('id_mahasiswa', $id_mahasiswa)->delete();
        return redirect()->route('admin.penilaian.index')->with('success', 'Data penilaian berhasil dihapus!');
    }
}