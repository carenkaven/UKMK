<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Http;

use Barryvdh\DomPDF\Facade\Pdf;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::with(['mahasiswa', 'ukm'])->orderByDesc('created_at')->get();
        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

    public function exportPdf()
    {
        $pendaftarans = Pendaftaran::with(['mahasiswa', 'ukm'])->orderByDesc('created_at')->get();
        $pdf = Pdf::loadView('admin.pendaftaran.pdf', compact('pendaftarans'));
        return $pdf->stream('laporan-pendaftaran.pdf');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:Pending,Diterima,Dikeluarkan',
        ]);

        $pendaftaran = Pendaftaran::with('mahasiswa', 'ukm')->findOrFail($id);

        $pendaftaran->update([
            'status_verifikasi' => $request->status_verifikasi
        ]);

        // 🟢 Kirim Notifikasi WA jika DITERIMA
        if ($request->status_verifikasi == 'Diterima') {
            try {
                $target = $pendaftaran->mahasiswa->telepon; // Pastikan format 08xx atau 62xx
                $nama = $pendaftaran->mahasiswa->nama;
                $ukm = $pendaftaran->ukm->nama_ukm;
                $jadwal = $pendaftaran->ukm->jadwal; // Ambil jadwal latihan

                $pesan = "Halo *{$nama}*,\n\n" .
                    "Selamat! Pendaftaran Anda untuk UKM *{$ukm}* telah *DITERIMA*.\n\n" .
                    "🕒 *Jadwal Latihan:*\n" .
                    "_{$jadwal}_\n\n" .
                    "📍 *Lokasi:*\n" .
                    "_Kampus ITN Malang_\n\n" .
                    "Harap hadir tepat waktu.\n" .
                    "Terima kasih.\n\n" .
                    "*Admin UKMK ITN Malang*";

                // Gunakan Fonnte (Gratis & Populer)
                $response = Http::withoutVerifying()->withHeaders([
                    'Authorization' => 'sir57H8KxGzGUufUXCoN', // Token Fonnte
                ])->post('https://api.fonnte.com/send', [
                            'target' => $target,
                            'message' => $pesan,
                        ]);
            } catch (\Exception $e) {
                // Jangan error kalau WA gagal, lanjut aja
            }
        }
        // 🔴 Kirim Notifikasi WA jika DIKELUARKAN
        elseif ($request->status_verifikasi == 'Dikeluarkan') {
            try {
                $target = $pendaftaran->mahasiswa->telepon;
                $nama = $pendaftaran->mahasiswa->nama;
                $ukm = $pendaftaran->ukm->nama_ukm;

                $pesan = "Halo *{$nama}*,\n\n" .
                    "Mohon maaf, status keanggotaan Anda di UKM *{$ukm}* kini telah *DIKELUARKAN*.\n\n" .
                    "⚠️ *Alasan:*\n" .
                    "_Tidak pernah aktif dalam kegiatan UKM._\n\n" .
                    "Tetap semangat dan sukses selalu.\n" .
                    "*Admin UKMK ITN Malang*";

                Http::withoutVerifying()->withHeaders([
                    'Authorization' => 'sir57H8KxGzGUufUXCoN',
                ])->post('https://api.fonnte.com/send', [
                            'target' => $target,
                            'message' => $pesan,
                        ]);
            } catch (\Exception $e) {
            }
        }

        return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui!');
    }
}
