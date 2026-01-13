<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kriteria;

use Barryvdh\DomPDF\Facade\Pdf;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::with('subkriteria')->get();
        return view('admin.kriteria.index', compact('kriterias'));
    }

    public function exportPdf()
    {
        $kriterias = Kriteria::with('subkriteria')->get();
        $pdf = Pdf::loadView('admin.kriteria.pdf', compact('kriterias'));
        return $pdf->stream('laporan-kriteria.pdf');
    }

    public function create()
    {
        return view('admin.kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'bobot' => 'required|numeric',
        ]);

        Kriteria::create($request->all());

        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('admin.kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'bobot' => 'required|numeric',
        ]);

        $kriteria = Kriteria::findOrFail($id);
        $kriteria->update($request->all());

        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil diperbarui');
    }

    public function destroy($id)
    {
        Kriteria::findOrFail($id)->delete();
        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil dihapus');
    }
}
