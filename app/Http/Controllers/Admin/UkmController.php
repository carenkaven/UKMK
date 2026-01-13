<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ukm;

use Barryvdh\DomPDF\Facade\Pdf;

class UkmController extends Controller
{
    public function index()
    {
        $ukms = Ukm::all();
        return view('admin.ukm.index', compact('ukms'));
    }

    public function exportPdf()
    {
        $ukms = Ukm::all();
        $pdf = Pdf::loadView('admin.ukm.pdf', compact('ukms'));
        return $pdf->stream('laporan-ukm.pdf');
    }

    public function create()
    {
        return view('admin.ukm.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ukm' => 'required',
            'deskripsi' => 'required',
            'ketua_ukm' => 'required',
            'jadwal' => 'nullable',
            'prestasi' => 'nullable',
            'kontak' => 'nullable',
            'gambar' => 'nullable|image|max:2048', // Validation for image
        ]);

        $data = $request->all();

        // Handle Image Upload
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('assets/images', 'public_custom');
            // Note: If using public_custom isn't defined, revert to just 'images' and move manually or use 'public' disk.
            // Simplified approach for standard Laravel storage link:
            // $path = $request->file('gambar')->store('ukm_images', 'public');
            // $data['gambar'] = 'storage/' . $path;

            // However, existing seed uses 'assets/images/'. To keep it simple and consistent with seed:
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images'), $filename);
            $data['gambar'] = 'assets/images/' . $filename;
        }

        Ukm::create($data);

        return redirect()->route('admin.ukm.index')->with('success', 'UKM berhasil ditambahkan');
    }

    public function edit($id)
    {
        $ukm = Ukm::findOrFail($id);
        return view('admin.ukm.edit', compact('ukm'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ukm' => 'required',
            'deskripsi' => 'required',
            'ketua_ukm' => 'required',
            'jadwal' => 'nullable',
            'prestasi' => 'nullable',
            'kontak' => 'nullable',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $ukm = Ukm::findOrFail($id);
        $data = $request->all();

        // Handle Image Upload
        if ($request->hasFile('gambar')) {
            // Delete old image if needed (optional)

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images'), $filename);
            $data['gambar'] = 'assets/images/' . $filename;
        }

        $ukm->update($data);

        return redirect()->route('admin.ukm.index')->with('success', 'UKM berhasil diperbarui');
    }

    public function destroy($id)
    {
        Ukm::findOrFail($id)->delete();
        return redirect()->route('admin.ukm.index')->with('success', 'UKM berhasil dihapus');
    }
}
