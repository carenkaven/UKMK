<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Pendaftaran;
use App\Models\Ukm;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    public function showForm()
    {
        $ukms = Ukm::all();
        return view('form', compact('ukms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:mahasiswas,email',
            'nama' => 'required',
            'telepon' => 'required',
            'gender' => 'required',
            'agama' => 'required',
            'nim' => 'required|unique:mahasiswas,nim',
            'prodi' => 'required',
            'fakultas' => 'required',
            'angkatan' => 'required',
            'photo' => 'required|image|max:2048',
            'id_ukm' => 'required|exists:ukms,id_ukm', // Validate UKM selection
        ]);

        // Upload Foto
        $fotoPath = null;
        if ($request->hasFile('photo')) {
            $fotoPath = $request->file('photo')->store('fotos', 'public');
        }

        // Create Mahasiswa
        $mahasiswa = Mahasiswa::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nim' => $request->nim,
            'telepon' => $request->telepon,
            'gender' => $request->gender,
            'agama' => $request->agama,
            'prodi' => $request->prodi,
            'fakultas' => $request->fakultas,
            'angkatan' => $request->angkatan,
            'foto' => $fotoPath,
            'password' => Hash::make('12345678'), // Default password
        ]);

        // Create Pendaftaran
        Pendaftaran::create([
            'tanggal_daftar' => now(),
            'status_verifikasi' => 'Pending',
            'id_mahasiswa' => $mahasiswa->id_mahasiswa,
            'id_ukm' => $request->id_ukm,
        ]);

        return redirect()->route('home')->with('success', 'Pendaftaran berhasil! Silakan tunggu verifikasi.');
    }
}
