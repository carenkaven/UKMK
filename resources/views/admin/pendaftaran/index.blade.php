@extends('layouts.admin')

@section('content')
    <div class="card">
        <!-- Print Header -->
        <div class="print-header">
            <h2>INSTITUT TEKNOLOGI NASIONAL MALANG</h2>
            <p>Jalan Bendungan Sigura-gura No. 2 Malang, Jawa Timur</p>
            <hr>
            <h3>LAPORAN DATA PENDAFTARAN UKM</h3>
        </div>

        <div class="header-flex no-print">
            <h3>Data Pendaftaran Masuk</h3>
            <div class="dropdown">
                <button class="btn btn-secondary">🖨️ Cetak / Export ▼</button>
                <div class="dropdown-content">
                    <button onclick="window.print()">🖨️ Cetak (Browser)</button>
                    <a href="{{ route('admin.pendaftaran.exportPdf') }}" target="_blank">📄 Export PDF</a>
                </div>
            </div>
        </div>
        <p style="margin-bottom: 20px; color: #666;">Daftar mahasiswa yang mendaftar ke UKM.</p>

        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Atlet</th>
                        <th>NIM</th>
                        <th>Prodi</th>
                        <th>UKM Pilihan</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendaftarans as $key => $data)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $data->mahasiswa->nama }}</td>
                            <td>{{ $data->mahasiswa->nim }}</td>
                            <td>{{ $data->mahasiswa->prodi }}</td>
                            <td>{{ $data->ukm->nama_ukm }}</td>
                            <td>{{ $data->tanggal_daftar }}</td>
                            <td>
                                <form action="{{ route('admin.pendaftaran.update', $data->id_pendaftaran) }}" method="POST">
                                    @csrf
                                    <select name="status_verifikasi" onchange="this.form.submit()"
                                        class="badge {{ $data->status_verifikasi == 'Diterima' ? 'badge-success' : ($data->status_verifikasi == 'Ditolak' ? 'badge-danger' : 'badge-pending') }}"
                                        style="border: none; cursor: pointer; height: auto;">
                                        <option value="Pending" {{ $data->status_verifikasi == 'Pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="Diterima" {{ $data->status_verifikasi == 'Diterima' ? 'selected' : '' }}>
                                            Diterima</option>
                                        <option value="Ditolak" {{ $data->status_verifikasi == 'Ditolak' ? 'selected' : '' }}>
                                            Dikeluarkan</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection