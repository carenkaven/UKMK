@extends('layouts.admin')

@section('content')
    <div class="card">
        <!-- Print Header -->
        <div class="print-header">
            <h2>INSTITUT TEKNOLOGI NASIONAL MALANG</h2>
            <p>Jalan Bendungan Sigura-gura No. 2 Malang, Jawa Timur</p>
            <hr>
            <h3>LAPORAN DATA FASILITAS UKM</h3>
        </div>

        <div class="header-flex no-print">
            <h3>Manajemen Fasilitas</h3>
            <div>
                <div class="dropdown">
                    <button class="btn btn-secondary">🖨️ Cetak / Export ▼</button>
                    <div class="dropdown-content">
                        <button onclick="window.print()">🖨️ Cetak (Browser)</button>
                        <a href="{{ route('admin.fasilitas.exportPdf') }}" target="_blank">📄 Export PDF</a>
                    </div>
                </div>
                Laporan</button>
                <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-primary">+ Tambah Fasilitas</a>
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
                        <th>Nama Fasilitas</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fasilitas as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->nama_fasilitas }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>
                                <a href="{{ route('admin.fasilitas.edit', $item->id_fasilitas) }}"
                                    class="btn btn-sm text-warning" style="margin-right:5px;">Edit</a>
                                <form action="{{ route('admin.fasilitas.destroy', $item->id_fasilitas) }}" method="POST"
                                    style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus fasilitas ini?');">
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