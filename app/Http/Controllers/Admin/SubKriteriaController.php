<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubKriteria;
use App\Models\Kriteria;

class SubKriteriaController extends Controller
{
    public function index()
    {
        $subkriterias = SubKriteria::with('kriteria')->get();
        return view('admin.subkriteria.index', compact('subkriterias'));
    }

    public function create()
    {
        $kriterias = Kriteria::all();
        return view('admin.subkriteria.create', compact('kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kriteria' => 'required',
            'nama_sub' => 'required',
            'nilai' => 'required|numeric',
        ]);

        SubKriteria::create($request->all());

        return redirect()->route('admin.subkriteria.index')->with('success', 'Sub Kriteria berhasil ditambahkan');
    }

    public function edit($id)
    {
        $subkriteria = SubKriteria::findOrFail($id);
        $kriterias = Kriteria::all();
        return view('admin.subkriteria.edit', compact('subkriteria', 'kriterias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kriteria' => 'required',
            'nama_sub' => 'required',
            'nilai' => 'required|numeric',
        ]);

        $subkriteria = SubKriteria::findOrFail($id);
        $subkriteria->update($request->all());

        return redirect()->route('admin.subkriteria.index')->with('success', 'Sub Kriteria berhasil diperbarui');
    }

    public function destroy($id)
    {
        SubKriteria::findOrFail($id)->delete();
        return redirect()->route('admin.subkriteria.index')->with('success', 'Sub Kriteria berhasil dihapus');
    }
}
