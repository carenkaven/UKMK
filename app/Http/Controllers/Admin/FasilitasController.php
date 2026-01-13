<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fasilitas;
use App\Models\Ukm;

use Barryvdh\DomPDF\Facade\Pdf;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::all();
        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function exportPdf()
    {
        $fasilitas = Fasilitas::all();
        $pdf = Pdf::loadView('admin.fasilitas.pdf', compact('fasilitas'));
        return $pdf->stream('laporan-fasilitas.pdf');
    }

    public function create()
    {
        return view('admin.fasilitas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required',
            'deskripsi' => 'nullable',
        ]);

        Fasilitas::create($request->all());

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        return view('admin.fasilitas.edit', compact('fasilitas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_fasilitas' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->update($request->all());

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui');
    }

    public function destroy($id)
    {
        Fasilitas::findOrFail($id)->delete();
        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil dihapus');
    }
}
