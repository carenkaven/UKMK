@extends('layouts.admin')

@section('content')
    <div class="card">
        <!-- Print Header -->
        <div class="print-header">
            <h2>INSTITUT TEKNOLOGI NASIONAL MALANG</h2>
            <p>Jalan Bendungan Sigura-gura No. 2 Malang, Jawa Timur</p>
            <hr>
            <h3>LAPORAN DATA UNIT KEGIATAN MAHASISWA (UKM)</h3>
        </div>

        <div class="header-flex no-print">
            <h3>Manajemen UKM</h3>
            <div>
                <div class="dropdown">
                    <button class="btn btn-secondary">🖨️ Cetak / Export ▼</button>
                    <div class="dropdown-content">
                        <button onclick="window.print()">🖨️ Cetak (Browser)</button>
                        <a href="{{ route('admin.ukm.exportPdf') }}" target="_blank">📄 Export PDF</a>
                    </div>
                </div>
                Laporan</button>
                <a href="{{ route('admin.ukm.create') }}" class="btn btn-primary">+ Tambah UKM</a>
            </div>
        </div>

        @if(session('success'))
            <div
                style="background:#d4edda; color:#155724; padding:15px; border-radius:8px; margin-bottom:20px; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama UKM</th>
                        <th>Jadwal</th>
                        <th>Kontak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ukms as $key => $ukm)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                @if($ukm->gambar)
                                    <img src="{{ asset($ukm->gambar) }}" alt="Img"
                                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $ukm->nama_ukm }}</strong><br>
                                <small class="text-muted">Ketua: {{ $ukm->ketua_ukm }}</small>
                            </td>
                            <td>{{ $ukm->jadwal ?? '-' }}</td>
                            <td>{{ $ukm->kontak ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.ukm.edit', $ukm->id_ukm) }}" class="btn btn-sm text-warning"
                                    style="margin-right:5px;">Edit</a>
                                <form action="{{ route('admin.ukm.destroy', $ukm->id_ukm) }}" method="POST"
                                    style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus UKM ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm text-danger" style="background:none;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection