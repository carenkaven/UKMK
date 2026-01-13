<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

use Barryvdh\DomPDF\Facade\Pdf;

class MahasiswaController extends Controller
{
    public function index()
    {
        // Only show students who have been accepted (status_verifikasi = 'Diterima')
        $mahasiswas = Mahasiswa::with('pendaftaran.ukm')->whereHas('pendaftaran', function ($q) {
            $q->where('status_verifikasi', 'Diterima');
        })->orderByDesc('created_at')->get();

        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return redirect()->route('admin.mahasiswa.index')->with('error', 'Mahasiswa tidak ditemukan.');
        }
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'email' => 'required|email',
            'prodi' => 'required',
            'angkatan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return redirect()->route('admin.mahasiswa.index')->with('error', 'Mahasiswa tidak ditemukan.');
        }

        $mahasiswa->nama = $request->nama;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->email = $request->email;
        $mahasiswa->prodi = $request->prodi;
        $mahasiswa->angkatan = $request->angkatan;

        if ($request->hasFile('foto')) {
            // Delete old photo
            if ($mahasiswa->foto && file_exists(storage_path('app/public/' . $mahasiswa->foto))) {
                unlink(storage_path('app/public/' . $mahasiswa->foto));
            }
            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->storeAs('public', $imageName);
            $mahasiswa->foto = $imageName;
        }

        $mahasiswa->save();

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return redirect()->route('admin.mahasiswa.index')->with('error', 'Mahasiswa tidak ditemukan.');
        }

        // Delete related data first (Manual Cascade)
        // 1. Pendaftaran
        // Note: Relation name is 'pendaftaran' (hasMany)
        foreach ($mahasiswa->pendaftaran as $p) {
            $p->delete();
        }

        // 2. Penilaian (if any)
        // Relation name 'penilaians' (hasMany)
        foreach ($mahasiswa->penilaians as $pen) {
            $pen->delete();
        }

        // 3. Foto
        if ($mahasiswa->foto && file_exists(storage_path('app/public/' . $mahasiswa->foto))) {
            unlink(storage_path('app/public/' . $mahasiswa->foto));
        }

        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa dan semua data terkait berhasil dihapus.');
    }

    public function exportPdf()
    {
        // Export logic must match index logic
        $mahasiswas = Mahasiswa::with('pendaftaran.ukm')->whereHas('pendaftaran', function ($q) {
            $q->where('status_verifikasi', 'Diterima');
        })->orderByDesc('created_at')->get();

        $pdf = Pdf::loadView('admin.mahasiswa.pdf', compact('mahasiswas'));
        return $pdf->stream('laporan-mahasiswa.pdf');
    }
}
